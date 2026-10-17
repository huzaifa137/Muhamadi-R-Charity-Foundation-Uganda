<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('site_page_contents', function (Blueprint $table) {
            $table->id();
            $table->string('page_key', 40)->unique();
            $table->string('page_title', 160);
            $table->string('hero_eyebrow', 180)->nullable();
            $table->string('hero_heading', 240);
            $table->text('hero_intro');
            $table->string('hero_image_path', 500)->nullable();
            $table->json('sections');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('site_page_contents');
    }
};
