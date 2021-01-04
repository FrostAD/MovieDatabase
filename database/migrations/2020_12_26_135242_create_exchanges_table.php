<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExchangesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exchanges', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('movie1_id');
            $table->foreign('movie1_id')
                ->references('id')
                ->on('movies')->onDelete('cascade');
            $table->unsignedBigInteger('user1_id');
            $table->foreign('user1_id')
                ->references('id')
                ->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('movie2_id')->nullable();
            $table->foreign('movie2_id')
                ->references('id')
                ->on('movies')->onDelete('cascade');
            $table->unsignedBigInteger('user2_id')->nullable();
            $table->foreign('user2_id')
                ->references('id')
                ->on('users')->onDelete('cascade');
            $table->boolean('return1')->nullable();
            $table->boolean('return2')->nullable();
            $table->double('rating_for_first')->default(0);
            $table->double('rating_for_second')->default(0);
            $table->boolean('visible');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exchanges');
    }
}
