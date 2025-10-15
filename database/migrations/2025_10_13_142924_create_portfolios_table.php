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
        Schema::create('portfolios', function (Blueprint $table) {
            $table->id();
            $table->string('title');                           // Project title (e.g. Mendero fintech dashboard design)
            $table->string('slug')->unique();                  // For project details URL
            $table->string('service_id')->nullable();            // e.g. "User Experience"
            $table->string('client')->nullable();              // e.g. "Mashorom"
            $table->date('start_date')->nullable();            // Project start date
            $table->date('end_date')->nullable();              // Project end date
            $table->string('main_image')->nullable();          // Hero banner image path
            $table->text('overview')->nullable();              // Overview section text
            $table->text('typography')->nullable();            // Typography section text
            $table->text('conclusion')->nullable();            // Conclusion section text
            $table->string('link')->nullable();   // Optional project link
            $table->string('image')->nullable(); // Image file path or URL
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('portfolios');
    }
};
