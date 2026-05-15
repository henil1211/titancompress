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
        // RFQ Statuses (Lookup)
        Schema::create('rfq_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique(); // New, Under Review, Quoted, Negotiation, Closed Won, Closed Lost
            $table->string('color_hex')->nullable();
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        // Main RFQs Table
        Schema::create('rfqs', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignId('status_id')->constrained('rfq_statuses');
            $table->foreignId('assigned_to')->nullable()->constrained('users'); // Sales Manager assignment
            
            // Customer Info
            $table->string('customer_name');
            $table->string('company_name');
            $table->string('email');
            $table->string('phone')->nullable();
            $table->string('country')->nullable();
            $table->string('industry')->nullable();
            
            // Technical Requirements (JSON for flexibility)
            $table->json('technical_requirements')->nullable();
            $table->text('additional_notes')->nullable();
            
            // Lead Meta
            $table->string('lead_source')->default('website'); // website, ai_chatbot, direct
            $table->string('priority')->default('medium'); // low, medium, high, urgent
            
            $table->timestamps();
            $table->softDeletes();
        });

        // RFQ Items (Products requested)
        Schema::create('rfq_items', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('rfq_id')->constrained('rfqs')->onDelete('cascade');
            $table->foreignUuid('product_id')->nullable()->constrained('products')->onDelete('set null');
            $table->string('product_name')->nullable(); // Snapshot in case product is deleted
            $table->integer('quantity')->default(1);
            $table->timestamps();
        });

        // RFQ Attachments
        Schema::create('rfq_attachments', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('rfq_id')->constrained('rfqs')->onDelete('cascade');
            $table->string('file_path');
            $table->string('file_name');
            $table->string('mime_type')->nullable();
            $table->timestamps();
        });

        // RFQ Internal Notes (Sales/Admin use)
        Schema::create('rfq_notes', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('rfq_id')->constrained('rfqs')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users'); // Admin who wrote the note
            $table->text('content');
            $table->timestamps();
        });

        // RFQ Activity Log (Workflow tracking)
        Schema::create('rfq_activity_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('rfq_id')->constrained('rfqs')->onDelete('cascade');
            $table->foreignId('user_id')->nullable()->constrained('users');
            $table->string('action'); // status_changed, assigned, note_added, file_uploaded
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rfq_activity_logs');
        Schema::dropIfExists('rfq_notes');
        Schema::dropIfExists('rfq_attachments');
        Schema::dropIfExists('rfq_items');
        Schema::dropIfExists('rfqs');
        Schema::dropIfExists('rfq_statuses');
    }
};
