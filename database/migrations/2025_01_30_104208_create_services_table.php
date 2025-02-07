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
        Schema::create('services', function (Blueprint $table) {
            $table->id();


 $table->string('name');  // Name of the service (e.g., Haircut, Manicure)
 $table->string('image')->default('default-image.jpg'); // Set a default image
 $table->text('description');  // Description of the service
            $table->integer('duration');  // Duration of the service in minutes
            $table->decimal('price', 8, 2);  // Price of the service
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');  // Foreign key for categories table
            $table->text('addons')->nullable();  // Add-ons available for the service
            $table->enum('appointment_type', ['appointment', 'walk-in']);  // Whether it's appointment-based or walk-in
            $table->foreignId('expert_id')->constrained('experts')->onDelete('cascade');  // Foreign key for experts table




            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
