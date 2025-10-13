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
        Schema::create('hero_sections', function (Blueprint $table) {
            $table->id();
            $table->string('greeting_text')->nullable();              // e.g., "Hello, I'm"
            $table->string('greeting_icon')->nullable();              // optional image/icon path
            $table->string('title_first')->nullable();                // e.g., "Mark"
            $table->string('title_second')->nullable();               // e.g., "Henry"
            $table->string('subtitle')->nullable();                   // e.g., "Product Designer | Based in Germany"
            $table->text('description')->nullable();                  // Optional paragraph
            $table->string('primary_button_text')->nullable();
            $table->string('primary_button_url')->nullable();
            $table->string('secondary_button_text')->nullable();
            $table->string('secondary_button_url')->nullable();
            $table->string('hero_image')->nullable();
            $table->string('rotating_svg')->nullable();
            $table->string('client_count')->nullable();
            $table->string('client_label')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hero_sections');
    }
};
