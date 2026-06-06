<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Intellecta - Study Planner</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

    <!-- Style Sheets -->
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 text-gray-800">
    <div class="dashboard-container" x-data="studyPlannerComponent()">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="sidebar-logo">
                Intellecta
            </div>
            <div class="sidebar-subtitle">Smart Learning</div>

            <ul class="sidebar-menu">
                <li class="sidebar-menu-item">
                    <a href="{{ route('dashboard') }}" class="sidebar-menu-link">
                        <svg class="sidebar-menu-icon" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M3 13h8V3H3v10zm0 8h8v-6H3v6zm10 0h8V11h-8v10zm0-18v6h8V3h-8z"/>
                        </svg>
                        Dashboard
                    </a>
                </li>

                <li class="sidebar-menu-item">
                    <a href="{{ route('student.quizzes.index') }}" class="sidebar-menu-link">
                        <svg class="sidebar-menu-icon" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M14 2H6c-1.1 0-2 .9-2 2v16c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V8l-6-6zm2 16H8v-2h8v2zm0-4H8v-2h8v2zm-3-5V3.5L18.5 9H13z"/>
                        </svg>
                        Kuis & Evaluasi
                    </a>
                </li>

                <li class="sidebar-menu-item">
                    <a href="{{ route('subscription.index') }}" class="sidebar-menu-link">
                        <svg class="sidebar-menu-icon" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M11.5 2C6.81 2 3 5.81 3 10.5S6.81 19 11.5 19h.5v3c4.86-2.34 8-7 8-11.5C20 5.81 16.19 2 11.5 2zm1 14.5h-2v-2h2v2zm0-4h-2c0-3.25 3-3 3-5 0-1.1-.9-2-2-2s-2 .9-2 2h-2c0-2.21 1.79-4 4-4s4 1.79 4 4c0 2.5-3 2.75-3 5z"/>
                        </svg>
                        Paket Belajar
                    </a>
                </li>

                <li class="sidebar-menu-item">
                    <a href="{{ route('student.videos.index') }}" class="sidebar-menu-link">
                        <svg class="sidebar-menu-icon" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M17 10.5V7c0-.55-.45-1-1-1H4c-.55 0-1 .45-1 1v10c0 .55.45 1 1 1h12c.55 0 1-.45 1-1v-3.5l4 4v-11l-4 4z"/>
                        </svg>
                        Materi Video
                    </a>
                </li>

                <li class="sidebar-menu-item">
                    <a href="{{ route('student.live-schedule.index') }}" class="sidebar-menu-link">
                        <svg class="sidebar-menu-icon" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                        </svg>
                        Kelas Live
                    </a>
                </li>

                <li class="sidebar-menu-item">
                    <a href="{{ route('student.planner.index') }}" class="sidebar-menu-link active">
                        <svg class="sidebar-menu-icon text-purple-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        Study Planner
                    </a>
                </li>

                <li class="sidebar-menu-item" style="margin-top: 2rem;">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="sidebar-menu-link" style="width: 100%; border: none; background: none; text-align: left; cursor: pointer; color: #ef4444;">
                            <svg class="sidebar-menu-icon" fill="currentColor" viewBox="0 0 24 24" style="color: #ef4444;">
                                <path d="M17 7l-1.41 1.41L18.17 11H8v2h10.17l-2.58 2.58L17 17l5-5zM4 5h8V3H4c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h8v-2H4V5z"/>
                            </svg>
                            Logout
                        </button>
                    </form>
                </li>
            </ul>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <!-- Header & Flash Alerts -->
            <div class="max-w-7xl mx-auto">
                @if(session('success'))
                    <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-700 rounded-xl flex items-center justify-between shadow-sm animate-fade-in">
                        <div class="flex items-center gap-2">
                            <span>✅</span>
                            <span class="font-medium text-sm">{{ session('success') }}</span>
                        </div>
                        <button onclick="this.parentElement.remove()" class="text-green-500 hover:text-green-700 text-xs">✕</button>
                    </div>
                @endif

                @if($errors->any())
                    <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-700 rounded-xl shadow-sm">
                        <div class="font-semibold text-sm mb-1">Terjadi kesalahan input:</div>
                        <ul class="list-disc list-inside text-xs space-y-0.5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8">
                    <div>
                        <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">📅 Study Planner</h1>
                        <p class="text-gray-500 mt-1 text-sm">Atur target belajar harian dan pantau progressmu secara konsisten</p>
                    </div>
                    <div class="flex items-center gap-3">
                        <span class="px-4 py-2 bg-amber-50 border border-amber-200 text-amber-800 text-sm font-extrabold rounded-full shadow-sm flex items-center gap-1.5 transition-all hover:scale-105">
                            🔥 <span x-text="streak"></span> Hari Streak
                        </span>
                        <button @click="openAddModal()" 
                                class="px-5 py-2.5 bg-purple-600 text-white font-semibold rounded-xl text-sm shadow-md hover:bg-purple-700 hover:shadow-lg hover:shadow-purple-500/20 active:scale-95 transition-all duration-200">
                            + Tambah Target
                        </button>
                    </div>
                </div>

                <!-- 3-Column Grid Layout -->
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">
                    
                    <!-- Left: Weekly Calendar (col-span-4) -->
                    <div class="lg:col-span-4 bg-white rounded-2xl border border-purple-100 shadow-sm p-6 hover:shadow-md transition-all duration-300">
                        <div class="flex justify-between items-center mb-5">
                            <h3 class="text-base font-bold text-gray-800">Minggu Ini</h3>
                            <!-- Clear filter indicator -->
                            <button x-show="selectedCalendarDate" @click="selectedCalendarDate = ''" 
                                    class="text-xs text-purple-600 hover:text-purple-800 font-semibold flex items-center gap-1">
                                ✕ Reset Hari
                            </button>
                        </div>
                        
                        <div class="grid grid-cols-7 gap-2 text-center text-sm mb-4">
                            <!-- Day Headers -->
                            @foreach(['Min','Sen','Sel','Rab','Kam','Jum','Sab'] as $dayName)
                                <div class="text-[10px] font-extrabold text-gray-400 uppercase tracking-wider py-1">{{ $dayName }}</div>
                            @endforeach

                            <!-- Calendar Days -->
                            @foreach($weekDays as $day)
                                @php
                                    $dayStr = $day->date->toDateString();
                                @endphp
                                <div @click="toggleDateFilter('{{ $dayStr }}')"
                                     :class="{
                                         'border-purple-600 bg-purple-50 ring-2 ring-purple-500/20': selectedCalendarDate === '{{ $dayStr }}',
                                         'border-purple-300 bg-purple-50/50': '{{ $day->isToday() }}' && selectedCalendarDate !== '{{ $dayStr }}',
                                         'border-gray-100 hover:border-purple-200 hover:bg-gray-50': !('{{ $day->isToday() }}') && selectedCalendarDate !== '{{ $dayStr }}'
                                     }"
                                     class="relative p-2.5 rounded-xl border transition-all duration-200 cursor-pointer group flex flex-col items-center justify-between min-h-[56px]">
                                    
                                    <span :class="{
                                              'text-purple-700 font-bold': selectedCalendarDate === '{{ $dayStr }}' || '{{ $day->isToday() }}',
                                              'text-gray-700 font-medium': selectedCalendarDate !== '{{ $dayStr }}' && !('{{ $day->isToday() }}')
                                          }"
                                          class="text-xs">
                                        {{ $day->date->format('j') }}
                                    </span>
                                    
                                    <!-- Task Indicators -->
                                    @if($day->goals->count() > 0)
                                        <div class="mt-1.5 flex justify-center gap-0.5 flex-wrap w-full">
                                            @foreach($day->goals->take(3) as $g)
                                                <div class="w-1.5 h-1.5 rounded-full {{ $g->status === 'completed' ? 'bg-green-500' : 'bg-purple-500' }} group-hover:scale-125 transition-transform"></div>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>

                        <!-- Legend -->
                        <div class="mt-5 pt-4 border-t border-gray-100 flex items-center gap-4 text-xs text-gray-500 font-semibold">
                            <span class="flex items-center gap-1.5"><span class="w-2.5 h-2.5 rounded-full bg-green-500"></span> Selesai</span>
                            <span class="flex items-center gap-1.5"><span class="w-2.5 h-2.5 rounded-full bg-purple-500"></span> Tertunda</span>
                        </div>
                    </div>

                    <!-- Center: Task List (col-span-5) -->
                    <div class="lg:col-span-5 space-y-4">
                        <!-- Filter Tabs & Active Date Badge -->
                        <div class="flex flex-wrap items-center justify-between gap-3">
                            <div class="flex gap-1.5 p-1 bg-gray-100 rounded-xl w-fit">
                                <button @click="filter = 'all'" :class="filter === 'all' ? 'bg-white shadow text-purple-700 font-bold' : 'text-gray-500 hover:text-gray-700 font-semibold'"
                                        class="px-3.5 py-1.5 text-xs rounded-lg transition-all duration-200">Semua</button>
                                <button @click="filter = 'pending'" :class="filter === 'pending' ? 'bg-white shadow text-purple-700 font-bold' : 'text-gray-500 hover:text-gray-700 font-semibold'"
                                        class="px-3.5 py-1.5 text-xs rounded-lg transition-all duration-200">Pending</button>
                                <button @click="filter = 'completed'" :class="filter === 'completed' ? 'bg-white shadow text-purple-700 font-bold' : 'text-gray-500 hover:text-gray-700 font-semibold'"
                                        class="px-3.5 py-1.5 text-xs rounded-lg transition-all duration-200">Selesai</button>
                            </div>

                            <template x-if="selectedCalendarDate">
                                <div class="px-3 py-1.5 bg-purple-100 text-purple-800 text-xs font-bold rounded-lg border border-purple-200 flex items-center gap-1.5">
                                    📅 Hari: <span x-text="formatDateLabel(selectedCalendarDate)"></span>
                                </div>
                            </template>
                        </div>

                        <!-- Task Cards Container -->
                        <div class="space-y-3.5">
                            <template x-for="goal in filteredGoals" :key="goal.id">
                                <div :class="{'border-l-4 border-l-green-500': goal.status === 'completed', 'border-l-4 border-l-purple-500': goal.status === 'pending', 'border-l-4 border-l-red-500': goal.status === 'overdue'}"
                                     class="bg-white rounded-2xl border border-gray-100 p-4.5 hover:border-purple-200 hover:shadow-md hover:-translate-y-0.5 transition-all duration-300 group flex items-start justify-between gap-4">
                                    
                                    <div class="flex items-start gap-3.5 flex-1 min-w-0">
                                        <!-- Checkbox -->
                                        <label class="relative flex items-center mt-1 cursor-pointer">
                                            <input type="checkbox" class="sr-only" 
                                                   :checked="goal.status === 'completed'"
                                                   @change="toggleGoal(goal.id, $event.target.checked)">
                                            <div :class="goal.status === 'completed' ? 'bg-purple-600 border-purple-600' : 'border-gray-300 bg-white'"
                                                 class="w-5.5 h-5.5 border-2 rounded-lg flex items-center justify-center transition-all duration-200 hover:border-purple-500">
                                                <svg class="w-3.5 h-3.5 text-white" :class="goal.status === 'completed' ? 'opacity-100' : 'opacity-0'" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                                                </svg>
                                            </div>
                                        </label>

                                        <!-- Content -->
                                        <div class="flex-1 min-w-0">
                                            <h4 :class="goal.status === 'completed' ? 'text-gray-400 line-through' : 'text-gray-800'"
                                                class="text-base font-extrabold group-hover:text-purple-700 transition-colors truncate"
                                                x-text="goal.title">
                                            </h4>
                                            <p class="text-xs text-gray-500 mt-1 line-clamp-2" x-text="goal.description || 'Tidak ada deskripsi'"></p>
                                            
                                            <div class="flex items-center gap-3 mt-3.5 text-[10px] text-gray-400 font-extrabold uppercase">
                                                <!-- Priority Badge -->
                                                <span :class="{
                                                          'bg-red-50 text-red-600 border border-red-100': goal.priority === 'high',
                                                          'bg-amber-50 text-amber-700 border border-amber-100': goal.priority === 'medium',
                                                          'bg-green-50 text-green-600 border border-green-100': goal.priority === 'low'
                                                      }"
                                                      class="px-2.5 py-0.5 rounded-full font-bold">
                                                    <span x-text="goal.priority"></span>
                                                </span>
                                                <!-- Target Date -->
                                                <span class="bg-gray-50 px-2 py-0.5 rounded border border-gray-100 flex items-center gap-1">
                                                    📅 <span x-text="formatDateLabel(goal.target_date)"></span>
                                                </span>
                                                <!-- Estimated Minutes -->
                                                <span class="bg-gray-50 px-2 py-0.5 rounded border border-gray-100 flex items-center gap-1">
                                                    ⏱️ <span x-text="goal.estimated_minutes"></span> mnt
                                                </span>
                                                <!-- Overdue Badge -->
                                                <template x-if="goal.status === 'overdue'">
                                                    <span class="bg-red-100 text-red-700 border border-red-200 px-2.5 py-0.5 rounded-full font-extrabold">Terlambat</span>
                                                </template>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Actions -->
                                    <div class="flex gap-1.5 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                        <button @click="openEditModal(goal)" 
                                                class="p-2 text-gray-400 hover:text-purple-600 hover:bg-purple-50 rounded-xl transition-all"
                                                title="Edit Target">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                            </svg>
                                        </button>
                                        
                                        <form :action="'/student/study-planner/goals/' + goal.id" method="POST" class="inline" @submit="confirmDelete($event)">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="p-2 text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-xl transition-all"
                                                    title="Hapus Target">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </template>

                            <!-- Empty State -->
                            <div x-show="filteredGoals.length === 0" class="text-center py-14 text-gray-400 bg-white rounded-2xl border border-purple-50 shadow-sm">
                                <svg class="w-14 h-14 mx-auto mb-3.5 text-purple-300 opacity-60" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                </svg>
                                <p class="text-sm font-semibold text-gray-600">Belum ada target belajar untuk filter ini.</p>
                                <p class="text-xs text-gray-400 mt-1">Mulai tambahkan target belajarmu sekarang!</p>
                            </div>
                        </div>
                    </div>

                    <!-- Right: Stats & Quick Add (col-span-3) -->
                    <div class="lg:col-span-3 space-y-5">
                        
                        <!-- Progress Card -->
                        <div class="bg-gradient-to-br from-purple-600 to-purple-800 rounded-2xl p-5 text-white shadow-lg relative overflow-hidden group">
                            <!-- Background decoration -->
                            <div class="absolute -right-10 -bottom-10 w-28 h-28 bg-white/10 rounded-full blur-xl group-hover:scale-110 transition-transform"></div>
                            
                            <h3 class="text-xs font-bold uppercase tracking-wider opacity-75 mb-1">Progress Minggu Ini</h3>
                            <div class="text-3xl font-extrabold mb-2.5">
                                <span x-text="completedCount"></span>/<span x-text="totalCount"></span>
                            </div>
                            
                            <!-- Progress Bar -->
                            <div class="w-full bg-white/20 rounded-full h-2 mb-3.5">
                                <div class="bg-white h-2 rounded-full transition-all duration-700 ease-out" 
                                     :style="'width: ' + (totalCount > 0 ? (completedCount / totalCount) * 100 : 0) + '%'"></div>
                            </div>
                            
                            <div class="flex items-center gap-1.5 text-xs font-bold opacity-90">
                                <span>⏱️</span>
                                <span><span x-text="totalMinutes"></span> menit belajar tercapai</span>
                            </div>
                        </div>

                        <!-- Quick Add Form -->
                        <div class="bg-white rounded-2xl border border-purple-100 p-5 shadow-sm hover:shadow-md transition-all duration-300">
                            <h3 class="text-base font-bold text-gray-800 mb-4 flex items-center gap-1.5">
                                ⚡ Tambah Target Cepat
                            </h3>
                            
                            <form action="{{ route('student.planner.goals.store') }}" method="POST" class="space-y-3.5">
                                @csrf
                                <div>
                                    <input type="text" name="title" placeholder="Contoh: Belajar React Hooks" required
                                           class="w-full px-3.5 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent hover:border-purple-200 transition-all duration-200">
                                </div>
                                
                                <div class="grid grid-cols-2 gap-2.5">
                                    <input type="date" name="target_date" required :value="selectedCalendarDate || '{{ now()->timezone('Asia/Jakarta')->toDateString() }}'"
                                           class="px-3 py-2.5 border border-gray-200 rounded-xl text-xs focus:outline-none focus:ring-2 focus:ring-purple-500 hover:border-purple-200 transition-all">
                                    
                                    <select name="priority" class="px-2 py-2.5 border border-gray-200 rounded-xl text-xs focus:outline-none focus:ring-2 focus:ring-purple-500 hover:border-purple-200 transition-all">
                                        <option value="low">🟢 Rendah</option>
                                        <option value="medium" selected>🟡 Sedang</option>
                                        <option value="high">🔴 Tinggi</option>
                                    </select>
                                </div>

                                <input type="hidden" name="estimated_minutes" value="30">

                                <button type="submit" 
                                        class="w-full py-2.5 bg-purple-50 text-purple-700 font-bold rounded-xl text-xs hover:bg-purple-100 active:scale-95 transition-all duration-200">
                                    Simpan Target
                                </button>
                            </form>
                        </div>

                        <!-- Daily Check-in Form -->
                        <div class="bg-white rounded-2xl border border-purple-100 p-5 shadow-sm hover:shadow-md transition-all duration-300">
                            <h3 class="text-base font-bold text-gray-800 mb-3.5 flex items-center gap-1.5">
                                📝 Check-in Harian
                            </h3>
                            <p class="text-xs text-gray-500 mb-4">Catat secara manual sesi belajar mandirimu di luar target kuis/materi.</p>
                            
                            <form action="{{ route('student.planner.checkins.store') }}" method="POST" class="space-y-3.5">
                                @csrf
                                <div>
                                    <label class="block text-[10px] font-extrabold text-gray-400 uppercase mb-1">Tanggal Check-in</label>
                                    <input type="date" name="checkin_date" required :value="selectedCalendarDate || '{{ now()->timezone('Asia/Jakarta')->toDateString() }}'"
                                           class="w-full px-3.5 py-2 border border-gray-200 rounded-xl text-xs focus:outline-none focus:ring-2 focus:ring-purple-500 hover:border-purple-200 transition-all">
                                </div>

                                <div>
                                    <label class="block text-[10px] font-extrabold text-gray-400 uppercase mb-1">Durasi Belajar (Menit)</label>
                                    <input type="number" name="study_minutes" min="1" max="1440" required placeholder="Contoh: 60"
                                           class="w-full px-3.5 py-2 border border-gray-200 rounded-xl text-xs focus:outline-none focus:ring-2 focus:ring-purple-500 hover:border-purple-200 transition-all">
                                </div>

                                <div>
                                    <label class="block text-[10px] font-extrabold text-gray-400 uppercase mb-1">Catatan</label>
                                    <textarea name="notes" rows="2" placeholder="Tuliskan apa yang kamu pelajari hari ini..."
                                              class="w-full px-3.5 py-2 border border-gray-200 rounded-xl text-xs focus:outline-none focus:ring-2 focus:ring-purple-500 hover:border-purple-200 transition-all resize-none"></textarea>
                                </div>

                                <button type="submit" 
                                        class="w-full py-2.5 bg-teal-50 text-teal-700 font-bold rounded-xl text-xs hover:bg-teal-100 active:scale-95 transition-all duration-200">
                                    Kirim Check-in
                                </button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>

            <!-- Footer -->
            <footer class="dashboard-footer" style="margin-top: 4rem;">
                <div>
                    <div class="footer-brand">Intellecta</div>
                    <div class="footer-copyright">© 2024 Intellecta Indonesia, Learning Hub CPDI Sai Universitas Urbanus</div>
                </div>
                <div class="footer-links">
                    <a href="#" class="footer-link">Kebijakan Privasi</a>
                    <a href="#" class="footer-link">Syarat & Layanan</a>
                    <a href="#" class="footer-link">Hubungi Dukungan</a>
                </div>
            </footer>
        </main>

        <!-- Alpine.js Modal for Add/Edit Goal -->
        <div x-show="showGoalModal" 
             class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50 backdrop-blur-sm animate-fade-in"
             style="display: none;"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0">
            
            <div class="bg-white w-full max-w-lg rounded-2xl shadow-2xl border border-purple-100 overflow-hidden transform transition-all p-6"
                 @click.away="showGoalModal = false"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 scale-95"
                 x-transition:enter-end="opacity-100 scale-100"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100 scale-100"
                 x-transition:leave-end="opacity-0 scale-95">
                
                <div class="flex justify-between items-center pb-4 border-b border-gray-100 mb-5">
                    <h3 class="text-lg font-bold text-gray-900" x-text="isEditMode ? '📝 Edit Target Belajar' : '📅 Tambah Target Belajar'"></h3>
                    <button @click="showGoalModal = false" class="text-gray-400 hover:text-gray-600 text-lg font-semibold">✕</button>
                </div>

                <form :action="isEditMode ? '/student/study-planner/goals/' + goalId : '{{ route('student.planner.goals.store') }}'" method="POST" class="space-y-4">
                    @csrf
                    <!-- Bind PUT method if editing -->
                    <template x-if="isEditMode">
                        <input type="hidden" name="_method" value="PUT">
                    </template>

                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase mb-1.5">Judul Target</label>
                        <input type="text" name="title" required x-model="goalTitle" placeholder="Contoh: Menyelesaikan kuis Javascript dasar"
                               class="w-full px-3.5 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent hover:border-purple-200 transition-all duration-200">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase mb-1.5">Deskripsi / Rencana Belajar (Opsional)</label>
                        <textarea name="description" rows="3" x-model="goalDescription" placeholder="Contoh: Membaca referensi di MDN docs, latihan menulis script di sandbox..."
                                  class="w-full px-3.5 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent hover:border-purple-200 transition-all duration-200 resize-none"></textarea>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-1.5">Tanggal Target</label>
                            <input type="date" name="target_date" required x-model="goalTargetDate"
                                   class="w-full px-3.5 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent hover:border-purple-200 transition-all duration-200">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-1.5">Prioritas</label>
                            <select name="priority" required x-model="goalPriority"
                                    class="w-full px-3.5 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent hover:border-purple-200 transition-all duration-200">
                                <option value="low">🟢 Rendah</option>
                                <option value="medium">🟡 Sedang</option>
                                <option value="high">🔴 Tinggi</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase mb-1.5">Estimasi Durasi Belajar (Menit)</label>
                        <input type="number" name="estimated_minutes" required min="5" max="1440" x-model="goalEstimatedMinutes"
                               class="w-full px-3.5 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent hover:border-purple-200 transition-all duration-200">
                    </div>

                    <div class="flex justify-end gap-3 pt-4 border-t border-gray-100 mt-6">
                        <button type="button" @click="showGoalModal = false"
                                class="px-4.5 py-2 bg-gray-100 text-gray-700 font-semibold rounded-xl text-sm hover:bg-gray-200 transition-all duration-200">
                            Batal
                        </button>
                        <button type="submit" 
                                class="px-5 py-2 bg-purple-600 text-white font-semibold rounded-xl text-sm shadow-md hover:bg-purple-700 active:scale-95 transition-all duration-200">
                            Simpan Target
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Toast Notifications (Alpine.js powered) -->
        <div x-show="showToast" 
             style="display: none;"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="translate-y-4 opacity-0"
             x-transition:enter-end="translate-y-0 opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="translate-y-0 opacity-100"
             x-transition:leave-end="translate-y-4 opacity-0"
             class="fixed bottom-5 right-5 z-50 p-4 bg-gray-900 text-white rounded-xl shadow-2xl border border-gray-800 max-w-sm flex items-center gap-3 animate-fade-in">
            <span class="text-purple-400">✨</span>
            <p class="text-xs font-semibold" x-text="toastMessage"></p>
        </div>
    </div>

    <!-- Alpine.js Component Script Registration -->
    <script>
        function studyPlannerComponent() {
            return {
                filter: 'all',
                showGoalModal: false,
                isEditMode: false,
                goalId: null,
                goalTitle: '',
                goalDescription: '',
                goalTargetDate: '',
                goalPriority: 'medium',
                goalEstimatedMinutes: 30,

                streak: {{ $streak }},
                completedCount: {{ $completedGoals }},
                totalCount: {{ $totalGoals }},
                totalMinutes: {{ $totalStudyMinutes }},
                goals: @json($goals),

                selectedCalendarDate: '',

                toastMessage: '',
                showToast: false,

                get filteredGoals() {
                    let list = this.goals;

                    // 1. Filter by clicked calendar day
                    if (this.selectedCalendarDate !== '') {
                        list = list.filter(goal => {
                            const goalDate = goal.target_date.split('T')[0];
                            return goalDate === this.selectedCalendarDate;
                        });
                    }

                    // 2. Filter by status tabs (Semua/Pending/Selesai)
                    if (this.filter === 'pending') {
                        return list.filter(goal => goal.status === 'pending' || goal.status === 'overdue');
                    } else if (this.filter === 'completed') {
                        return list.filter(goal => goal.status === 'completed');
                    }

                    return list;
                },

                openAddModal(dateStr = '') {
                    this.isEditMode = false;
                    this.goalId = null;
                    this.goalTitle = '';
                    this.goalDescription = '';
                    this.goalTargetDate = dateStr || this.selectedCalendarDate || '{{ now()->timezone('Asia/Jakarta')->toDateString() }}';
                    this.goalPriority = 'medium';
                    this.goalEstimatedMinutes = 30;
                    this.showGoalModal = true;
                },

                openEditModal(goal) {
                    this.isEditMode = true;
                    this.goalId = goal.id;
                    this.goalTitle = goal.title;
                    this.goalDescription = goal.description || '';
                    this.goalTargetDate = goal.target_date.split('T')[0];
                    this.goalPriority = goal.priority;
                    this.goalEstimatedMinutes = goal.estimated_minutes;
                    this.showGoalModal = true;
                },

                toggleDateFilter(dateStr) {
                    if (this.selectedCalendarDate === dateStr) {
                        this.selectedCalendarDate = ''; // Deselect
                    } else {
                        this.selectedCalendarDate = dateStr;
                    }
                },

                formatDateLabel(dateVal) {
                    if (!dateVal) return '';
                    const dateObj = new Date(dateVal);
                    if (isNaN(dateObj.getTime())) return dateVal;
                    
                    const months = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
                    return `${dateObj.getDate()} ${months[dateObj.getMonth()]}`;
                },

                async toggleGoal(goalId, isChecked) {
                    try {
                        const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                        const res = await fetch(`/student/study-planner/goals/${goalId}/toggle`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': token
                            },
                            body: JSON.stringify({ completed: isChecked })
                        });

                        if (!res.ok) {
                            throw new Error('Gagal memperbarui target.');
                        }

                        const data = await res.json();
                        if (data.success) {
                            // Update goal in local state
                            const index = this.goals.findIndex(g => g.id === goalId);
                            if (index !== -1) {
                                this.goals[index].status = data.status;
                            }

                            // Update stats
                            this.streak = data.streak;
                            this.completedCount = data.completed;
                            this.totalCount = data.total;
                            this.totalMinutes = data.minutes;

                            const statusText = data.status === 'completed' ? 'Target diselesaikan! ✨' : 'Target diubah kembali ke pending.';
                            this.showToastNotification(statusText);
                        }
                    } catch (err) {
                        console.error(err);
                        this.showToastNotification('Kesalahan jaringan: Gagal memperbarui target.');
                    }
                },

                showToastNotification(msg) {
                    this.toastMessage = msg;
                    this.showToast = true;
                    setTimeout(() => {
                        this.showToast = false;
                    }, 3000);
                },

                confirmDelete(event) {
                    if (!confirm('Apakah Anda yakin ingin menghapus target belajar ini?')) {
                        event.preventDefault();
                    }
                }
            };
        }
    </script>
    @stack('scripts')
</body>
</html>
