@extends('layout.app')
@section('title', 'Asesmen Minat')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8 col-md-10">
        
        <div class="mb-5 fade-in-up">
            <div class="d-flex justify-content-between align-items-end mb-3">
                <div>
                    <h2 class="fw-bold mb-1" style="color: var(--nk-dark); letter-spacing: -0.5px;">Asesmen Minat</h2>
                    <div class="d-flex align-items-center gap-2 text-muted small">
                        <i class="fas fa-user-circle text-primary"></i> 
                        <span class="fw-bold">{{ request('fullname') }}</span>
                        <span class="mx-1">•</span>
                        <span>{{ request('class_grade') }}</span>
                    </div>
                </div>
                <div class="text-end">
                    <span class="fw-bold fs-4" style="color: var(--nk-primary);" id="progress-text">0%</span>
                    <span class="text-muted small d-block">Selesai</span>
                </div>
            </div>
            
            <div class="progress" style="height: 12px; border-radius: 20px; background-color: #eef2f6; box-shadow: inset 0 1px 2px rgba(0,0,0,0.05);">
                <div class="progress-bar progress-bar-striped progress-bar-animated" id="progress-bar" role="progressbar" 
                     style="width: 0%; background: var(--nk-primary); border-radius: 20px;">
                </div>
            </div>
        </div>

        <form action="{{ route('test.submit') }}" method="POST" id="quizForm">
            @csrf
            <input type="hidden" name="fullname" value="{{ request('fullname') }}">
            <input type="hidden" name="class_grade" value="{{ request('class_grade') }}">

            @if($questions->count() > 0)
                @foreach($questions->chunk(5) as $chunkIndex => $chunk)
                    <div class="step-section {{ $chunkIndex > 0 ? 'd-none' : '' }}" id="step-{{ $chunkIndex }}">
                        
                        <div class="card-modern bg-white p-4 p-md-5 border-0 shadow-lg fade-in-up">
                            
                            <div class="d-flex justify-content-between align-items-center mb-5 p-3 rounded-4 bg-light border border-light">
                                <h5 class="fw-bold m-0" style="color: var(--nk-dark);">
                                    <span class="badge bg-primary me-2 rounded-pill px-3">Bagian {{ $chunkIndex + 1 }}</span>
                                </h5>
                                <div class="d-flex align-items-center gap-3 small fw-bold text-muted">
                                    <span><i class="fas fa-arrow-left text-danger me-1"></i> Tidak Suka</span>
                                    <span class="text-primary">Suka <i class="fas fa-arrow-right ms-1"></i></span>
                                </div>
                            </div>

                            @foreach($chunk as $index => $question)
                            <div class="mb-5 question-item" data-id="{{ $question->id }}">
                                <div class="d-flex gap-3 mb-4">
                                    <span class="fw-bold text-secondary" style="font-size: 1.2rem; min-width: 30px;">
                                        {{ $loop->parent->first ? $index + 1 : ($chunkIndex * 5) + $index + 1 }}.
                                    </span>
                                    <p class="fw-bold text-dark mb-0" style="font-size: 1.2rem; line-height: 1.5;">
                                        {{ $question->question_text }}
                                    </p>
                                </div>
                                
                                <div class="scale-container d-flex justify-content-between align-items-center px-1 px-md-3">
                                    
                                    <label class="scale-option">
                                        <input type="radio" name="answers[{{ $question->id }}]" value="1_cat{{$question->category_id}}" required>
                                        <div class="scale-icon sad" data-bs-toggle="tooltip" title="Sangat Tidak Suka">
                                            <i class="far fa-face-tired"></i>
                                        </div>
                                        <span class="scale-label text-danger">Sangat Tidak</span>
                                    </label>

                                    <label class="scale-option">
                                        <input type="radio" name="answers[{{ $question->id }}]" value="2_cat{{$question->category_id}}">
                                        <div class="scale-icon meh" data-bs-toggle="tooltip" title="Tidak Suka">
                                            <i class="far fa-face-frown-open"></i>
                                        </div>
                                        <span class="scale-label text-warning">Tidak Suka</span>
                                    </label>

                                    <label class="scale-option">
                                        <input type="radio" name="answers[{{ $question->id }}]" value="3_cat{{$question->category_id}}">
                                        <div class="scale-icon neutral" data-bs-toggle="tooltip" title="Netral / Biasa Saja">
                                            <i class="far fa-face-meh"></i>
                                        </div>
                                        <span class="scale-label text-secondary">Biasa Aja</span>
                                    </label>

                                    <label class="scale-option">
                                        <input type="radio" name="answers[{{ $question->id }}]" value="4_cat{{$question->category_id}}">
                                        <div class="scale-icon smile" data-bs-toggle="tooltip" title="Suka">
                                            <i class="far fa-face-smile"></i>
                                        </div>
                                        <span class="scale-label text-success">Suka</span>
                                    </label>

                                    <label class="scale-option">
                                        <input type="radio" name="answers[{{ $question->id }}]" value="5_cat{{$question->category_id}}">
                                        <div class="scale-icon love" data-bs-toggle="tooltip" title="Sangat Suka">
                                            <i class="far fa-face-grin-hearts"></i>
                                        </div>
                                        <span class="scale-label text-primary">Sangat Suka</span>
                                    </label>

                                </div>
                                
                                <div class="text-danger small mt-3 d-none error-msg text-center fw-bold animate-shake p-2 rounded bg-danger bg-opacity-10">
                                    <i class="fas fa-exclamation-circle me-1"></i> Jangan lupa diisi ya!
                                </div>
                            </div>
                            @if(!$loop->last) <hr class="border-light my-5"> @endif
                            @endforeach

                            <div class="d-flex justify-content-between mt-5 pt-3">
                                @if($chunkIndex > 0)
                                    <button type="button" class="btn btn-alive-outline rounded-pill px-4 py-2" onclick="prevStep({{ $chunkIndex }})">
                                        <i class="fas fa-arrow-left me-2"></i> Sebelumnya
                                    </button>
                                @else <div></div> @endif

                                @if($loop->last)
                                    <button type="button" class="btn btn-alive-primary px-5 py-3 shadow-lg rounded-pill" onclick="submitForm({{ $chunkIndex }})">
                                        Lihat Hasil Saya <i class="fas fa-wand-magic-sparkles ms-2"></i>
                                    </button>
                                @else
                                    <button type="button" class="btn btn-alive-primary px-4 py-2 rounded-pill" onclick="nextStep({{ $chunkIndex }})">
                                        Selanjutnya <i class="fas fa-arrow-right ms-2"></i>
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="card-modern text-center p-5 border-0">
                    <i class="fas fa-box-open fa-3x text-muted mb-3 opacity-50"></i>
                    <h3 class="fw-bold text-dark">Soal Belum Tersedia</h3>
                    <p class="text-muted">Admin belum menginput soal ke database.</p>
                </div>
            @endif
        </form>
    </div>
