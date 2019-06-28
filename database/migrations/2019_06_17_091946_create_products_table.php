<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 100); // VARCHAR 100
            $table->text('description')->nullable(); // TEXT NULL
            $table->decimal('price');
            $table->decimal('salePrice')->nullable();
            $table->char('reference', 16);
            $table->string('size', 100)->nullable();
            $table->string('image_url', 100)->nullable();
            $table->boolean('status_publish');
            $table->enum('status_product', ['sold', 'standard']);
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
}
