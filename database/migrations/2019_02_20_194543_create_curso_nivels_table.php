<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCursoNivelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('curso_nivels', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_cohorte')->unsigned()->nullable();
            $table->foreign('id_cohorte')->references('id')->on('cohortes')->onUpdate("cascade");
            $table->integer('id_curso')->unsigned()->nullable();
            $table->foreign('id_curso')->references('id')->on('cursos')->onUpdate("cascade");
            $table->integer('id_nivel')->unsigned()->nullabel();
            $table->foreign('id_nivel')->references('id')->on('nivels')->onUpdate("cascade");
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
        Schema::dropIfExists('curso_nivels');
    }
}
