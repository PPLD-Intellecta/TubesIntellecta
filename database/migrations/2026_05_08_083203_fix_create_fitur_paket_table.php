<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('fitur_paket')) {
            Schema::create('fitur_paket', function (Blueprint $table) {
                $table->foreignId('paket_id')
                    ->constrained('pakets')
                    ->cascadeOnDelete();

                $table->foreignId('fitur_id')
                    ->constrained('fiturs')
                    ->cascadeOnDelete();

                $table->primary(['paket_id', 'fitur_id']);
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('fitur_paket');
    }
};