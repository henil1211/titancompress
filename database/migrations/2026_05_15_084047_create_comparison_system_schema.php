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
        // Comparison Sessions (Tracking active comparisons)
        Schema::create('comparison_sessions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->string('session_token')->index(); // For guests
            $table->string('slug')->nullable()->unique(); // SEO URL: titan-x-vs-hercules
            $table->timestamps();
        });

        // Items in comparison
        Schema::create('comparison_items', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('session_id')->constrained('comparison_sessions', 'id')->onDelete('cascade');
            $table->foreignUuid('product_id')->constrained('products')->onDelete('cascade');
            $table->timestamps();
        });

        // Saved Comparisons (Permanent bookmarks)
        Schema::create('saved_comparisons', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('title');
            $table->json('product_ids');
            $table->timestamps();
        });

        // Comparison Analytics (Tracking engagement)
        Schema::create('comparison_analytics', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('product_id')->constrained('products')->onDelete('cascade');
            $table->string('action'); // view_compare, add_to_compare, export_pdf
            $table->string('session_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comparison_analytics');
        Schema::dropIfExists('saved_comparisons');
        Schema::dropIfExists('comparison_items');
        Schema::dropIfExists('comparison_sessions');
    }
};
