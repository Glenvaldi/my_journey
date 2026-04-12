@extends('layout.app')
@section('title', 'Temukan Karir Impianmu')

@section('content')
<div class="row align-items-center min-vh-80 mb-5 pt-2">
    
    <div class="col-lg-6 order-2 order-lg-1 fade-in-up">
        
        <div class="d-inline-flex align-items-center gap-2 px-4 py-2 rounded-pill bg-white border shadow-sm mb-4" style="transition: transform 0.3s; cursor: pointer;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
            <span class="badge rounded-pill px-3 py-1" style="background: var(--nk-primary);">Valid</span>
            <span class="small fw-bold text-secondary">Metode Psikologi Teruji</span>
        </div>
        
        <h1 class="display-4 fw-bolder mb-4 text-dark" style="line-height: 1.15; letter-spacing: -1px;">
            Ragu Tentukan <br>
            <span style="background: linear-gradient(120deg, var(--nk-primary) 0%, var(--nk-secondary) 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">
                Masa Depanmu?
            </span>
        </h1>
        
        <p class="lead text-secondary mb-5 pe-lg-5" style="line-height: 1.8; font-size: 1.15rem;">
            Setiap perjalanan butuh kompas. <strong>My Journey</strong> hadir untuk bantu kamu temukan jurusan dan prospek karir yang paling sejalan dengan bakat serta kepribadian aslimu.
        </p>
        
        <div class="d-flex gap-3 flex-column flex-sm-row">
            @auth
                <a href="{{ route('instructions') }}" class="btn btn-alive-primary btn-lg text-center px-5 rounded-pill">
                    Mulai Perjalananku <i class="fas fa-rocket ms-2"></i>
                </a>
            @else
                <a href="{{ route('register') }}" class="btn btn-alive-primary btn-lg text-center px-5 rounded-pill">
                    Mulai Tes Gratis
                </a>
                <a href="{{ route('login') }}" class="btn btn-alive-outline btn-lg text-center px-4 rounded-pill">
                    Saya Punya Akun
                </a>
            @endauth
        </div>

        <div class="mt-5 pt-4 d-flex gap-5 align-items-center">
            <div class="d-flex align-items-center gap-3">
                <div class="bg-white p-3 rounded-circle shadow-sm border border-light">
                    <i class="fas fa-users fa-lg" style="color: var(--nk-primary);"></i>
                </div>
                <div>
                    <h4 class="fw-bold mb-0 text-dark">500+</h4>
                    <small class="text-muted fw-medium">Siswa Terbantu</small>
                </div>
            </div>
            <div class="d-flex align-items-center gap-3">
                <div class="bg-white p-3 rounded-circle shadow-sm border border-light">
                    <i class="fas fa-stopwatch fa-lg" style="color: var(--nk-secondary);"></i>
                </div>
                <div>
                    <h4 class="fw-bold mb-0 text-dark">5 Menit</h4>
                    <small class="text-muted fw-medium">Waktu Pengerjaan</small>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-6 order-1 order-lg-2 text-center mb-5 mb-lg-0 fade-in-up" style="animation-delay: 0.2s;">
        <div class="position-relative d-inline-block">
            
            <div class="position-absolute top-0 end-0 rounded-circle mix-blend-multiply filter blur-xl opacity-70 animate-blob" 
                 style="width: 300px; height: 300px; background: rgba(79, 70, 229, 0.2); transform: translate(50px, -50px); z-index: -1;"></div>
            <div class="position-absolute bottom-0 start-0 rounded-circle mix-blend-multiply filter blur-xl opacity-70 animate-blob animation-delay-2000" 
                 style="width: 250px; height: 250px; background: rgba(14, 165, 233, 0.2); transform: translate(-50px, 50px); z-index: -1;"></div>

            <div class="hero-image-wrapper shadow-2xl rounded-5 overflow-hidden bg-white p-2 border border-light position-relative z-1 animate-float-img">
                <img src="{{ asset('img/hero-main.jpg') }}" 
                     class="img-fluid rounded-4 w-100 object-fit-cover transition-transform duration-500 hover-scale" 
                     alt="Siswa Belajar" 
                     style="min-height: 450px; max-height: 550px; min-width: 100%;"
                     onerror="this.src='/img/bakatminat.jpg'"> 
            </div>

            <div class="bg-white p-3 rounded-4 shadow-lg position-absolute bottom-0 start-0 translate-middle-x mb-5 ms-4 text-start animate-float d-none d-md-block z-3 border border-light" style="min-width: 220px;">
                <div class="d-flex align-items-center gap-3">
                    <div class="bg-success bg-opacity-10 text-success p-3 rounded-3">
                        <i class="fas fa-compass fa-lg"></i>
                    </div>
                    <div>
                        <small class="text-muted d-block fw-bold" style="font-size: 0.75rem; letter-spacing: 0.5px;">HASIL ANALISIS</small>
                        <span class="fw-bolder text-dark">Jurusan Ditemukan!</span>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<div class="row justify-content-center mt-5 pt-5 fade-in-up" style="animation-delay: 0.4s;">
    <div class="col-12 text-center mb-5">
        <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill fw-bold mb-3 ls-1">KEUNGGULAN KAMI</span>
        <h2 class="fw-bold text-dark">Kenapa Pakai My Journey?</h2>
        <p class="text-muted">Desain interaktif dengan perhitungan akurat berbasis data sains.</p>
    </div>

    <div class="col-md-4 mb-4">
        <div class="feature-card p-5 h-100 bg-white rounded-5 text-center position-relative overflow-hidden">
            <div class="card-bg-glow" style="background: var(--nk-primary);"></div>
            <div class="icon-box mb-4 mx-auto" style="background: rgba(79, 70, 229, 0.1); color: var(--nk-primary);">
                <i class="fas fa-fingerprint fa-2x"></i>
            </div>
            <h5 class="fw-bold text-dark">Kenali Diri Terdalam</h5>
            <p class="text-muted mb-0 small lh-lg">Memetakan kepribadianmu lewat 6 dimensi Holland Code untuk melihat bakat murni yang tersembunyi.</p>
        </div>
    </div>
    
    <div class="col-md-4 mb-4">
        <div class="feature-card p-5 h-100 bg-white rounded-5 text-center position-relative overflow-hidden">
            <div class="card-bg-glow" style="background: var(--nk-secondary);"></div>
            <div class="icon-box mb-4 mx-auto" style="background: rgba(14, 165, 233, 0.1); color: var(--nk-secondary);">
                <i class="fas fa-layer-group fa-2x"></i>
            </div>
            <h5 class="fw-bold text-dark">UI Interaktif & Jelas</h5>
            <p class="text-muted mb-0 small lh-lg">Tidak ada teks membosankan. Hasil tesmu divisualisasikan dalam grafik radar yang cantik dan modern.</p>
        </div>
    </div>

    <div class="col-md-4 mb-4">
        <div class="feature-card p-5 h-100 bg-white rounded-5 text-center position-relative overflow-hidden">
            <div class="card-bg-glow" style="background: #10b981;"></div>
            <div class="icon-box mb-4 mx-auto" style="background: rgba(16, 185, 129, 0.1); color: #10b981;">
                <i class="fas fa-camera-retro fa-2x"></i>
            </div>
            <h5 class="fw-bold text-dark">Simpan Momenmu</h5>
            <p class="text-muted mb-0 small lh-lg">Satu klik untuk mengunduh hasil asesmen menjadi gambar HD yang rapi. Siap dibagikan ke orang tua atau guru BK.</p>
        </div>
    </div>
