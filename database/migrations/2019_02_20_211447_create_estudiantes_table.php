<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEstudiantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estudiantes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombres',100);
            $table->string('apellidos',100);
            $table->integer('DUI');
            $table->date('fecha_nacimiento');
            $table->string('genero',30);
            $table->string('direccion',100);
            $table->integer('telefono');
            $table->string('email');
            $table->integer('id_cohorte')->unsigned();
            $table->foreign('id_cohorte')->references('id')->on('cohortes')->onUpdate("cascade");
            $table->integer('id_estado')->unsigned();
            $table->foreign('id_estado')->references('id')->on('estados')->onUpdate("cascade");
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
        Schema::dropIfExists('estudiantes');
    }
}
