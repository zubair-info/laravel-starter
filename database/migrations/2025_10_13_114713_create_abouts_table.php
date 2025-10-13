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
        Schema::create('abouts', function (Blueprint $table) {
            $table->id();
            $table->string('greeting')->nullable();       // "Hello I'm"
            $table->string('name')->nullable();           // "Mark Henry"
            $table->string('role')->nullable();           // "Product Designer"
            $table->string('location')->nullable();       // "Based in German"
            $table->text('description')->nullable();     // main paragraph
            $table->string('image')->nullable();          // hero image
            $table->string('resume_link')->nullable();    // link to resume
            $table->integer('years_experience')->nullable()->default(0);
            $table->integer('award_count')->nullable()->default(0);
            $table->integer('client_count')->nullable()->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('abouts');
    }
};
