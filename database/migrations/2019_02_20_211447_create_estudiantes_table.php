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
            $table->string('e-mail');
            $table->integer('id_promocion')->unsigned();
            $table->foreign('id_promocion')->references('id')->on('promociones');
            $table->integer('id_estado')->unsigned();
            $table->foreign('id_estado')->references('id')->on('estados');
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
