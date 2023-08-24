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
        Schema::create('post_event_question_options', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('post_event_question_id');
            $table->text('option_text');
            $table->timestamps();
            $table->foreign('post_event_question_id')->references('id')->on('post_event_questions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post_event_question_options');
    }
};
