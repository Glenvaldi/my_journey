@extends('layout.app')
@section('title', 'Tentang Kami')

@section('content')
{{-- Header Section --}}
<div class="row justify-content-center fade-in-up mb-5 pt-3">
    <div class="col-lg-9 text-center">
        <span class="badge px-4 py-2 rounded-pill fw-bold mb-4 ls-1 shadow-sm" style="background-color: rgba(124, 58, 237, 0.1); color: var(--nk-primary);">
            TENTANG PLATFORM
        </span>
        <h1 class="display-4 fw-bolder text-dark mb-4" style="letter-spacing: -1px; line-height: 1.2;">
            Langkah Tepat Menuju <br>
            <span class="position-relative" style="color: var(--nk-primary);">
                Masa Depan Terarah.
                <svg class="position-absolute bottom-0 start-0 w-100" height="12" viewBox="0 0 200 12" fill="none" xmlns="http://www.w3.org/2000/svg" style="z-index: -1; opacity: 0.3;">
                    <path d="M0 10C50 0 150 0 200 10" stroke="var(--nk-primary)" stroke-width="4"/>
                </svg>
            </span>
        </h1>
        <p class="lead text-muted mx-auto" style="max-width: 750px; line-height: 1.8;">
            Menjawab tantangan peserta didik dalam menentukan program studi lanjutan, <strong>My Journey</strong> hadir sebagai media inovasi bimbingan karir untuk memfasilitasi penelusuran minat dan bakat secara terpadu.
        </p>
    </div>
</div>

