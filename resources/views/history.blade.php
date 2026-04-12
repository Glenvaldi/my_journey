@extends('layout.app')
@section('title', 'Riwayat Tes Saya')

@section('content')
<div class="row justify-content-center fade-in-up">
    <div class="col-lg-9">
        
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-end mb-5 gap-3">
            <div>
                <h2 class="fw-bold text-dark mb-2" style="letter-spacing: -0.5px;">Jejak Minatmu</h2>
                <p class="text-muted mb-0">Pantau perkembangan hasil asesmen karirmu di sini.</p>
            </div>
            
            <a href="{{ route('instructions') }}" class="btn btn-alive-primary shadow-lg d-flex align-items-center gap-2 px-4 py-2 rounded-pill">
                <i class="fas fa-plus-circle"></i> Mulai Tes Baru
            </a>
        </div>

        @if($histories->count() > 0)
            <div class="row g-4">
                @foreach($histories as $history)
                <div class="col-12">
                    <div class="history-card bg-white p-4 rounded-4 border border-light d-flex flex-column flex-md-row align-items-center gap-4 position-relative overflow-hidden">
                        
                        <div class="accent-line"></div>

                        <div class="flex-shrink-0">
                            <div class="result-avatar d-flex align-items-center justify-content-center text-white fw-bold shadow-sm">
                                {{ $history->result_code }}
                            </div>
                        </div>
                        
                        <div class="flex-grow-1 text-center text-md-start">
                            <h5 class="fw-bold text-dark mb-2">{{ $history->result_name }}</h5>
                            
                            <div class="d-flex flex-wrap justify-content-center justify-content-md-start gap-3 text-muted small">
                                <span class="d-flex align-items-center gap-1 bg-light px-2 py-1 rounded">
                                    <i class="far fa-calendar-alt text-primary"></i> 
                                    {{ $history->created_at->format('d M Y') }}
                                </span>
                                
                                <span class="d-flex align-items-center gap-1 bg-light px-2 py-1 rounded">
                                    <i class="far fa-clock text-primary"></i> 
                                    {{ $history->created_at->format('H:i') }} WIB
                                </span>
                                
                                <span class="d-flex align-items-center gap-1 bg-light px-2 py-1 rounded">
                                    <i class="fas fa-graduation-cap text-primary"></i> 
                                    {{ $history->class_grade }}
                                </span>
                            </div>
                        </div>

                        <div class="flex-shrink-0">
                            <a href="{{ route('test.show', $history->id) }}" class="btn btn-alive-outline rounded-pill px-4 d-flex align-items-center gap-2">
                                Lihat Laporan <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>

                    </div>
                </div>
                @endforeach
            </div>
            
            <div class="text-center mt-5 text-muted small">
                <p>Menampilkan {{ $histories->count() }} tes terakhir yang kamu kerjakan.</p>
            </div>

        @else
            <div class="text-center py-5">
                <div class="empty-state-icon mb-4 animate-float">
                    <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 120px; height: 120px;">
                        <i class="fas fa-folder-open fa-4x text-muted opacity-25"></i>
                    </div>
                </div>
                <h4 class="fw-bold text-dark mb-2">Belum Ada Riwayat</h4>
                <p class="text-muted mb-4" style="max-width: 400px; margin: 0 auto;">
                    Kamu belum pernah mengerjakan tes minat bakat. Yuk, cari tahu potensimu sekarang!
                </p>
                <a href="{{ route('instructions') }}" class="btn btn-alive-primary px-5 py-3 rounded-pill shadow-lg">
                    Ambil Tes Pertama <i class="fas fa-magic ms-2"></i>
                </a>
            </div>
        @endif

    </div>
</div>

<style>
    .history-card {
        transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        box-shadow: 0 4px 6px rgba(0,0,0,0.02);
    }
    
    .history-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0, 102, 255, 0.1);
        border-color: rgba(0, 102, 255, 0.2) !important;
    }

    .result-avatar {
        width: 60px; height: 60px;
        border-radius: 16px; 
        background: linear-gradient(135deg, var(--nk-primary), #004ecc);
        font-size: 1.5rem;
    }

    .accent-line {
        position: absolute; left: 0; top: 15%; bottom: 15%; width: 4px;
        background-color: var(--nk-primary);
        border-top-right-radius: 4px; border-bottom-right-radius: 4px;
        opacity: 0; transition: opacity 0.3s;
    }
    
    .history-card:hover .accent-line { opacity: 1; }

    .btn-alive-outline {
        border: 2px solid #e2e8f0; color: var(--nk-dark); font-weight: 700; transition: all 0.3s;
    }
    .btn-alive-outline:hover {
        border-color: var(--nk-primary); color: var(--nk-primary); background: white;
        transform: translateX(5px);
    }

    .animate-float { animation: float 3s ease-in-out infinite; }
    @keyframes float { 0% { transform: translateY(0px); } 50% { transform: translateY(-10px); } 100% { transform: translateY(0px); } }
</style>
@endsection