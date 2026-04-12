@extends('layout.app')
@section('title', 'Masuk Akun')

@section('content')
<div class="row justify-content-center align-items-center min-vh-80 fade-in-up">
    
    <div class="col-lg-5 col-md-8 order-2 order-lg-1">
        <div class="card-modern bg-white p-4 p-md-5 border-0 shadow-lg rounded-4 position-relative overflow-hidden">
            
            <div class="position-absolute top-0 end-0 bg-primary opacity-10 rounded-circle" style="width: 100px; height: 100px; transform: translate(30px, -30px);"></div>

            <div class="mb-4">
                <h2 class="fw-bold text-dark">Selamat Datang! 👋</h2>
                <p class="text-muted">Masuk untuk melanjutkan perjalanan karirmu.</p>
            </div>

            @if($errors->any())
                <div class="alert alert-danger border-0 bg-danger bg-opacity-10 text-danger small mb-4 rounded-3">
                    <i class="fas fa-exclamation-circle me-1"></i> Email atau password salah.
                </div>
            @endif

            <form action="{{ route('login.post') }}" method="POST">
                @csrf
                
                <div class="mb-4">
                    <label class="form-label small fw-bold text-uppercase text-muted ls-1">Alamat Email</label>
                    <div class="input-group input-group-lg group-modern">
                        <span class="input-group-text bg-light border-0 ps-3 text-muted"><i class="fas fa-envelope"></i></span>
                        <input type="email" name="email" class="form-control bg-light border-0 fs-6" placeholder="nama@email.com" required>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label small fw-bold text-uppercase text-muted ls-1">Password</label>
                    <div class="input-group input-group-lg group-modern">
                        <span class="input-group-text bg-light border-0 ps-3 text-muted"><i class="fas fa-lock"></i></span>
                        
                        <input type="password" name="password" id="loginPass" class="form-control bg-light border-0 fs-6" placeholder="••••••••" required>
                        
                        <span class="input-group-text bg-light border-0 pe-3 text-muted cursor-pointer" onclick="togglePassword('loginPass', 'iconLogin')">
                            <i class="far fa-eye" id="iconLogin"></i>
                        </span>
                    </div>
                </div>

                <div class="d-flex justify-content-between align-items-center mb-4 small">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="remember" name="remember">
                        <label class="form-check-label text-muted" for="remember">Ingat Saya</label>
                    </div>
                    <a href="#" class="text-primary text-decoration-none fw-bold">Lupa Password?</a>
                </div>

                <div class="d-grid mb-4">
                    <button type="submit" class="btn btn-alive-primary py-3 fw-bold shadow-sm">
                        Masuk Sekarang <i class="fas fa-arrow-right ms-2"></i>
                    </button>
                </div>

                <div class="text-center small text-muted">
                    Belum punya akun? <a href="{{ route('register') }}" class="text-primary fw-bold text-decoration-none">Daftar Gratis</a>
                </div>
            </form>
        </div>
    </div>

    <div class="col-lg-6 offset-lg-1 order-1 order-lg-2 mb-5 mb-lg-0 d-none d-lg-block">
        <div class="text-center">
            <img src="/img/gambarlogin.jpg" 
                 class="img-fluid animate-float" alt="Login Illustration" style="max-height: 500px;">
            <div class="mt-4">
                <h4 class="fw-bold text-dark">Temukan Potensimu</h4>
                <p class="text-muted">Bergabung dengan ribuan siswa lainnya.</p>
            </div>
        </div>
    </div>

</div>

<style>
    .group-modern {
        border: 1px solid transparent; border-radius: 12px; overflow: hidden; transition: all 0.3s; background-color: #f8f9fa;
    }
    .group-modern:focus-within {
        border-color: var(--nk-primary); box-shadow: 0 0 0 4px rgba(0, 102, 255, 0.1); background: white;
    }
    .group-modern input:focus { box-shadow: none; background: white; }
    
    /* Warna Ikon saat input aktif */
    .input-group-text { background: transparent !important; transition: color 0.3s; }
    .group-modern:focus-within .input-group-text { color: var(--nk-primary) !important; }
    
    /* Cursor Pointer untuk Mata */
    .cursor-pointer { cursor: pointer; }
    .cursor-pointer:hover { color: var(--nk-dark) !important; }

    .ls-1 { letter-spacing: 1px; }
    .animate-float { animation: float 6s ease-in-out infinite; }
    @keyframes float { 0% { transform: translateY(0px); } 50% { transform: translateY(-15px); } 100% { transform: translateY(0px); } }
</style>

<script>
    function togglePassword(inputId, iconId) {
        const input = document.getElementById(inputId);
        const icon = document.getElementById(iconId);
        
        if (input.type === "password") {
            input.type = "text";
            icon.classList.remove("fa-eye");
            icon.classList.add("fa-eye-slash");
        } else {
            input.type = "password";
            icon.classList.remove("fa-eye-slash");
            icon.classList.add("fa-eye");
        }
    }
</script>
@endsection