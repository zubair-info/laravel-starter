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
        Schema::create('hero_social_links', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hero_section_id')
                ->constrained('hero_sections')
                ->onDelete('cascade');
            $table->string('platform');       // e.g., "LinkedIn"
            $table->text('icon_svg');         // Store inline SVG or icon HTML
            $table->string('url');
            $table->integer('sort_order')->default(0);
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hero_social_links');
    }
};
