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
        Schema::create('works', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Name of the work
            $table->string('photo1'); // First image
            $table->string('photo2')->nullable(); // Second image (optional)
            $table->string('photo3')->nullable(); // Third image (optional)
            $table->text('description');
            $table->foreignId('expert_id')->constrained('experts')->onDelete('cascade');
            $table->timestamp('completed_at')->nullable(); // Stores when the work was completed
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('works');
    }
};
