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
        Schema::table('tickets', function (Blueprint $table) {
            $table->string('title')->after('customer_id');
            $table->string('category')->nullable()->after('description');
            $table->unsignedBigInteger('assigned_to')->nullable()->after('category');

            // Update priority enum to include 'Critical'
            $table->enum('priority', ['Low', 'Medium', 'High', 'Critical'])
                  ->default('Medium')
                  ->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tickets', function (Blueprint $table) {
            $table->dropColumn(['title', 'category', 'assigned_to']);

            // Revert priority enum back to original
            $table->enum('priority', ['Low', 'Medium', 'High'])
                  ->default('Medium')
                  ->change();
        });
    }
};