{{-- Kenalan sama RIASEC Section --}}
<div class="row justify-content-center fade-in-up mb-5" style="animation-delay: 0.2s;">
    <div class="col-lg-11">
        <div class="card-modern bg-white p-4 p-md-5 border-0 shadow-sm">
            <div class="row align-items-center g-5">
                <div class="col-lg-6">
                    <div class="position-relative ps-4">
                        <div class="position-absolute top-0 start-0 h-100 rounded-pill" style="width: 4px; opacity: 0.5; background-color: var(--nk-primary);"></div>
                        <h3 class="fw-bold text-dark mb-4">Landasan Teori (RIASEC)</h3>
                        <p class="text-muted lh-lg mb-4">
                            Instrumen asesmen kami dibangun berlandaskan <strong>Teori Pilihan Karir Holland</strong> atau yang sering dikenal dengan metode RIASEC. Menurut teori psikologi ini, kecocokan antara kepribadian seseorang dengan lingkungan kerjanya adalah kunci utama menuju kesuksesan dan kenyamanan belajar maupun berkarir. Daripada sekadar menebak-nebak, metode ini akan membantu memetakan minat dan bakat alamimu ke dalam 6 (enam) kelompok kepribadian berikut:
                        </p>
                        
                        <div class="d-flex flex-column gap-3">
                            <div class="riasec-item d-flex align-items-start gap-3">
                                <span class="riasec-letter flex-shrink-0 mt-1" style="background-color: rgba(124, 58, 237, 0.1); color: var(--nk-primary);">R</span>
                                <div>
                                    <strong class="text-dark">Realistic (Si Praktis)</strong>
                                    <p class="text-muted small mb-0 mt-1 lh-base">Kamu adalah tipe yang suka belajar dengan cara mempraktikkannya langsung. Kamu lebih menyukai aktivitas fisik, bekerja di lapangan, atau berinteraksi dengan mesin, alat, maupun alam daripada terlalu banyak teori di kelas.</p>
                                </div>
                            </div>
                            <div class="riasec-item d-flex align-items-start gap-3">
                                <span class="riasec-letter flex-shrink-0 mt-1" style="background-color: rgba(124, 58, 237, 0.1); color: var(--nk-primary);">I</span>
                                <div>
                                    <strong class="text-dark">Investigative (Si Pemikir)</strong>
                                    <p class="text-muted small mb-0 mt-1 lh-base">Punya rasa ingin tahu yang tinggi? Tipe ini gemar mengamati, meneliti, dan menganalisis sesuatu. Kamu paling senang menggunakan logika dan ilmu pengetahuan untuk memecahkan masalah yang rumit.</p>
                                </div>
                            </div>
                            <div class="riasec-item d-flex align-items-start gap-3">
                                <span class="riasec-letter flex-shrink-0 mt-1" style="background-color: rgba(124, 58, 237, 0.1); color: var(--nk-primary);">A</span>
                                <div>
                                    <strong class="text-dark">Artistic (Si Kreatif)</strong>
                                    <p class="text-muted small mb-0 mt-1 lh-base">Kamu penuh imajinasi dan sangat menghargai estetika. Kamu tidak suka aturan yang terlalu mengekang dan lebih memilih lingkungan yang memberimu kebebasan untuk berekspresi, menciptakan ide, seni, atau karya yang unik.</p>
                                </div>
                            </div>
                            <div class="riasec-item d-flex align-items-start gap-3">
                                <span class="riasec-letter flex-shrink-0 mt-1" style="background-color: rgba(124, 58, 237, 0.1); color: var(--nk-primary);">S</span>
                                <div>
                                    <strong class="text-dark">Social (Si Penolong)</strong>
                                    <p class="text-muted small mb-0 mt-1 lh-base">Kamu sangat mudah bergaul, ramah, dan empatik. Orang dengan tipe ini mendapatkan energi dari berinteraksi dengan orang lain, serta merasa paling berharga saat bisa mendidik, menyembuhkan, atau membantu sesama.</p>
                                </div>
                            </div>
                            <div class="riasec-item d-flex align-items-start gap-3">
                                <span class="riasec-letter flex-shrink-0 mt-1" style="background-color: rgba(124, 58, 237, 0.1); color: var(--nk-primary);">E</span>
                                <div>
                                    <strong class="text-dark">Enterprising (Si Penggerak)</strong>
                                    <p class="text-muted small mb-0 mt-1 lh-base">Terlahir dengan jiwa kepemimpinan, kamu pandai berkomunikasi dan berani mengambil risiko. Tipe ini jago mempersuasi (meyakinkan) orang lain, suka tantangan, dan sangat cocok berada di dunia bisnis atau organisasi.</p>
                                </div>
                            </div>
                            <div class="riasec-item d-flex align-items-start gap-3">
                                <span class="riasec-letter flex-shrink-0 mt-1" style="background-color: rgba(124, 58, 237, 0.1); color: var(--nk-primary);">C</span>
                                <div>
                                    <strong class="text-dark">Conventional (Si Teratur)</strong>
                                    <p class="text-muted small mb-0 mt-1 lh-base">Kamu adalah orang yang teliti, rapi, dan terstruktur. Kamu lebih nyaman bekerja dengan data, angka, atau dokumen tertulis, serta sangat menghargai sistem kerja yang memiliki pedoman dan aturan yang jelas.</p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-lg-6 text-center">
                    <img src="/img/diagram.jpg" class="img-fluid animate-float" alt="RIASEC Illustration" style="max-height: 450px;">
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Benefits Section --}}
<div class="row justify-content-center g-4 mb-5 pb-5 fade-in-up" style="animation-delay: 0.3s;">
    <div class="col-lg-4 col-md-6">
        <div class="feature-card h-100 bg-white p-4 rounded-4 text-center">
            <div class="icon-box mx-auto mb-4" style="background-color: rgba(124, 58, 237, 0.1); color: var(--nk-primary);">
                <i class="fas fa-bolt fa-2x"></i>
            </div>
            <h5 class="fw-bold text-dark">Efisien & Responsif</h5>
            <p class="text-muted">Sistem dirancang untuk memberikan pengalaman asesmen yang praktis dengan hasil evaluasi yang dapat diakses secara instan.</p>
        </div>
    </div>
    <div class="col-lg-4 col-md-6">
        <div class="feature-card h-100 bg-white p-4 rounded-4 text-center">
            <div class="icon-box mx-auto mb-4" style="background-color: rgba(124, 58, 237, 0.1); color: var(--nk-primary);">
                <i class="fas fa-brain fa-2x"></i>
            </div>
            <h5 class="fw-bold text-dark">Pendekatan Ilmiah</h5>
            <p class="text-muted">Inovasi ini diadaptasi dari instrumen psikometrik yang teruji kelayakannya dalam ranah bimbingan konseling karir.</p>
        </div>
    </div>
    <div class="col-lg-4 col-md-6">
        <div class="feature-card h-100 bg-white p-4 rounded-4 text-center">
            <div class="icon-box mx-auto mb-4" style="background-color: rgba(124, 58, 237, 0.1); color: var(--nk-primary);">
                <i class="fas fa-graduation-cap fa-2x"></i>
            </div>
            <h5 class="fw-bold text-dark">Rekomendasi Spesifik</h5>
            <p class="text-muted">Menyajikan output berupa laporan komprehensif, mencakup saran program studi, prospek profesi, hingga target instansi.</p>
        </div>
    </div>
</div>

