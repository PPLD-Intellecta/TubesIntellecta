<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Intellecta - Upload Materi</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <style>
        .form-group { margin-bottom: 1.5rem; }
        .form-label {
            display: block;
            font-weight: 500;
            margin-bottom: 0.5rem;
            color: #374151;
        }
        .form-input,
        .form-textarea {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1px solid #d1d5db;
            border-radius: 0.5rem;
            font-family: inherit;
            font-size: 0.9375rem;
            background: #fff;
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
        }
        .form-input:focus,
        .form-textarea:focus {
            outline: none;
            border-color: #7c3aed;
            box-shadow: 0 0 0 3px rgba(124, 58, 237, 0.15);
        }
        .form-input::placeholder,
        .form-textarea::placeholder {
            color: #9ca3af;
        }
        .form-hint {
            margin-top: 0.375rem;
            font-size: 0.8125rem;
            color: #6b7280;
            line-height: 1.5;
        }
        .form-error {
            margin-top: 0.375rem;
            font-size: 0.8125rem;
            color: #dc2626;
        }
        .upload-card {
            border: 2px dashed #c4b5fd;
            border-radius: 0.75rem;
            padding: 1.5rem;
            background: linear-gradient(180deg, #faf5ff 0%, #f5f3ff 100%);
            text-align: center;
            transition: border-color 0.2s ease, background 0.2s ease;
        }
        .upload-card:hover {
            border-color: #a78bfa;
            background: linear-gradient(180deg, #f5f3ff 0%, #ede9fe 100%);
        }
        .upload-card.has-file {
            border-style: solid;
            border-color: #7c3aed;
            background: #faf5ff;
        }
        .upload-icon {
            width: 2.75rem;
            height: 2.75rem;
            margin: 0 auto 0.75rem;
            color: #7c3aed;
        }
        .upload-title {
            font-weight: 600;
            color: #5b21b6;
            margin-bottom: 0.25rem;
        }
        .upload-file-input {
            margin-top: 1rem;
            width: 100%;
            max-width: 20rem;
            margin-left: auto;
            margin-right: auto;
            font-size: 0.875rem;
            color: #4b5563;
        }
        .file-preview {
            margin-top: 0.75rem;
            padding: 0.5rem 0.75rem;
            border-radius: 0.375rem;
            background: #ede9fe;
            color: #5b21b6;
            font-size: 0.875rem;
            font-weight: 500;
            word-break: break-all;
            display: none;
        }
        .file-preview.visible {
            display: inline-block;
        }
        .form-card {
            background: white;
            padding: 2rem;
            border-radius: 0.75rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08), 0 4px 12px rgba(124, 58, 237, 0.06);
        }
        .form-actions {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem;
            margin-top: 0.5rem;
        }
        .btn-primary {
            background: #7c3aed;
            color: white;
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 0.5rem;
            font-weight: 600;
            cursor: pointer;
            font-size: 0.9375rem;
            transition: background 0.2s ease, transform 0.15s ease;
        }
        .btn-primary:hover {
            background: #6d28d9;
        }
        .btn-primary:focus-visible {
            outline: none;
            box-shadow: 0 0 0 3px rgba(124, 58, 237, 0.35);
        }
        .btn-primary:active {
            transform: scale(0.98);
        }
        .btn-cancel {
            color: #6b7280;
            text-decoration: none;
            font-size: 0.9375rem;
        }
        .btn-cancel:hover {
            color: #374151;
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        @include('teacher.partials.sidebar', ['active' => 'materi'])

        <main class="main-content">
            <div class="content-header">
                <div class="greeting">Upload Materi</div>
                <div class="greeting-subtitle">Unggah file materi pembelajaran untuk siswa.</div>
            </div>

            <div class="form-card">
                <form action="{{ route('teacher.materi.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="judul" class="form-label">Judul Materi</label>
                        <input
                            type="text"
                            id="judul"
                            name="judul"
                            class="form-input"
                            value="{{ old('judul') }}"
                            required
                            placeholder="Contoh: Modul Aljabar Linear Bab 1"
                        >
                        @error('judul')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <textarea
                            id="deskripsi"
                            name="deskripsi"
                            class="form-textarea"
                            rows="4"
                            placeholder="Tulis ringkasan singkat isi materi ini..."
                        >{{ old('deskripsi') }}</textarea>
                        @error('deskripsi')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="file_materi" class="form-label">File Materi</label>
                        <div class="upload-card" id="upload-card">
                            <svg class="upload-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5" />
                            </svg>
                            <p class="upload-title">Pilih atau seret file ke sini</p>
                            <p class="form-hint" style="margin-top: 0;">Format file: PDF, DOC, DOCX, PPT, PPTX. Maksimal 20 MB.</p>
                            <input
                                type="file"
                                id="file_materi"
                                name="file_materi"
                                class="upload-file-input"
                                accept=".pdf,.doc,.docx,.ppt,.pptx"
                                required
                            >
                            <span id="file-preview" class="file-preview" role="status" aria-live="polite"></span>
                        </div>
                        @error('file_materi')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn-primary">Upload Materi</button>
                        <a href="{{ route('teacher.materi.index') }}" class="btn-cancel">Batal</a>
                    </div>
                </form>
            </div>
        </main>
    </div>

    <script>
        (function () {
            var fileInput = document.getElementById('file_materi');
            var preview = document.getElementById('file-preview');
            var uploadCard = document.getElementById('upload-card');

            if (!fileInput || !preview || !uploadCard) {
                return;
            }

            fileInput.addEventListener('change', function () {
                if (fileInput.files && fileInput.files.length > 0) {
                    preview.textContent = 'File dipilih: ' + fileInput.files[0].name;
                    preview.classList.add('visible');
                    uploadCard.classList.add('has-file');
                } else {
                    preview.textContent = '';
                    preview.classList.remove('visible');
                    uploadCard.classList.remove('has-file');
                }
            });
        })();
    </script>
</body>
</html>
