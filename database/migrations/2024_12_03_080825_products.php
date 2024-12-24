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
        Schema::create('products', function (Blueprint $table) {
            $table->id()->unsigned();
            $table->foreignId('group_id')->constrained('product_groups')->onDelete('cascade');
            $table->string('product_name', 100);
            $table->text('description');
            $table->integer('quantity');
            $table->integer('unit_price');
            $table->integer('old_unit_price');
            $table->string('image', 200);
            $table->boolean('enable')->default(1);
            $table->string('note', 100);
            $table->timestamps(0);

            $table->primary('id');
            $table->foreign('group_id')->references('id')->on('product_groups')->onDelete('cascade');
        });

        Schema::create('product_groups', function (Blueprint $table) {
            $table->id()->unsigned();
            $table->string('group_name', 30);
            $table->string('note', 100);
            $table->boolean('enable')->default(1);
            $table->timestamps(0);

            $table->primary('id');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('products');
        Schema::dropIfExists('product_groups');
    }
};
