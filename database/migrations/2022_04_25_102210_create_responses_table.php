<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResponsesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('responses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_pergunta');
            $table->unsignedBigInteger('id_opcao_resposta');
            $table->longText('resposta');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('id_pergunta')      ->references('id')   -> on ('questions');
            $table->foreign('id_resposta')      ->references('id')   -> on ('options');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('responses');
    }
}
