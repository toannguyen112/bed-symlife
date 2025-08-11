<?php

use App\Models\Product\Product;
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
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('brand_id')->index()->nullable();

            $table->string('status', 30)->default(Product::STATUS_ACTIVE);
            $table->boolean('is_featured')->nullable()->default(0);
            $table->boolean('is_new')->nullable()->default(0);
            $table->boolean('is_stock')->nullable()->default(0);
            $table->integer('position')->nullable();
            $table->integer('home_position')->nullable();
            $table->integer('view_count')->default(0);
            $table->json('images')->nullable();
            $table->json('image')->nullable();

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
        Schema::dropIfExists('products');
    }
};
