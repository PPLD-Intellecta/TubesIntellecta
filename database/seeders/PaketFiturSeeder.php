<?php

namespace Database\Seeders;

use App\Models\Paket;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class PaketFiturSeeder extends Seeder
{
    public function run(): void
    {
        $free = Paket::updateOrCreate(
            ['nama' => 'Free'],
            ['deskripsi' => 'Paket gratis dengan akses fitur dasar.']
        );

        $premium = Paket::updateOrCreate(
            ['nama' => 'Premium'],
            ['deskripsi' => 'Paket berbayar dengan akses seluruh fitur.']
        );

        $fiturs = [
            [
                'nama' => 'Akses Materi Video',
                'kode' => 'akses-materi-video',
                'deskripsi' => 'Siswa dapat mengakses materi video pembelajaran.',
            ],
            [
                'nama' => 'Kuis dan Evaluasi',
                'kode' => 'kuis-evaluasi',
                'deskripsi' => 'Siswa dapat mengerjakan kuis dan evaluasi.',
            ],
            [
                'nama' => 'Modul Paket Belajar',
                'kode' => 'modul-paket-belajar',
                'deskripsi' => 'Siswa dapat melihat modul atau paket belajar.',
            ],
            [
                'nama' => 'History Belajar',
                'kode' => 'history-belajar',
                'deskripsi' => 'Siswa dapat melihat riwayat belajar.',
            ],
            [
                'nama' => 'Study Planner',
                'kode' => 'study-planner',
                'deskripsi' => 'Siswa dapat membuat rencana belajar.',
            ],
            [
                'nama' => 'Notifikasi Pengingat Belajar',
                'kode' => 'notifikasi-pengingat-belajar',
                'deskripsi' => 'Siswa mendapat pengingat jadwal belajar.',
            ],
            [
                'nama' => 'Forum Chat',
                'kode' => 'forum-chat',
                'deskripsi' => 'Siswa dapat berdiskusi di forum belajar.',
            ],
            [
                'nama' => 'Live Teaching',
                'kode' => 'live-teaching',
                'deskripsi' => 'Siswa dapat mengikuti pembelajaran live teaching.',
            ],
        ];

        foreach ($fiturs as $fitur) {
            $data = [];

            if (Schema::hasColumn('fiturs', 'kode')) {
                $data['kode'] = $fitur['kode'];
            }

            if (Schema::hasColumn('fiturs', 'nama')) {
                $data['nama'] = $fitur['nama'];
            }

            if (Schema::hasColumn('fiturs', 'nama_fitur')) {
                $data['nama_fitur'] = $fitur['nama'];
            }

            if (Schema::hasColumn('fiturs', 'deskripsi')) {
                $data['deskripsi'] = $fitur['deskripsi'];
            }

            if (Schema::hasColumn('fiturs', 'deskripsi_fitur')) {
                $data['deskripsi_fitur'] = $fitur['deskripsi'];
            }

            if (Schema::hasColumn('fiturs', 'created_at')) {
                $data['created_at'] = now();
            }

            if (Schema::hasColumn('fiturs', 'updated_at')) {
                $data['updated_at'] = now();
            }

            DB::table('fiturs')->updateOrInsert(
                ['kode' => $fitur['kode']],
                $data
            );
        }

        $fiturFree = DB::table('fiturs')
            ->whereIn('kode', [
                'akses-materi-video',
                'kuis-evaluasi',
                'modul-paket-belajar',
                'history-belajar',
            ])
            ->pluck('id')
            ->toArray();

        $fiturPremium = DB::table('fiturs')
            ->pluck('id')
            ->toArray();

        $free->fiturs()->sync($fiturFree);
        $premium->fiturs()->sync($fiturPremium);

        if (Schema::hasColumn('users', 'paket_id')) {
            User::whereNull('paket_id')->update([
                'paket_id' => $free->id,
            ]);
        }
    }
}