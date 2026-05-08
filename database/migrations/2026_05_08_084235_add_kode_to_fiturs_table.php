<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('fiturs') && !Schema::hasColumn('fiturs', 'kode')) {
            Schema::table('fiturs', function (Blueprint $table) {
                $table->string('kode')->nullable()->unique()->after('nama');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('fiturs') && Schema::hasColumn('fiturs', 'kode')) {
            Schema::table('fiturs', function (Blueprint $table) {
                $table->dropColumn('kode');
            });
        }
    }
};