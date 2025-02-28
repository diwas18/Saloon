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
        // Add the branch_id column
        Schema::table('services', function (Blueprint $table) {
            $table->foreignId('branch_id')->constrained('branches')->onDelete('cascade')->after('expert_id')->comment('Foreign key for branches table');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop the branch_id column
        Schema::table('services', function (Blueprint $table) {
            $table->dropForeign(['branch_id']); // Drop the foreign key constraint
            $table->dropColumn('branch_id'); // Drop the column itself
        });
    }
};
