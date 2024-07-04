<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // يمكنني حذف عمود 
    // ثم أستخدم     php artisan  migrate:fresh
    // لنقل التحديثات

    // يمكنني أيضا إضافة عمود
    // ثم أستخدم     php artisan  migrate:fresh
    // لنقل التحديثات
    public function up(): void
    {
        Schema::create('nationalexams', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('path');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nationalexams');
    }
};
