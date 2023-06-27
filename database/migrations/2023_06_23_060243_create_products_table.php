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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('categories');
            $table->foreignId('subcategory_id')->constrained('sub_categories');
            $table->string('name');
            $table->string('description');
            $table->string('selling_price');
            $table->string('min_price')->nullable();
            $table->string('increase_ratio')->nullable();
            $table->string('product_qty')->nullable();
            $table->string('code');
            $table->string('product_photo')->nullable();
            
            $table->integer('is_new')->nullable();
            $table->integer('on_sale')->nullable();
            $table->integer('new_arrival')->nullable();
            $table->integer('best_seller')->nullable();
            $table->integer('status')->default(0);
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
        Schema::dropIfExists('products');
    }
};