{{-- --- TEAM SECTION (4 Orang) BAHASA FORMAL TAPI SIMPEL --- --}}
<div class="row justify-content-center fade-in-up mb-5" style="animation-delay: 0.4s;">
    <div class="col-lg-11">
        <div class="text-center mb-5">
             <span class="badge px-3 py-2 rounded-pill fw-bold mb-3 ls-1 shadow-sm" style="background-color: rgba(124, 58, 237, 0.1); color: var(--nk-primary);">
                TIM INOVASI
            </span>
            <h2 class="fw-bold text-dark">Pengembang My Journey</h2>
            <p class="text-muted">Mengenal tim pengembang di balik pembuatan inovasi media layanan ini.</p>
        </div>

        <div class="row g-4 justify-content-center">
            {{-- Anggota 1 --}}
            <div class="col-lg-6">
                <div class="dev-card">
                    <div class="dev-photo" style="background-image: url('/img/chalista.jpg');"></div>
                    <div class="dev-info">
                        <h6 class="fw-bold text-dark mb-1">CHALISTA DENISE PRABOWO</h6>
                        <p class="fw-bold small mb-2" style="color: var(--nk-primary);">Ketua Kelompok</p>
                        <p class="text-muted small lh-sm mb-0">Bertugas memimpin jalannya proyek, mengatur pembagian kerja, dan memastikan inovasi ini selesai tepat waktu dengan hasil maksimal.</p>
                    </div>
                    <div class="dev-role-vertical">
                        <span>KETUA</span>
                    </div>
                </div>
            </div>

            {{-- Anggota 2 --}}
            <div class="col-lg-6">
                <div class="dev-card">
                    <div class="dev-photo" style="background-image: url('/img/desya.jpg');"></div>
                    <div class="dev-info">
                        <h6 class="fw-bold text-dark mb-1">DESYA ANISA AULIA SALAM</h6>
                        <p class="fw-bold small mb-2" style="color: var(--nk-primary);">Penyusun Materi</p>
                        <p class="text-muted small lh-sm mb-0">Bertanggung jawab menyusun instrumen pertanyaan yang mudah dipahami siswa, serta menyajikan data rekomendasi karir secara akurat.</p>
                    </div>
                    <div class="dev-role-vertical">
                        <span>MATERI</span>
                    </div>
                </div>
            </div>

            {{-- Anggota 3 --}}
            <div class="col-lg-6">
                <div class="dev-card">
                    <div class="dev-photo" style="background-image: url('/img/emil.jpg');"></div>
                    <div class="dev-info">
                        <h6 class="fw-bold text-dark mb-1">EMILIA AINUR ROHMAH</h6>
                        <p class="fw-bold small mb-2" style="color: var(--nk-primary);">Pengembang Media</p>
                        <p class="text-muted small lh-sm mb-0">Bertugas merangkai materi ke dalam sistem website, memastikan semua fitur dan soal tes dapat diakses siswa dengan lancar tanpa hambatan.</p>
                    </div>
                    <div class="dev-role-vertical">
                        <span>MEDIA</span>
                    </div>
                </div>
            </div>

            {{-- Anggota 4 --}}
            <div class="col-lg-6">
                <div class="dev-card">
                    <div class="dev-photo" style="background-image: url('/img/ahmad.jpg');"></div>
                    <div class="dev-info">
                        <h6 class="fw-bold text-dark mb-1">AHMAD GAGAH SETIAWAN</h6>
                        <p class="fw-bold small mb-2" style="color: var(--nk-primary);">Desain Visual</p>
                        <p class="text-muted small lh-sm mb-0">Berperan merancang tata letak, warna, dan gambar agar media pembelajaran ini terlihat menarik dan tidak membosankan.</p>
                    </div>
                    <div class="dev-role-vertical">
                        <span>DESAIN</span>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

{{-- CTA Section --}}
<div class="row justify-content-center fade-in-up" style="animation-delay: 0.5s;">
    <div class="col-lg-11">
        <div class="card-modern text-center p-5 border-0 position-relative overflow-hidden" style="background: linear-gradient(135deg, var(--nk-primary) 0%, var(--nk-primary-hover) 100%);">
             <div class="position-absolute top-0 end-0 bg-white opacity-10 rounded-circle" style="width: 200px; height: 200px; transform: translate(50px, -50px);"></div>
             <div class="position-absolute bottom-0 start-0 bg-white opacity-10 rounded-circle" style="width: 150px; height: 150px; transform: translate(-30px, 30px);"></div>

            <div class="position-relative z-1 text-white">
                <h2 class="fw-bold mb-3">Mulai Asesmen Anda</h2>
                <p class="text-white-50 mb-4 lead">Langkah pertama merencanakan karir yang optimal dimulai dari sini.</p>
                @auth
                    <a href="{{ route('instructions') }}" class="btn btn-white-glow px-5 py-3 rounded-pill fw-bold shadow-lg">Mulai Evaluasi <i class="fas fa-arrow-right ms-2"></i></a>
                @else
                    <a href="{{ route('register') }}" class="btn btn-white-glow px-5 py-3 rounded-pill fw-bold shadow-lg">Registrasi Pengguna <i class="fas fa-user-plus ms-2"></i></a>
                    <div class="mt-3 small">
                        <span class="text-white-50">Sudah memiliki akun?</span> <a href="{{ route('login') }}" class="text-white fw-bold text-decoration-none">Masuk ke Sistem</a>
                    </div>
                @endauth
            </div>
        </div>
    </div>
