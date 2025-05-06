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
    Schema::table('fields', function (Blueprint $table) {
        $table->text('description')->nullable(); // يمكنك إضافة `nullable` إذا كان العمود اختياريًا
    });
}


    /**
     * Reverse the migrations.
     */
 public function down()
{
    Schema::table('fields', function (Blueprint $table) {
        $table->dropColumn('description');
    });
}

};
