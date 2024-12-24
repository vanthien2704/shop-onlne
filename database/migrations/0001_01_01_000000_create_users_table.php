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
        Schema::create('users', function (Blueprint $table) {
            $table->id()->unsigned();
            $table->string('username')->unique();
            $table->string('fullname');
            $table->string('phone');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('address');
            $table->string('role')->default('user');
            $table->boolean('enable')->default(1);
            $table->timestamps(0);

            $table->primary('id');
            $table->unique('email');
        });
        
        Schema::create('contacts', function (Blueprint $table) {
            $table->string('fullname', 30);
            $table->string('email', 30);
            $table->string('phone', 12);
            $table->string('note', 200);
            $table->timestamps(0);
        });
        

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('contacts');
        Schema::dropIfExists('sessions');
    }
};
