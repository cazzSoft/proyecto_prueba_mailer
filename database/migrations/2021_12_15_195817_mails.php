<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Mails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mails', function (Blueprint $table) {
            $table->id('idmails');
            $table->string('asunto');
            $table->string('destino');
            $table->string('cuerpo');

            $table->unsignedBigInteger('iduser');
            $table->foreign('iduser')->references('id')->on('users');

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
        Schema::dropIfExists('MailsModel');
    }
}
