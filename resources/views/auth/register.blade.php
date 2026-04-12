@extends('layout.app')
@section('title', 'Daftar Akun')

@section('content')
<div class="row justify-content-center align-items-center min-vh-80 fade-in-up">
    
    <div class="col-lg-6 mb-5 mb-lg-0 d-none d-lg-block text-center">
        <img src="/img/gambarregister.jpg" 
             class="img-fluid animate-float" alt="Register Illustration" style="max-height: 500px;">
        <div class="mt-4">
            <h4 class="fw-bold text-dark">Mulai Langkah Awalmu</h4>
            <p class="text-muted px-5">Dapatkan rekomendasi jurusan kuliah yang paling sesuai dengan kepribadianmu.</p>
        </div>
    </div>

    <div class="col-lg-5 offset-lg-1">
        <div class="card-modern bg-white p-4 p-md-5 border-0 shadow-lg rounded-4 position-relative overflow-hidden">
            
            <div class="position-absolute top-0 start-0 bg-success opacity-10 rounded-circle" style="width: 120px; height: 120px; transform: translate(-30px, -30px);"></div>

            <div class="mb-4 position-relative z-1">
                <h2 class="fw-bold text-dark">Buat Akun Baru 🚀</h2>
                <p class="text-muted">Isi data diri untuk mulai asesmen.</p>
            </div>

            <form action="{{ route('register.post') }}" method="POST">
                @csrf
                
                <div class="mb-3">
                    <label class="form-label small fw-bold text-uppercase text-muted ls-1">Nama Lengkap</label>
                    <div class="input-group input-group-lg group-modern">
                        <span class="input-group-text bg-light border-0 ps-3 text-muted"><i class="fas fa-user"></i></span>
                        <input type="text" name="name" class="form-control bg-light border-0 fs-6" placeholder="Contoh: Budi Santoso" required value="{{ old('name') }}">
                    </div>
                    @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label small fw-bold text-uppercase text-muted ls-1">Alamat Email</label>
                    <div class="input-group input-group-lg group-modern">
                        <span class="input-group-text bg-light border-0 ps-3 text-muted"><i class="fas fa-envelope"></i></span>
                        <input type="email" name="email" class="form-control bg-light border-0 fs-6" placeholder="nama@email.com" required value="{{ old('email') }}">
                    </div>
                    @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label small fw-bold text-uppercase text-muted ls-1">Password</label>
                    <div class="input-group input-group-lg group-modern">
                        <span class="input-group-text bg-light border-0 ps-3 text-muted"><i class="fas fa-lock"></i></span>
                        
                        <input type="password" name="password" id="regPass" class="form-control bg-light border-0 fs-6" placeholder="Min. 8 karakter" required>
                        
                        <span class="input-group-text bg-light border-0 pe-3 text-muted cursor-pointer" onclick="togglePassword('regPass', 'iconReg')">
                            <i class="far fa-eye" id="iconReg"></i>
                        </span>
                    </div>
                    @error('password') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="d-grid mb-4 mt-4">
                    <button type="submit" class="btn btn-alive-primary py-3 fw-bold shadow-sm">
                        Daftar Sekarang <i class="fas fa-user-plus ms-2"></i>
                    </button>
                </div>

                <div class="text-center small text-muted">
                    Sudah punya akun? <a href="{{ route('login') }}" class="text-primary fw-bold text-decoration-none">Masuk di sini</a>
                </div>
            </form>
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
    
    .input-group-text { background: transparent !important; transition: color 0.3s; }
    .group-modern:focus-within .input-group-text { color: var(--nk-primary) !important; }
    
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