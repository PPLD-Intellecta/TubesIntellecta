<form action="{{ $action }}" method="POST" class="space-y-6">
    @csrf
    @if ($method !== 'POST')
        @method($method)
    @endif

    <div>
        <label for="student_id" class="block text-sm font-medium text-gray-700">Siswa</label>
        <select name="student_id" id="student_id" required
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-violet-500 focus:ring-violet-500">
            <option value="">Pilih siswa</option>
            @foreach ($students as $student)
                <option value="{{ $student->id }}" @selected(old('student_id', $feedback?->student_id) == $student->id)>
                    {{ $student->name }} ({{ $student->email }})
                </option>
            @endforeach
        </select>
        @error('student_id')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="quiz_id" class="block text-sm font-medium text-gray-700">Kuis (opsional)</label>
        <select name="quiz_id" id="quiz_id"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-violet-500 focus:ring-violet-500">
            <option value="">Tidak terkait kuis</option>
            @foreach ($quizzes as $quiz)
                <option value="{{ $quiz->id }}" @selected(old('quiz_id', $feedback?->quiz_id) == $quiz->id)>
                    {{ $quiz->title }}
                </option>
            @endforeach
        </select>
        @error('quiz_id')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="title" class="block text-sm font-medium text-gray-700">Judul</label>
        <input type="text" name="title" id="title" maxlength="255" required
               value="{{ old('title', $feedback?->title) }}"
               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-violet-500 focus:ring-violet-500">
        @error('title')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="score" class="block text-sm font-medium text-gray-700">Nilai Evaluasi (opsional)</label>
        <input type="number" step="0.01" min="0" max="100" name="score" id="score"
               value="{{ old('score', $feedback?->score) }}"
               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-violet-500 focus:ring-violet-500"
               placeholder="Contoh: 85">
        @error('score')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="message" class="block text-sm font-medium text-gray-700">Komentar/Masukan</label>
        <textarea name="message" id="message" rows="6" required
                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-violet-500 focus:ring-violet-500">{{ old('message', $feedback?->message) }}</textarea>
        @error('message')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div class="flex items-center gap-4">
        <button type="submit"
                class="inline-flex items-center rounded-md bg-violet-700 px-4 py-2 text-sm font-semibold text-white hover:bg-violet-800 focus:outline-none focus-visible:ring-2 focus-visible:ring-violet-600 focus-visible:ring-offset-2">
            Kirim Feedback
        </button>
        <a href="{{ route('teacher.feedbacks.index') }}" class="text-sm text-gray-600 hover:text-gray-900">Batal</a>
    </div>
</form>
