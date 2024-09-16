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
            $table->id();
            $table->string('name');
            $table->string('slug')->unique()->nullable();
            $table->string('sku')->unique()->nullable();
            $table->string('image')->nullable();
            $table->decimal('buying_price', 10, 0)->nullable();
            $table->decimal('sale_price', 10, 0)->nullable();
            $table->tinyInteger('discount')->default(0)->nullable();
            $table->foreignId('category_id')->nullable()->constrained('categories')->constrained()->nullOnDelete();
            $table->foreignId('brand_id')->nullable()->constrained('brands')->constrained()->nullOnDelete();
            $table->foreignId('unit_id')->nullable()->constrained('units')->constrained()->nullOnDelete();
            $table->foreignId('specification_id')->nullable()->constrained('specifications')->constrained()->nullOnDelete();
            $table->foreignId('varian_id')->nullable()->constrained('varians')->constrained()->nullOnDelete();
            $table->unsignedBigInteger('qty')->default(0);
            $table->boolean('is_visible')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
