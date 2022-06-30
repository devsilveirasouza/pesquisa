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
            $table->unsignedBigInteger('id_question');
            $table->unsignedBigInteger('id_option');
            $table->longText('response_question');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('id_question') ->references('id')   -> on ('questions');
            $table->foreign('id_option')   ->references('id')   -> on ('options');
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
