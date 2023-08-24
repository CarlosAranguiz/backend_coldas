<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_event_answers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('question_id');
            $table->unsignedBigInteger('option_id')->nullable();
            $table->text('answer_text')->nullable(); // En caso de que la respuesta sea de texto libre
            $table->timestamps();
            $table->foreign('question_id')->references('id')->on('post_event_questions')->onDelete('cascade');
            $table->foreign('option_id')->references('id')->on('post_event_question_options')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post_event_answers');
    }
};
