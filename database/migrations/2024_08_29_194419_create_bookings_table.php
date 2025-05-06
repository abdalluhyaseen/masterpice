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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->decimal('total_price', 8, 2);
            $table->string('status')->default('pending');
            $table->date('date')->default(DB::raw('CURRENT_DATE'));
            $table->dateTime('start_at')->default(DB::raw('CURRENT_TIMESTAMP'));  // يحتفظ بالـ datetime
            $table->integer('duration')->default(0);
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('field_id')->constrained()->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes(); // soft Delete
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
