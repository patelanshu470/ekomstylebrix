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
            $table->string('name')->nullable();
            $table->string('thumbnail')->nullable();

            $table->unsignedBigInteger('cat_id')->nullable();
            $table->foreign('cat_id')
            ->references('id')->on('categories')
            ->onDelete('cascade');

            $table->unsignedBigInteger('sub_cat_id')->nullable();
            $table->foreign('sub_cat_id')
            ->references('id')->on('sub_categories')
            ->onDelete('cascade');

            $table->string('cost_price')->nullable();
            $table->string('sell_price')->nullable();
            $table->string('discount')->comment('%')->nullable();
            $table->string('final_sell_price')->nullable();
            $table->longText('description')->nullable();
            $table->string('size')->nullable();
            $table->integer('quantity')->nullable();
            $table->string('color')->nullable();
            $table->string('color_image')->nullable();
            $table->string('varient_ids')->nullable();
            $table->string('status')->nullable();
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
