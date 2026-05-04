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
        Schema::create('paket_user_fitur', function (Blueprint $table) {
            $table->id();
            $table->foreignId('paket_user_id')->constrained('paket_users')->onDelete('cascade');
            $table->foreignId('fitur_id')->constrained('fiturs')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paket_user_fitur');
    }
};
