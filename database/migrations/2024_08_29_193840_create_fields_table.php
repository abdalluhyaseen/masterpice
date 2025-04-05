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
        Schema::create('fields', function (Blueprint $table) {
            $table->id();
            $table->string('field_name');
            $table->text('field_description');
            $table->string('field_location');
            $table->boolean('field_avilable');
            $table->string('opening_time')->nullable();
            $table->decimal('field_price',10,2);
            $table->foreignId('sport_type_id')->constrained()->onDelete('cascade');
            $table->foreignId('field_type_id')->constrained()->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes(); // soft Delete

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fields');
    }
};