</div>

<div id="loadingOverlay" class="d-none position-fixed top-0 start-0 w-100 h-100 d-flex flex-column justify-content-center align-items-center" 
     style="background: rgba(255,255,255,0.8); backdrop-filter: blur(8px); z-index: 9999;">
    <div class="spinner-border text-primary mb-3" style="width: 4rem; height: 4rem;" role="status"></div>
    <h4 class="fw-bold text-dark animate-pulse mt-3">Sedang Menganalisis...</h4>
    <p class="text-muted">Menghitung kecocokan minatmu</p>
</div>

<style>
    /* Radio Button Hilang */
    .scale-option input[type="radio"] { display: none; }

    /* Layout Label Opsi */
    .scale-option {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 10px;
        cursor: pointer;
        width: 18%; /* Bagi rata 5 kolom */
    }

    /* Container Icon Bulat */
    .scale-icon {
        width: 55px; height: 55px;
        border-radius: 50%;
        background-color: #f1f5f9;
        color: #94a3b8;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.8rem;
        transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1); /* Efek Bouncy */
        border: 2px solid transparent;
    }

    /* Teks Label di Bawah Emoji */
    .scale-label {
        font-size: 0.75rem;
        font-weight: 700;
        opacity: 0; /* Sembunyi dulu */
        transform: translateY(-5px);
        transition: all 0.3s ease;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    /* Saat Hover: Icon Membesar & Label Muncul */
    .scale-option:hover .scale-icon { transform: scale(1.15) rotate(5deg); background-color: #e2e8f0; }
    .scale-option:hover .scale-label { opacity: 1; transform: translateY(0); }

    /* --- ACTIVE STATE (Saat Dipilih) --- */
    /* Menggunakan animasi 'pop' agar hidup */
    
    /* 1. Sangat Tidak Suka (Merah) */
    .scale-option input[value^="1"]:checked + .scale-icon {
        background: linear-gradient(135deg, #ef4444, #dc2626); color: white;
        box-shadow: 0 8px 15px rgba(239, 68, 68, 0.4); transform: scale(1.25);
        animation: pop 0.4s ease;
    }
    
    /* 2. Tidak Suka (Oranye) */
    .scale-option input[value^="2"]:checked + .scale-icon {
        background: linear-gradient(135deg, #f97316, #ea580c); color: white;
        box-shadow: 0 8px 15px rgba(249, 115, 22, 0.4); transform: scale(1.25);
        animation: pop 0.4s ease;
    }

    /* 3. Netral (Abu-abu/Kuning Gelap) */
    .scale-option input[value^="3"]:checked + .scale-icon {
        background: linear-gradient(135deg, #94a3b8, #64748b); color: white;
        box-shadow: 0 8px 15px rgba(148, 163, 184, 0.4); transform: scale(1.25);
        animation: pop 0.4s ease;
    }

    /* 4. Suka (Hijau Teal) */
    .scale-option input[value^="4"]:checked + .scale-icon {
        background: linear-gradient(135deg, #10b981, #059669); color: white;
        box-shadow: 0 8px 15px rgba(16, 185, 129, 0.4); transform: scale(1.25);
        animation: pop 0.4s ease;
    }

    /* 5. Sangat Suka (Biru NextKarier) */
    .scale-option input[value^="5"]:checked + .scale-icon {
        background: linear-gradient(135deg, var(--nk-primary), #004ecc); color: white;
        box-shadow: 0 8px 20px rgba(0, 102, 255, 0.4); transform: scale(1.35);
        animation: pop 0.4s ease;
    }

    /* Label Tetap Muncul saat Dipilih */
    .scale-option input:checked ~ .scale-label { opacity: 1; transform: translateY(0); }

    /* Keyframes Animasi Pop */
    @keyframes pop {
        0% { transform: scale(1); }
        50% { transform: scale(1.4); }
        100% { transform: scale(1.25); }
    }

    .animate-shake { animation: shake 0.5s; }
    @keyframes shake { 0%, 100% { transform: translateX(0); } 25% { transform: translateX(-5px); } 75% { transform: translateX(5px); } }
    
    .animate-pulse { animation: pulse 1.5s infinite; }
    @keyframes pulse { 0% { opacity: 0.6; } 50% { opacity: 1; } 100% { opacity: 0.6; } }

    /* Mobile Responsiveness */
    @media (max-width: 576px) {
        .scale-label { display: none; } /* Sembunyikan label teks di HP biar rapi */
        .scale-icon { width: 45px; height: 45px; font-size: 1.4rem; }
    }
</style>

@push('scripts')
<script>
    @if($questions->count() > 0)
        const totalSteps = {{ ceil($questions->count() / 5) }};
        
        function updateProgress(stepIndex) {
            let percent = ((stepIndex + 1) / totalSteps) * 100;
            document.getElementById('progress-bar').style.width = percent + '%';
            document.getElementById('progress-text').innerText = Math.round(percent) + '%';
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }

        function validateStep(stepIndex) {
            let currentDiv = document.getElementById('step-' + stepIndex);
            let questions = currentDiv.querySelectorAll('.question-item');
            let isValid = true;
            let firstError = null;

            questions.forEach(function(item) {
                let radio = item.querySelector('input[type="radio"]:checked');
                let errorMsg = item.querySelector('.error-msg');
                let scaleContainer = item.querySelector('.scale-container');
                
                if (!radio) {
                    isValid = false;
                    errorMsg.classList.remove('d-none');
                    scaleContainer.style.background = "#fef2f2"; // Highlight merah tipis
                    scaleContainer.style.borderRadius = "12px";
                    scaleContainer.style.padding = "10px";
                    
                    if(!firstError) firstError = item;
                } else {
                    errorMsg.classList.add('d-none');
                    scaleContainer.style.background = "transparent";
                    scaleContainer.style.padding = "0";
                }
            });

            if (!isValid && firstError) {
                firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
            }
            return isValid;
        }

        function nextStep(current) {
            if (!validateStep(current)) return;
            document.getElementById('step-' + current).classList.add('d-none');
            document.getElementById('step-' + (current + 1)).classList.remove('d-none');
            document.getElementById('step-' + (current + 1)).classList.add('fade-in-up');
            updateProgress(current + 1);
        }

        function prevStep(current) {
            document.getElementById('step-' + current).classList.add('d-none');
            document.getElementById('step-' + (current - 1)).classList.remove('d-none');
            updateProgress(current - 1);
        }
        
        function submitForm(current) {
            if (!validateStep(current)) return;
            document.getElementById('quizForm').submit();
            document.getElementById('loadingOverlay').classList.remove('d-none');
        }

        updateProgress(-0.5);
    @endif
</script>
@endpush
@endsection