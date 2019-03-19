<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_estudiante')->unsigned()->nullable();
            $table->foreign('id_estudiante')->references('id')->on('estudiantes');
            $table->integer('id_actividad')->unsigned()->nullable();
            $table->foreign('id_actividad')->references('id')->on('actividads');
            $table->double('nota'); 
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
        Schema::dropIfExists('notas');
    }
}
