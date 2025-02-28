
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
            $table->string('name')->comment('Name of the service (e.g., Haircut, Manicure)');
            $table->string('image')->default('default-image.jpg')->comment('Default image for the service');
            $table->text('description')->comment('Description of the service');
            $table->integer('duration')->comment('Duration of the service in minutes');
            $table->decimal('price', 8, 2)->comment('Price of the service');
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade')->comment('Foreign key for categories table');
            $table->text('addons')->nullable()->comment('Add-ons available for the service');
            $table->enum('appointment_type', ['appointment', 'walk-in'])->comment('Whether it\'s appointment-based or walk-in');
            $table->foreignId('expert_id')->constrained('experts')->onDelete('cascade')->comment('Foreign key for experts table');
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


