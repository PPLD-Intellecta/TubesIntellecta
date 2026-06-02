<?php

namespace App\Console\Commands;

use App\Models\LiveSession;
use Illuminate\Console\Command;
use Carbon\Carbon;

class UpdateSessionStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sessions:update-status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Otomatis memperbarui status kelas live berdasarkan jadwal dan durasi kelas';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $now = Carbon::now();

        // 1. Update status 'scheduled' ke 'live' jika waktu mulai sudah tiba/lewat
        $startedSessions = LiveSession::where('status', 'scheduled')
            ->where('scheduled_at', '<=', $now)
            ->get();

        foreach ($startedSessions as $session) {
            $session->update(['status' => 'live']);
            $this->info("Kelas live ID #{$session->id} ('{$session->title}') telah dimulai (status diperbarui menjadi 'live').");
        }

        // 2. Update status 'live' atau 'scheduled' (yang terlewat) ke 'ended' jika waktu kelas + durasi sudah habis
        // Kita hitung akhir kelas dengan menambahkan durasi_minutes ke scheduled_at
        $endedSessionsCount = 0;
        
        $activeSessions = LiveSession::whereIn('status', ['live', 'scheduled'])->get();

        foreach ($activeSessions as $session) {
            $endTime = $session->scheduled_at->copy()->addMinutes($session->duration_minutes);
            
            if ($endTime->copy()->setTimezone('UTC')->lte($now)) {
                $session->update(['status' => 'ended']);
                $this->info("Kelas live ID #{$session->id} ('{$session->title}') telah berakhir (status diperbarui menjadi 'ended').");
                $endedSessionsCount++;
            }
        }

        $this->info("Proses sinkronisasi status kelas live selesai. (" . count($startedSessions) . " dimulai, " . $endedSessionsCount . " berakhir)");
    }
}
