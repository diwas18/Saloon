<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('experts', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Expert's name
            $table->string('specialization'); // Specialization (e.g., Hair Stylist, Manicurist)
            $table->integer('experience_years'); // Years of experience
            $table->string('availability'); // Working hours/days
            $table->integer('rating')->nullable(); // Customer rating (optional)
            $table->string('contact_info')->nullable(); // Contact information (optional)
            $table->string('languages_spoken')->nullable(); // Languages spoken (optional)
            $table->text('certifications')->nullable(); // Certifications (optional)
            $table->string('social_media_link')->nullable(); // Link to social media or portfolio (optional)
            $table->string('profile_picture')->nullable(); // Profile picture path (optional)

            $table->timestamps(); // Created at and updated at timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('experts');
    }
};
