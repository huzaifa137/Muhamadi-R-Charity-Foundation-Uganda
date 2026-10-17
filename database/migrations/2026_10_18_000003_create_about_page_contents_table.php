<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('about_page_contents', function (Blueprint $table) {
            $table->id();
            $table->string('hero_eyebrow', 120)->default('About the foundation');
            $table->string('hero_heading', 220);
            $table->text('hero_intro');
            $table->string('intro_heading', 220);
            $table->text('intro_body');
            $table->text('intro_supporting')->nullable();
            $table->text('mission');
            $table->text('vision');
            $table->json('values');
            $table->string('approach_heading', 220);
            $table->text('approach_intro');
            $table->json('approach_steps');
            $table->string('hero_image_path', 500)->nullable();
            $table->string('intro_image_path', 500)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('about_page_contents');
    }
};
