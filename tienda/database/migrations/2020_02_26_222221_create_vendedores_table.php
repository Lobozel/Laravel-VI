<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendedoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendedores', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre',60);
            $table->string('apellidos',120);
            $table->string('email',180)->unique();
            $table->string('direccion',220)->nullable();
            $table->string('telefono',60)->nullable();
            $table->string('foto')->default('/img/vendedores/default.png');
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
        Schema::dropIfExists('vendedores');
    }
}