</div>

<style>
    /* Styling Landing Page */
    .hero-image-wrapper {
        transform: perspective(1000px) rotateY(-5deg) rotateX(2deg);
        transition: all 0.6s cubic-bezier(0.16, 1, 0.3, 1);
    }
    .hero-image-wrapper:hover { 
        transform: perspective(1000px) rotateY(0deg) rotateX(0deg); 
        box-shadow: 0 30px 60px rgba(79, 70, 229, 0.2) !important;
    }
    .hover-scale { transition: transform 0.7s ease; }
    .hero-image-wrapper:hover .hover-scale { transform: scale(1.05); }

    .icon-box {
        width: 75px; height: 75px;
        display: flex; align-items: center; justify-content: center;
        border-radius: 20px; transition: all 0.3s;
    }

    /* Kartu Keunggulan (Glassmorphism + Glow Effect) */
    .feature-card { 
        border: 1px solid rgba(255,255,255,0.8);
        box-shadow: 0 10px 30px rgba(0,0,0,0.02);
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275); 
        z-index: 1;
    }
    .card-bg-glow {
        position: absolute; top: 0; left: 50%; transform: translateX(-50%);
        width: 100px; height: 100px; filter: blur(50px); opacity: 0;
        transition: opacity 0.4s ease; z-index: -1;
    }
    .feature-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(79, 70, 229, 0.1);
        border-color: white;
    }
    .feature-card:hover .card-bg-glow { opacity: 0.2; }
    .feature-card:hover .icon-box { transform: scale(1.1) rotate(5deg); }

    /* Animasi Benda Mengapung */
    .animate-float { animation: float 4s ease-in-out infinite; }
    @keyframes float {
        0% { transform: translate(-50%, 0px); }
        50% { transform: translate(-50%, -12px); }
        100% { transform: translate(-50%, 0px); }
    }
    
    .animate-float-img { animation: floatImg 6s ease-in-out infinite; }
    @keyframes floatImg {
        0% { transform: perspective(1000px) rotateY(-5deg) rotateX(2deg) translateY(0px); }
        50% { transform: perspective(1000px) rotateY(-5deg) rotateX(2deg) translateY(-15px); }
        100% { transform: perspective(1000px) rotateY(-5deg) rotateX(2deg) translateY(0px); }
    }
    .hero-image-wrapper:hover.animate-float-img { animation-play-state: paused; } /* Berhenti mengambang saat disorot */
    
    .animate-blob { animation: blob 7s infinite alternate; }
    .animation-delay-2000 { animation-delay: 2s; }
    @keyframes blob {
        0% { transform: translate(0px, 0px) scale(1); }
        33% { transform: translate(30px, -50px) scale(1.1); }
        66% { transform: translate(-20px, 20px) scale(0.9); }
        100% { transform: translate(0px, 0px) scale(1); }
    }
    
    .ls-1 { letter-spacing: 1px; }
</style>
@endsection