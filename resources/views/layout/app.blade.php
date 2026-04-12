<!DOCTYPE html>
<html lang="id">
<head>
    <link rel="icon" href="{{ asset('img/logoases.jpg') }}" type="img/jpg">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>@yield('title') - My Journey</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            /* Palette My Journey (Full Ungu / Violet Modern) */
            --nk-dark: #0f172a;       
            --nk-primary: #7c3aed;    /* Violet / Ungu Tegas */
            --nk-primary-hover: #6d28d9; /* Ungu Gelap */
            --nk-secondary: #c084fc;  /* Ungu Muda / Soft Fuchsia */
            --nk-bg: #f8fafc;
            --nk-surface: #FFFFFF;
            --nk-gray: #64748b;
        }

        /* --- OVERRIDE BOOTSTRAP (Biar gak ada biru nyasar) --- */
        .text-primary { color: var(--nk-primary) !important; }
        .bg-primary { background-color: var(--nk-primary) !important; }
        .text-info { color: var(--nk-secondary) !important; } /* Ubah biru cyan jadi ungu muda */

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--nk-bg);
            color: var(--nk-dark);
            -webkit-font-smoothing: antialiased;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            overflow-x: hidden;
            /* Efek kabut di ujung layar sekarang warna ungu */
            background-image: radial-gradient(circle at top right, rgba(124, 58, 237, 0.05) 0%, transparent 40%),
                              radial-gradient(circle at bottom left, rgba(192, 132, 252, 0.05) 0%, transparent 40%);
        }

        /* --- NAVBAR GLASSMORPHISM --- */
        .navbar-alive {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border-bottom: 1px solid rgba(255,255,255,0.3);
            padding: 1rem 0;
            transition: all 0.3s ease;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.03);
        }

        .navbar-brand img { height: 42px; width: auto; border-radius: 10px; }

        .nav-link-alive {
            color: var(--nk-gray);
            font-weight: 600;
            padding: 8px 18px !important;
            border-radius: 50px;
            transition: all 0.3s ease-in-out;
            margin: 0 5px;
        }
        
        .nav-link-alive:hover, .nav-link-alive.active {
            color: var(--nk-primary);
            background-color: rgba(124, 58, 237, 0.08); /* Hover efek ungu */
            transform: translateY(-2px);
        }

        .navbar-toggler { border: none; padding: 0; color: var(--nk-dark); }
        .navbar-toggler:focus { box-shadow: none; }

        /* --- BUTTONS --- */
        .btn-alive-primary {
            background: linear-gradient(135deg, var(--nk-primary) 0%, var(--nk-secondary) 100%);
            color: white; border: none; padding: 12px 28px;
            border-radius: 50px; font-weight: 700; 
            box-shadow: 0 10px 20px rgba(124, 58, 237, 0.2);
            transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }
        .btn-alive-primary:hover {
            color: white; transform: translateY(-4px) scale(1.02);
            box-shadow: 0 15px 25px rgba(124, 58, 237, 0.3);
        }

        .btn-alive-outline {
            background: white; border: 2px solid #e2e8f0; color: var(--nk-dark); padding: 10px 28px;
            border-radius: 50px; font-weight: 700; transition: all 0.3s ease;
        }
        .btn-alive-outline:hover {
            border-color: var(--nk-primary); color: var(--nk-primary); transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.05);
        }

        /* --- UTILS --- */
        .user-dropdown-btn {
            background: white; border: 1px solid #e2e8f0; padding: 6px 18px 6px 6px;
            border-radius: 50px; display: flex; align-items: center; gap: 12px; transition: all 0.3s;
        }
        .user-dropdown-btn:hover { border-color: var(--nk-primary); box-shadow: 0 8px 15px rgba(124, 58, 237, 0.1); }

        .card-modern {
            background: rgba(255, 255, 255, 0.9); backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.5); border-radius: 24px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.03); transition: all 0.4s ease;
        }
        .card-modern:hover {
            transform: translateY(-8px); box-shadow: 0 20px 40px rgba(124, 58, 237, 0.08); 
            border-color: rgba(124, 58, 237, 0.2);
        }

        /* --- FOOTER --- */
        .footer-alive {
            background: var(--nk-dark); color: #ecf0f1; padding-top: 5rem; margin-top: auto;
            position: relative; overflow: hidden;
            border-top-left-radius: 40px; border-top-right-radius: 40px;
        }
        .footer-glow {
            position: absolute; top: -50px; left: 50%; transform: translateX(-50%); 
            width: 300px; height: 100px; background: var(--nk-primary); opacity: 0.3; filter: blur(60px);
        }
        .footer-brand-text { font-weight: 800; font-size: 1.6rem; color: white; letter-spacing: -0.5px; }
        .footer-desc { color: #94a3b8; line-height: 1.8; font-size: 0.95rem; margin-top: 1rem; }
        .footer-link { color: #cbd5e1; text-decoration: none; display: block; margin-bottom: 0.8rem; transition: all 0.3s ease; font-size: 0.95rem; }
        .footer-link:hover { color: var(--nk-secondary); transform: translateX(5px); }
        .social-icon {
            width: 42px; height: 42px; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); 
            display: inline-flex; align-items: center; justify-content: center;
            border-radius: 14px; color: white; margin-right: 12px; transition: all 0.3s; text-decoration: none;
        }
        .social-icon:hover { background: var(--nk-primary); border-color: var(--nk-primary); transform: translateY(-5px) rotate(8deg); }
        .footer-bottom { 
            background: rgba(0,0,0,0.3); padding: 1.5rem 0; margin-top: 4rem; font-size: 0.9rem; color: #64748b; 
        }

        .fade-in-up { animation: fadeInUp 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards; opacity: 0; transform: translateY(30px); }
        @keyframes fadeInUp { to { opacity: 1; transform: translateY(0); } }

        /* Mobile Adjustments */
        @media (max-width: 991.98px) {
            .navbar-collapse {
                background: white; margin-top: 15px; padding: 20px; border-radius: 20px;
                box-shadow: 0 15px 40px rgba(0,0,0,0.1); border: 1px solid #f1f5f9;
            }
            .user-dropdown-btn { width: 100%; justify-content: center; margin-top: 10px; padding: 12px; }
            .footer-alive { padding-top: 4rem; text-align: center; border-radius: 0; }
            .d-flex.align-items-start, .d-flex.align-items-center { justify-content: center; }
            .footer-bottom .text-md-end { text-align: center !important; margin-top: 10px; }
        }
    </style>
</head>
<body>
    
    <nav class="navbar navbar-expand-lg navbar-alive fixed-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2" href="{{ url('/') }}">
                <img src="{{ asset('img/logoases.jpg') }}" alt="My Journey" class="shadow-sm">
                <span class="fw-bold fs-4" style="color: var(--nk-dark); letter-spacing: -0.5px;">
                    My<span style="color: var(--nk-primary)">Journey</span>
                </span>
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="fas fa-bars fa-lg" style="color: var(--nk-primary);"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto text-center text-lg-start">
                    <li class="nav-item">
                        <a class="nav-link nav-link-alive {{ Request::routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-alive {{ Request::routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">Tentang Kami</a>
                    </li>
                    
                    @auth
                        <li class="nav-item">
                            <a class="nav-link nav-link-alive {{ Request::routeIs('test.history') ? 'active' : '' }}" href="{{ route('test.history') }}">
                                Riwayat Tes
                            </a>
                        </li>

                        @if(Auth::user()->is_admin)
                            <li class="nav-item ms-lg-2">
                                <a class="nav-link nav-link-alive text-primary" href="{{ route('admin.dashboard') }}">
                                    <i class="fas fa-shield-alt me-1"></i> Dashboard
                                </a>
                            </li>
                        @endif
                    @endauth
                </ul>

                <div class="d-flex flex-column flex-lg-row align-items-center gap-2 mt-3 mt-lg-0">
                    @auth
                        <div class="dropdown w-100 w-lg-auto">
                            <button class="user-dropdown-btn dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                <div class="text-white rounded-circle d-flex align-items-center justify-content-center shadow-sm" style="background: linear-gradient(135deg, var(--nk-primary), var(--nk-secondary)); width: 34px; height: 34px; font-weight: bold; font-size: 0.95rem;">
                                    {{ substr(Auth::user()->name, 0, 1) }}
                                </div>
                                <span class="fw-bold small text-dark">{{ explode(' ', Auth::user()->name)[0] }}</span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg rounded-4 p-2 mt-2 w-100 text-center text-lg-start" style="min-width: 200px;">
                                <li><a href="{{ route('test.history') }}" class="dropdown-item rounded-3 py-2 fw-semibold"><i class="fas fa-history me-2 text-primary"></i> Riwayat Tes</a></li>
                                <li><hr class="dropdown-divider opacity-10"></li>
                                <li>
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button class="dropdown-item rounded-3 py-2 text-danger fw-bold w-100 text-center text-lg-start"><i class="fas fa-sign-out-alt me-2"></i> Keluar</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="btn-alive-outline text-decoration-none w-100 w-lg-auto text-center mb-2 mb-lg-0">Masuk</a>
                        <a href="{{ route('register') }}" class="btn-alive-primary w-100 w-lg-auto text-center">Daftar Akun</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <div style="height: 100px;"></div>

    <div class="container py-4 mb-5">
        @yield('content')
    </div>

    <footer class="footer-alive">
        <div class="footer-glow"></div>
        <div class="container">
            <div class="row g-5 justify-content-center">
                
                <div class="col-lg-5 col-md-6 text-center text-lg-start">
                    <a href="{{ url('/') }}" class="text-decoration-none d-flex align-items-center justify-content-center justify-content-lg-start gap-3 mb-4">
                        <div class="bg-white p-2 rounded-4 d-inline-block shadow">
                            <img src="{{ asset('img/logoases.jpg') }}" alt="Logo" style="height: 40px; width: auto; border-radius: 8px;">
                        </div>
                        <span class="footer-brand-text">My<span style="color: var(--nk-secondary);">Journey</span></span>
                    </a>
                    <p class="footer-desc mx-auto mx-lg-0" style="max-width: 400px;">
                        Setiap langkah punya cerita. Temukan potensi terbaikmu dan mulai perjalanan karir yang sesungguhnya bersama My Journey.
                    </p>
                    <div class="d-flex mt-4 justify-content-center justify-content-lg-start gap-2">
                        <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="social-icon"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#" class="social-icon"><i class="fab fa-tiktok"></i></a>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 text-center text-lg-start">
                    <h5 class="footer-heading">Navigasi</h5>
                    <ul class="list-unstyled">
                        <li><a href="{{ url('/') }}" class="footer-link">Beranda</a></li>
                        <li><a href="{{ url('/tentang-kami') }}" class="footer-link">Tentang Tim</a></li>
                        <li><a href="{{ route('instructions') }}" class="footer-link">Mulai Asesmen</a></li>
                    </ul>
                </div>

                <div class="col-lg-4 col-md-12 text-center text-lg-start">
                    <h5 class="footer-heading">Hubungi Kami</h5>
                    <ul class="list-unstyled small" style="color: #cbd5e1;"> 
                        <li class="d-flex align-items-center justify-content-center justify-content-lg-start gap-3 mb-3">
                            <div class="bg-white bg-opacity-10 p-2 rounded-circle"><i class="fas fa-map-marker-alt text-primary"></i></div>
                            <span>Universitas Negeri Malang</span>
                        </li>
                        <li class="d-flex align-items-center justify-content-center justify-content-lg-start gap-3 mb-3">
                            <div class="bg-white bg-opacity-10 p-2 rounded-circle"><i class="fas fa-envelope text-primary"></i></div>
                            <span>myjourney@gmail.com</span>
                        </li>
                    </ul>
                </div>

            </div>
        </div>

        <div class="footer-bottom">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-6 text-center text-lg-start mb-2 mb-md-0 fw-medium">
                        &copy; {{ date('Y') }} My Journey Indonesia.
                    </div>
                    <div class="col-md-6 text-center text-lg-end">
                        <small>
                            Crafted with <i class="fas fa-fire text-warning mx-1"></i> by 
                            <span class="text-white fw-bold">J21Team</span>
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>