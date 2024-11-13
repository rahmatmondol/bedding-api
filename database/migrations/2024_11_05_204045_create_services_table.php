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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug');
            $table->text('description');
            $table->float('price');
            $table->string('location')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->enum ('priceType', ['Negotiable', 'Fixed'])->default('Fixed');
            $table->enum ('currency', ['AED', 'USD'])->default('USD');
            $table->enum ('status', ['Active', 'Inactive'])->default('Active');
            $table->enum ('level', ['Entry', 'Intermediate', 'Expert'])->default('Entry');
            $table->date('deadline')->nullable();
            $table->float('commission')->default(0.0);
            $table->boolean('is_featured')->default(false);
            

            $table->foreignId('category_id')->nullable()->constrained('categories')->onDelete('cascade');
            $table->foreignId('sub_category_id')->nullable()->constrained('sub_categories')->onDelete('cascade');
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