</div>

{{-- CSS Khusus Halaman Ini --}}
<style>
    /* Mengakali Bootstrap agar link/utama patuh ke warna ungu */
    .text-primary { color: var(--nk-primary) !important; }
    
    /* RIASEC Grid */
    .grid-cols-2 { display: grid; grid-template-columns: 1fr 1fr; }
    .riasec-item { display: flex; align-items: center; gap: 12px; margin-bottom: 15px; }
    .riasec-letter { 
        width: 45px; height: 45px; display: flex; align-items: center; justify-content: center; 
        font-weight: 800; font-size: 1.3rem; border-radius: 12px;
    }

    /* Feature Cards */
    .feature-card { 
        transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1); 
        border: 2px solid rgba(124, 58, 237, 0.1); 
    }
    .feature-card:hover { 
        transform: translateY(-10px); 
        box-shadow: 0 15px 40px rgba(124, 58, 237, 0.1); 
        border-color: var(--nk-primary) !important; 
    }
    .icon-box { 
        width: 75px; height: 75px; display: flex; align-items: center; justify-content: center; 
        border-radius: 20px; transition: all 0.3s ease;
    }
    .feature-card:hover .icon-box { transform: scale(1.1) rotate(8deg); }

    /* --- STYLING KARTU TIM --- */
    .dev-card {
        display: flex; background: white; border-radius: 20px; overflow: hidden;
        border: 2px solid rgba(124, 58, 237, 0.15); 
        box-shadow: 0 4px 12px rgba(124, 58, 237, 0.05);
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        height: 140px; position: relative;
    }

    .dev-card:hover {
        border-color: var(--nk-primary); box-shadow: 0 15px 35px rgba(124, 58, 237, 0.2);
        transform: translateY(-8px);
    }

    .dev-photo {
        width: 130px; flex-shrink: 0; background-size: cover; background-position: center;
        border-top-left-radius: 18px; border-bottom-left-radius: 18px;
    }

    .dev-info {
        flex-grow: 1; padding: 20px; display: flex; flex-direction: column; justify-content: center;
        border-right: 2px dashed rgba(124, 58, 237, 0.25); 
        margin-right: 40px; 
    }

    .dev-role-vertical {
        position: absolute; right: 0; top: 0; bottom: 0; width: 40px;
        background: var(--nk-primary); 
        display: flex; align-items: center; justify-content: center; overflow: hidden;
    }

    .dev-role-vertical span {
        writing-mode: vertical-rl; text-orientation: mixed; transform: rotate(180deg);
        color: white; font-weight: 800; letter-spacing: 2px; font-size: 0.85rem; text-transform: uppercase; white-space: nowrap;
    }

    @media (max-width: 576px) {
        .dev-card { height: auto; flex-direction: column; }
        .dev-photo { width: 100%; height: 180px; border-radius: 18px 18px 0 0; }
        .dev-info { margin-right: 0; border-right: none; border-bottom: 2px dashed rgba(124, 58, 237, 0.25); padding: 20px; text-align: center; }
        .dev-role-vertical { position: relative; width: 100%; height: 40px; }
        .dev-role-vertical span { writing-mode: horizontal-tb; transform: none; letter-spacing: 1px; font-size: 0.8rem; }
    }

    /* CTA Button */
    .btn-white-glow { background: white; color: var(--nk-primary); border: none; transition: all 0.3s ease; }
    .btn-white-glow:hover { background: #f8fafc; transform: translateY(-3px) scale(1.05); box-shadow: 0 15px 30px rgba(255, 255, 255, 0.4); color: var(--nk-dark); }

    .animate-float { animation: float 4s ease-in-out infinite; }
    @keyframes float { 0% { transform: translateY(0px); } 50% { transform: translateY(-15px); } 100% { transform: translateY(0px); } }
</style>
@endsection