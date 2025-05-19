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
    Schema::table('bookings', function (Blueprint $table) {
        $table->string('payment_method')->nullable(); // طريقة الدفع
        $table->string('card_number')->nullable(); // رقم البطاقة (إن وجد)
        $table->string('card_expiry')->nullable(); // تاريخ انتهاء البطاقة
        $table->string('card_cvc')->nullable(); // CVC
        $table->string('paypal_email')->nullable(); // بريد PayPal (إن وجد)
    });
}

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn(['payment_method', 'card_number', 'card_expiry', 'card_cvc', 'paypal_email']);
        });
    }
};
