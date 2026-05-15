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
        // Specification Groups (Performance, Electrical, Physical, etc.)
        Schema::create('specification_groups', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        // Specification Attributes (Air Flow, Power, Weight)
        Schema::create('specification_attributes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('group_id')->constrained('specification_groups')->onDelete('cascade');
            $table->string('name');
            $table->string('unit')->nullable();
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        // Categories & Subcategories
        Schema::create('product_categories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('parent_id')->nullable()->constrained('product_categories')->onDelete('cascade');
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });

        // Advanced Products Table
        Schema::create('products', function (Blueprint $table) {
            $table->uuid('id')->primary(); // Transitioning to UUID for enterprise scalability
            $table->foreignId('category_id')->constrained('product_categories')->onDelete('cascade');
            $table->foreignId('subcategory_id')->nullable()->constrained('product_categories')->onDelete('set null');
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('sku')->unique();
            $table->text('short_description')->nullable();
            $table->longText('description')->nullable();
            $table->longText('technical_overview')->nullable();
            $table->string('status')->default('draft'); // draft, active, archived, out_of_stock
            $table->boolean('featured')->default(false);
            $table->boolean('trending')->default(false);
            $table->timestamps();
            $table->softDeletes();
        });

        // Product Specification Values (The Pivot for Comparison)
        Schema::create('product_specifications', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('product_id')->constrained('products')->onDelete('cascade');
            $table->foreignId('attribute_id')->constrained('specification_attributes')->onDelete('cascade');
            $table->string('value');
            $table->timestamps();
        });

        // Media Management
        Schema::create('product_media', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('product_id')->constrained('products')->onDelete('cascade');
            $table->string('file_path');
            $table->string('file_type')->default('image'); // image, gallery, brochure, cad, 3d_model
            $table->string('mime_type')->nullable();
            $table->string('title')->nullable();
            $table->boolean('is_main')->default(false);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        // SEO Metadata
        Schema::create('seo_metadata', function (Blueprint $table) {
            $table->id();
            $table->uuidMorphs('seoable'); // Support for Products, Categories, etc.
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->string('og_image')->nullable();
            $table->string('canonical_url')->nullable();
            $table->timestamps();
        });

        // Relationships (Related Products)
        Schema::create('related_products', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('product_id')->constrained('products')->onDelete('cascade');
            $table->foreignUuid('related_id')->constrained('products')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('related_products');
        Schema::dropIfExists('seo_metadata');
        Schema::dropIfExists('product_media');
        Schema::dropIfExists('product_specifications');
        Schema::dropIfExists('products');
        Schema::dropIfExists('product_categories');
        Schema::dropIfExists('specification_attributes');
        Schema::dropIfExists('specification_groups');
    }
};
