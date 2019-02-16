<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParkingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parkings', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('user_id')->unisigned();

            $table->date('fecha');
            $table->enum('deudas', ['SI', 'NO'])->default('NO');
            $table->enum('carro', ['SI', 'NO']);
            $table->enum('moto', ['SI', 'NO']);
            $table->enum('discapacidad', ['SI', 'NO'])->default('NO');
            $table->enum('asignado', ['SI', 'NO']);
            $table->integer('numero')->nullable();
            $table->enum('tipo', ['PROPIETARIO', 'ARRIENDATARIO']);

            $table->string('nombre_propietario');
            $table->string('telefono_propietario');
            $table->string('direccion_propietario');
            $table->string('email_propietario');

            $table->string('nombre_residente');
            $table->string('telefono_residente');
            $table->string('direccion_residente');
            $table->string('email_residente');
            $table->integer('torre');
            $table->integer('apartamento');

            $table->mediumText('cedula');
            $table->mediumText('tarjeta_propiedad');
            $table->mediumText('soat');
            $table->mediumText('autorizacion')->nullable();

            $table->string('placa1');
            $table->string('color1');
            $table->string('clase1');
            $table->string('marca1');
            $table->string('modelo1');

            for ($i = 2; $i <= 3; $i++) { 
                $table->string('placa'.$i)->nullable();
                $table->string('color'.$i)->nullable();
                $table->string('clase'.$i)->nullable();
                $table->string('marca'.$i)->nullable();
                $table->string('modelo'.$i)->nullable();
            }

            $table->string('diligenciador');
            $table->string('documento');

            $table->enum('status', ['PENDING', 'APPROVED'])->default('PENDING');

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
        Schema::dropIfExists('parkings');
    }
}
