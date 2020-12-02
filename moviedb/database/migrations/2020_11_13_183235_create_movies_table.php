<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMoviesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movies', function (Blueprint $table) {
            //TODO make sure movies are unique composite key https://blog.maqe.com/solved-eloquent-doesnt-support-composite-primary-keys-62b740120f
            $table->id()->unique();
            $table->unsignedBigInteger('author_id');
            $table->foreign('author_id')->references('id')->on('users');
            $table->string('title');
            $table->integer('timespan');
            $table->string('description');
            $table->date('published_at');
            $table->string('genres');
            $table->string('poster');
            //TODO save actors
            $table->string('producer');
            $table->string('music');
            $table->string('studio');
            $table->string('country');
            $table->string('trailer');
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('movies');
    }
}
