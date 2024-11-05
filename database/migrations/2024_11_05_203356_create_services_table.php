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
            $table->string('price');
            $table->enum ('priceType', ['Nagotiation', 'Fixed'])->default('Fixed');
            $table->enum ('curency', ['AED', 'USD'])->default('USD');
            $table->enum ('status', ['Active', 'Inactive'])->default('Active');
            $table->enum ('label', ['Entry', 'Intermediate', 'Expert'])->default('Entry');
            $table->date('deadline')->nullable();
            $table->float('commission')->default(0.0);
            $table->boolean('is_featured')->default(false);

            $table->foreignId('skill_id')->constrained('skills')->onDelete('cascade')->nullable();
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade')->nullable();
            $table->foreignId('sub_category_id')->constrained('sub_categories')->onDelete('cascade')->nullable();
            $table->foreignId('image_id')->constrained('images')->onDelete('cascade')->nullable();
            $table->foreignId('location_id')->constrained('locations')->onDelete('cascade')->nullable();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade')->nullable();

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
