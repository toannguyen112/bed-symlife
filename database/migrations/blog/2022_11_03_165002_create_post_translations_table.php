<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_translations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('post_id');

            $table->string('title');
            $table->string('locale');
            $table->string('slug');

            $table->string('author')->nullable();
            $table->text('description')->nullable();
            $table->longText('content')->nullable();
            $table->json('sliders')->nullable();

            $table->text('number_of_course')->nullable();
            $table->text('timetable')->nullable();

            $table->json('schedule')->nullable();
            $table->json('groups')->nullable();
            $table->json('course_for')->nullable();
            $table->json('knowledge_content')->nullable();
            $table->json('course_target')->nullable();

            $table->addSeo();

            $table->unique(['locale', 'post_id']);
            $table->unique(['locale', 'slug']);
            $table->foreign('post_id')
                ->references('id')
                ->on('posts')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post_translations');
    }
}
