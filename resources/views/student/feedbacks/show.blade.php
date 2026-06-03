<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Detail Feedback
            </h2>
            <a href="{{ route('student.feedbacks.index') }}"
               class="inline-flex items-center rounded-md bg-gray-100 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-200">
                Kembali ke daftar
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 space-y-6 text-gray-900">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">{{ $feedback->title }}</h3>
                        <p class="mt-1 text-sm text-gray-500">
                            Dari {{ $feedback->teacher->name }} · {{ $feedback->created_at->format('d M Y, H:i') }}
                        </p>
                    </div>

                    <dl class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Pengajar</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $feedback->teacher->name }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Kuis Terkait</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $feedback->quiz?->title ?? 'Feedback umum' }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Nilai</dt>
                            <dd class="mt-1 text-sm text-gray-900">
                                {{ $feedback->score !== null ? rtrim(rtrim(number_format($feedback->score, 2, '.', ''), '0'), '.') : '—' }}
                            </dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Percobaan Kuis</dt>
                            <dd class="mt-1 text-sm text-gray-900">
                                @if ($feedback->quizAttempt)
                                    {{ $feedback->quizAttempt->quiz->title }} — Skor {{ $feedback->quizAttempt->score }}%
                                @else
                                    —
                                @endif
                            </dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Status</dt>
                            <dd class="mt-1 text-sm">
                                <span class="inline-flex rounded-full bg-green-100 px-2.5 py-0.5 text-xs font-medium text-green-800">
                                    Sudah dibaca
                                </span>
                                @if ($feedback->read_at)
                                    <span class="block text-gray-500 mt-1">{{ $feedback->read_at->format('d M Y, H:i') }}</span>
                                @endif
                            </dd>
                        </div>
                    </dl>

                    <div>
                        <dt class="text-sm font-medium text-gray-500 mb-2">Komentar/Masukan</dt>
                        <dd class="text-sm text-gray-800 whitespace-pre-wrap rounded-lg bg-violet-50 p-4 border border-violet-100">
                            {{ $feedback->message }}
                        </dd>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
