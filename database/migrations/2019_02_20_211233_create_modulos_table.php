<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModulosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('modulos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre',50);
            $table->integer('id_docente')->unsigned()->nullable();
            $table->foreign('id_docente')->references('id')->on('docentes');
            $table->integer('id_nivel')->unsigned()->nullable();
            $table->foreign('id_nivel')->references('id')->on('nivels');
            $table->integer('id_curso')->unsigned()->nullable();
            $table->foreign('id_curso')->references('id')->on('cursos');
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
        Schema::dropIfExists('modulos');
    }
}