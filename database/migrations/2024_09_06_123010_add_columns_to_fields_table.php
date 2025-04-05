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
        Schema::table('fields', function (Blueprint $table) {
                        $table->time('opens_at')->default('09:00');
            $table->time('closes_at')->default('22:00');
            $table->boolean('is_24_hours')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('fields', function (Blueprint $table) {
                        $table->dropColumn(['opens_at', 'closes_at', 'is_24_hours']);
            
        });
    }
};
