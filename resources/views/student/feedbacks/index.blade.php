<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Feedback dari Pengajar
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Judul</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pengajar</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kuis</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nilai</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($feedbacks as $feedback)
                                <tr class="{{ ! $feedback->is_read ? 'bg-violet-50/50' : '' }}">
                                    <td class="px-4 py-4 text-sm font-medium text-gray-900">
                                        {{ $feedback->title }}
                                        @if (! $feedback->is_read)
                                            <span class="ml-2 inline-flex rounded-full bg-violet-100 px-2 py-0.5 text-xs font-medium text-violet-800">Baru</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-4 text-sm text-gray-600">{{ $feedback->teacher->name }}</td>
                                    <td class="px-4 py-4 text-sm text-gray-600">{{ $feedback->quiz?->title ?? '—' }}</td>
                                    <td class="px-4 py-4 text-sm text-gray-600">{{ $feedback->score !== null ? rtrim(rtrim(number_format($feedback->score, 2, '.', ''), '0'), '.') : '—' }}</td>
                                    <td class="px-4 py-4 text-sm">
                                        @if ($feedback->is_read)
                                            <span class="inline-flex rounded-full bg-green-100 px-2.5 py-0.5 text-xs font-medium text-green-800">Sudah dibaca</span>
                                        @else
                                            <span class="inline-flex rounded-full bg-amber-100 px-2.5 py-0.5 text-xs font-medium text-amber-800">Belum dibaca</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-4 text-sm text-gray-600">{{ $feedback->created_at->format('d M Y H:i') }}</td>
                                    <td class="px-4 py-4 text-sm">
                                        <a href="{{ route('student.feedbacks.show', $feedback) }}"
                                           class="text-violet-700 hover:text-violet-900 font-medium">
                                            Buka
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-4 py-8 text-center text-sm text-gray-500">
                                        Belum ada feedback dari pengajar.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
