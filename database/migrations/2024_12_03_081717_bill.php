<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bills', function (Blueprint $table) {
            $table->id()->unsigned();
            $table->string('name', 100);
            $table->string('address', 255);
            $table->string('phone', 12);
            $table->string('email', 100);
            $table->date('order_date');
            $table->integer('total');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->integer('status')->default(1);
            $table->timestamps(0);

            $table->primary('id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::create('cart', function (Blueprint $table) {
            $table->id()->unsigned();
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade');
            $table->integer('unit_price');
            $table->integer('quantity');
            $table->integer('total_price');
            $table->foreignId('order_id')->constrained('bills')->onDelete('cascade');
            $table->timestamps(0);

            $table->primary('id');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('order_id')->references('id')->on('bills')->onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('bills');
        Schema::dropIfExists('cart');
    }
};
