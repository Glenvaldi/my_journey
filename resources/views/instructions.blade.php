@extends('layout.app')
@section('title', 'Persiapan')

@section('content')
<div class="row align-items-center min-vh-80 py-4">
    
    <div class="col-lg-6 mb-5 mb-lg-0 fade-in-up">
        
        <div class="d-inline-flex align-items-center gap-2 px-3 py-2 rounded-pill bg-white border shadow-sm mb-4">
            <span class="badge bg-primary rounded-pill px-3 py-1">Langkah 1</span>
            <span class="small fw-bold text-secondary">Persiapan</span>
        </div>

        <h1 class="display-5 fw-bolder mb-3 text-dark" style="letter-spacing: -0.5px;">
            Hai, <span style="color: var(--nk-primary);">{{ explode(' ', Auth::user()->name)[0] }}!</span> 👋
        </h1>
        <p class="lead text-secondary mb-5" style="font-size: 1.1rem; line-height: 1.6;">
            Udah siap cari tau jurusan yang cocok? Biar hasilnya akurat dan nggak meleset, ikutin 3 tips simpel ini ya:
        </p>

        <div class="d-flex flex-column gap-4">
            
            <div class="instruction-item d-flex align-items-center gap-4 p-3 rounded-4 bg-white border border-light shadow-sm transition-hover">
                <div class="icon-bubble bg-warning bg-opacity-10 text-warning">
                    <i class="fas fa-clock fa-xl"></i>
                </div>
                <div>
                    <h6 class="fw-bold text-dark mb-1" style="font-size: 1.1rem;">Santai, Gak Ada Timer</h6>
                    <p class="text-muted small mb-0">Kerjain pelan-pelan aja. Gak perlu buru-buru kayak lagi ujian.</p>
                </div>
            </div>

            <div class="instruction-item d-flex align-items-center gap-4 p-3 rounded-4 bg-white border border-light shadow-sm transition-hover" style="animation-delay: 0.1s;">
                <div class="icon-bubble bg-success bg-opacity-10 text-success">
                    <i class="fas fa-heart fa-xl"></i>
                </div>
                <div>
                    <h6 class="fw-bold text-dark mb-1" style="font-size: 1.1rem;">Jujur & Jangan Jaim</h6>
                    <p class="text-muted small mb-0">Pilih jawaban yang beneran "kamu banget", bukan yang disuruh orang lain.</p>
                </div>
            </div>

            <div class="instruction-item d-flex align-items-center gap-4 p-3 rounded-4 bg-white border border-light shadow-sm transition-hover" style="animation-delay: 0.2s;">
                <div class="icon-bubble bg-primary bg-opacity-10 text-primary">
                    <i class="fas fa-check-circle fa-xl"></i>
                </div>
                <div>
                    <h6 class="fw-bold text-dark mb-1" style="font-size: 1.1rem;">Semua Jawaban Benar</h6>
                    <p class="text-muted small mb-0">Ini bukan tes matematika. Kalau sesuai kata hati, berarti jawabannya benar.</p>
                </div>
            </div>

        </div>
    </div>

    <div class="col-lg-5 offset-lg-1 fade-in-up" style="animation-delay: 0.3s;">
        <div class="position-relative">
            
            <div class="position-absolute top-50 start-50 translate-middle bg-primary opacity-10 rounded-circle" 
                 style="width: 120%; height: 120%; filter: blur(50px); z-index: -1;"></div>

            <div class="card bg-white border-0 shadow-lg rounded-4 overflow-hidden">
                <div class="card-header bg-white border-0 pt-4 pb-0 px-4">
                    <span class="badge bg-secondary bg-opacity-10 text-secondary px-3 py-1 rounded-pill mb-2">Langkah 2</span>
                    <h4 class="fw-bold text-dark">Lengkapi Datamu</h4>
                    <p class="text-muted small">Biar sertifikat hasilnya ada namanya.</p>
                </div>

                <div class="card-body p-4">
                    <form action="{{ route('test.index') }}" method="GET">
                        
                        <div class="mb-4">
                            <label class="form-label small fw-bold text-muted text-uppercase ls-1">Nama Lengkap</label>
                            <div class="input-group input-group-lg group-modern">
                                <span class="input-group-text bg-light border-0 ps-3 text-muted">
                                    <i class="far fa-user"></i>
                                </span>
                                <input type="text" name="fullname" class="form-control bg-light border-0 fs-6" 
                                       placeholder="Ketik namamu..." required value="{{ Auth::user()->name }}">
                            </div>
                        </div>

                        <div class="mb-5">
                            <label class="form-label small fw-bold text-muted text-uppercase ls-1">Kelas Saat Ini</label>
                            <div class="input-group input-group-lg group-modern">
                                <span class="input-group-text bg-light border-0 ps-3 text-muted">
                                    <i class="fas fa-graduation-cap"></i>
                                </span>
                                <select name="class_grade" class="form-select bg-light border-0 fs-6 text-muted" required style="cursor: pointer;">
                                    <option value="" selected disabled>Pilih kelasmu...</option>
                                    <optgroup label="SMA">
                                        <option value="X SMA">Kelas 10</option>
                                        <option value="XI SMA">Kelas 11</option>
                                        <option value="XII SMA">kelas 12</option>
                                    </optgroup>
                                    <optgroup label="SMK">
                                        <option value="X SMK">Kelas 10</option>
                                        <option value="XI SMK">Kelas 11</option>
                                        <option value="XII SMK">Kelas 12</option>
                                    </optgroup>
                                </select>
                            </div>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-alive-primary py-3 fw-bold shadow-lg">
                                Gas, Mulai Tes! 🚀
                            </button>
                        </div>
                        
                        <div class="text-center mt-3">
                            <small class="text-muted" style="font-size: 0.75rem;">
                                <i class="fas fa-lock me-1"></i> Tenang, data kamu aman kok.
                            </small>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

<style>
    /* Styling Icon Bubble yang Keren */
    .icon-bubble {
        width: 60px; 
        height: 60px;
        display: flex; 
        align-items: center; 
        justify-content: center;
        border-radius: 16px; /* Sudut agak kotak tapi tumpul (Squircle) */
        transition: transform 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }

    /* Efek Hover pada Card */
    .transition-hover {
        transition: all 0.3s ease;
        border: 1px solid #f1f5f9;
    }
    .transition-hover:hover {
        transform: translateY(-5px);
        border-color: var(--nk-primary) !important;
        box-shadow: 0 15px 30px rgba(0,0,0,0.05) !important;
    }
    
    /* Saat Card di-hover, Icon ikut bergerak */
    .transition-hover:hover .icon-bubble {
        transform: scale(1.1) rotate(5deg);
    }

    /* Form Modern */
    .group-modern {
        border: 1px solid transparent;
        border-radius: 12px;
        overflow: hidden;
        transition: all 0.3s;
        background-color: #f8f9fa;
    }
    
    .group-modern:focus-within {
        border-color: var(--nk-primary);
        box-shadow: 0 0 0 4px rgba(0, 102, 255, 0.1);
        background: white;
    }
    
    .group-modern input:focus, .group-modern select:focus {
        box-shadow: none; 
        background: white;
    }
    
    .input-group-text { background: transparent !important; transition: color 0.3s; }
    .group-modern:focus-within .input-group-text { color: var(--nk-primary) !important; }
    
    .ls-1 { letter-spacing: 1px; }
</style>
@endsection