<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Product name
            $table->decimal('price', 8, 2); // Product price
            $table->integer('stock'); // Stock quantity
            $table->string('image')->nullable(); // Image path or URL
            $table->foreignId('category_id')->constrained()->onDelete('cascade'); // Foreign key for category
            $table->timestamps(); // Created and updated timestamps
        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
}
