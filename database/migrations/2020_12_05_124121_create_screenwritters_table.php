<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScreenwrittersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('screenwritters', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->date('born_date');
            $table->string('born_place');
            $table->longText('description');
            $table->string('image');
            $table->boolean('archived')->default(false);
            $table->unique(['name','born_date','born_place','description']);

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
        Schema::dropIfExists('screenwritters');
    }
}
