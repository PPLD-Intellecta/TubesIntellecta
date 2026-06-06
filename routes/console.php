<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

use Illuminate\Support\Facades\Schedule;
Schedule::command('sessions:update-status')->everyMinute();

// Auto-mark overdue study goals daily at 00:00 WIB
Schedule::call(function () {
    \App\Models\StudyGoal::where('target_date', '<', now()->timezone('Asia/Jakarta')->toDateString())
        ->whereIn('status', ['pending', 'in_progress'])
        ->update(['status' => 'overdue']);
})->dailyAt('00:00');
