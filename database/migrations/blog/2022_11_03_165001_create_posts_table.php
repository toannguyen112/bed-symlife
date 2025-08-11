<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Post\Post;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();

            $table->json('image')->nullable();
            $table->json('banner')->nullable();
            $table->json('banner_mobile')->nullable();
            $table->date('published_at')->nullable();

            $table->boolean('is_home')->nullable()->default(0);
            $table->boolean('show_table_of_contents')->nullable()->default(0);
            $table->boolean('is_featured')->nullable()->default(0);
            $table->integer('position')->nullable();
            $table->integer('home_position')->nullable();
            $table->text('link')->nullable();
            $table->text('icon')->nullable();
            $table->string('status', 30)->nullable()->default(Post::STATUS_ACTIVE);
            $table->string('type', 30)->nullable()->default(Post::TYPE_POST);
            $table->string('resource_type', 30)->nullable()->default(Post::TYPE_RESOURCE_FREE);

            $table->integer('view_count')->default(0);
            $table->addInjectCode();
            $table->addTimestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
