<?php

use Illuminate\\Database\\Migrations\\Migration;
use Illuminate\\Database\\Schema\\Blueprint;
use Illuminate\\Support\\Facades\\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('donations', function (Blueprint $table) {
            $table->id();
            $table->string('receipt_number', 40)->nullable()->unique();
            $table->string('donor_name', 160);
            $table->string('email', 190)->nullable()->index();
            $table->string('phone', 40)->nullable();
            $table->decimal('amount', 14, 2);
            $table->char('currency', 3)->default('UGX');
            $table->string('payment_method', 60)->default('Not specified');
            $table->string('payment_status', 20)->default('pending')->index();
            $table->string('reference', 160)->nullable()->index();
            $table->date('donation_date')->nullable()->index();
            $table->text('admin_notes')->nullable();
            $table->timestamps();
        });

        Schema::create('impact_records', function (Blueprint $table) {
            $table->id();
            $table->string('title', 180);
            $table->string('slug', 200)->unique();
            $table->string('category', 100)->nullable()->index();
            $table->string('location', 180)->nullable();
            $table->string('summary', 600);
            $table->longText('description');
            $table->unsignedInteger('beneficiaries_count')->nullable();
            $table->text('outcome')->nullable();
            $table->string('image_path', 500)->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('status', 20)->default('draft')->index();
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
        });

        Schema::create('stories', function (Blueprint $table) {
            $table->id();
            $table->string('title', 180);
            $table->string('slug', 200)->unique();
            $table->string('excerpt', 700);
            $table->longText('body');
            $table->string('category', 100)->nullable()->index();
            $table->string('author_name', 160)->nullable();
            $table->string('image_path', 500)->nullable();
            $table->string('status', 20)->default('draft')->index();
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
        });

        Schema::create('gallery_items', function (Blueprint $table) {
            $table->id();
            $table->string('title', 180);
            $table->text('caption')->nullable();
            $table->string('alt_text', 250);
            $table->string('category', 100)->nullable()->index();
            $table->string('image_path', 500);
            $table->string('status', 20)->default('draft')->index();
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('volunteer_applications', function (Blueprint $table) {
            $table->id();
            $table->string('name', 160);
            $table->string('email', 190)->index();
            $table->string('phone', 40)->nullable();
            $table->string('area_of_interest', 180);
            $table->string('availability', 160)->nullable();
            $table->text('experience')->nullable();
            $table->text('motivation');
            $table->string('status', 20)->default('new')->index();
            $table->text('admin_notes')->nullable();
            $table->timestamps();
        });

        Schema::create('contact_enquiries', function (Blueprint $table) {
            $table->id();
            $table->string('name', 160);
            $table->string('email', 190)->index();
            $table->string('phone', 40)->nullable();
            $table->string('subject', 180);
            $table->text('message');
            $table->string('status', 20)->default('new')->index();
            $table->text('admin_notes')->nullable();
            $table->text('response_notes')->nullable();
            $table->timestamp('responded_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contact_enquiries');
        Schema::dropIfExists('volunteer_applications');
        Schema::dropIfExists('gallery_items');
        Schema::dropIfExists('stories');
        Schema::dropIfExists('impact_records');
        Schema::dropIfExists('donations');
    }
};
