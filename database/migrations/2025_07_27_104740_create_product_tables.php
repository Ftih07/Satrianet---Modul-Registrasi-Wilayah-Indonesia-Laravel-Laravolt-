<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // Product Categories
        Schema::create('product_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->boolean('status')->default(true); // true = active
            $table->timestamps();
        });

        // Product Subcategories
        Schema::create('product_subcategories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_category_id')->constrained('product_categories')->onDelete('cascade');
            $table->string('name');
            $table->string('sub_title')->nullable();
            $table->text('description')->nullable();
            $table->string('banner')->nullable(); 
            $table->string('slug')->unique();
            $table->text('meta_keywords')->nullable();
            $table->boolean('status')->default(true);
            $table->timestamps();
        });

        // Products
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_subcategory_id')->constrained('product_subcategories')->onDelete('cascade');
            $table->string('name');
            $table->json('features')->nullable();
            $table->decimal('price', 12, 2)->nullable();
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
        Schema::dropIfExists('product_subcategories');
        Schema::dropIfExists('product_categories');
    }
};
