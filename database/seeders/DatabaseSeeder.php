<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@gmail.com',
            'role' => 'admin',
        ]);

        User::factory()->create([
            'name' => 'Student User',
            'email' => 'student@gmail.com',
            'role' => 'student',
        ]);
        User::factory()->create([
            'name' => 'Teacher User',
            'email' => 'teacher@gmail.com',
            'role' => 'teacher',
        ]);

        if (\App\Models\Video::count() === 0) {
            \App\Models\Video::create([
                'title' => 'Figma Masterclass: Pengenalan Design System',
                'description' => 'Pelajari cara membuat dan mengelola design system terstruktur di Figma dari awal untuk proyek besar.',
                'url_video' => 'https://www.youtube.com/watch?v=hzJVG6n9a-M'
            ]);
            \App\Models\Video::create([
                'title' => 'Dasar-Dasar React Hooks: useState & useEffect',
                'description' => 'Pahami konsep dasar React Hooks paling penting yaitu useState dan useEffect untuk state management komponen.',
                'url_video' => 'https://www.youtube.com/watch?v=Ke90Tje7VS0'
            ]);
            \App\Models\Video::create([
                'title' => 'Membangun RESTful API dengan Laravel 11',
                'description' => 'Panduan lengkap membuat RESTful API yang aman, cepat, dan terstandarisasi menggunakan framework Laravel 11.',
                'url_video' => 'https://www.youtube.com/watch?v=ImtZ5yENzgE'
            ]);
            \App\Models\Video::create([
                'title' => 'Product Management: Menentukan MVP untuk Startup',
                'description' => 'Belajar menentukan Minimum Viable Product (MVP) yang tepat, menganalisis feedback pengguna, dan merancang roadmap.',
                'url_video' => 'https://www.youtube.com/watch?v=hzJVG6n9a-M'
            ]);
            \App\Models\Video::create([
                'title' => 'Self Development: Mengatur Waktu dengan Teknik Pomodoro',
                'description' => 'Tingkatkan produktivitas belajar coding Anda menggunakan teknik Pomodoro dan bangun habit belajar harian konsisten.',
                'url_video' => 'https://www.youtube.com/watch?v=mNBmG24djoY'
            ]);
            \App\Models\Video::create([
                'title' => 'Advanced UI/UX: Implementasi Micro-interactions',
                'description' => 'Bagaimana merancang micro-interactions yang memikat pengguna dan menerapkannya dalam high-fidelity prototype Figma.',
                'url_video' => 'https://www.youtube.com/watch?v=hzJVG6n9a-M'
            ]);
        }
    }
}
