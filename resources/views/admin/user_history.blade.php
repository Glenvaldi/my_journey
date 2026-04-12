@extends('layout.app')
@section('title', 'Riwayat ' . $user->name)

@section('content')
<div class="row justify-content-center fade-in-up">
    <div class="col-lg-9">
        
        <div class="card-modern bg-white p-4 border-0 shadow-sm rounded-4 mb-5 position-relative overflow-hidden">
            <div class="position-absolute top-0 end-0 bg-primary opacity-10 rounded-circle" style="width: 150px; height: 150px; transform: translate(30px, -30px);"></div>
            
            <div class="d-flex flex-column flex-md-row align-items-center gap-4 position-relative z-1">
                <div class="avatar-lg bg-dark text-white rounded-circle d-flex align-items-center justify-content-center shadow-lg" 
                     style="width: 80px; height: 80px; font-size: 2.5rem; font-weight: 800; background: linear-gradient(135deg, #1e293b, #0f172a);">
                    {{ substr($user->name, 0, 1) }}
                </div>
                
                <div class="text-center text-md-start flex-grow-1">
                    <h6 class="text-uppercase text-primary fw-bold small ls-1 mb-1">Profil Siswa</h6>
                    <h2 class="fw-bold text-dark mb-1">{{ $user->name }}</h2>
                    <div class="d-flex flex-wrap justify-content-center justify-content-md-start gap-3 text-muted small">
                        <span><i class="fas fa-envelope me-1"></i> {{ $user->email }}</span>
                        <span><i class="fas fa-calendar-check me-1"></i> Bergabung: {{ $user->created_at->format('d M Y') }}</span>
                    </div>
                </div>

                <div>
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-light border rounded-pill px-4 fw-bold text-muted">
                        <i class="fas fa-arrow-left me-2"></i> Kembali
                    </a>
                </div>
            </div>
        </div>

        <h5 class="fw-bold text-dark mb-4 ps-2 border-start border-4 border-primary ps-3">
            Riwayat Pengerjaan Tes
        </h5>

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
                                <span class="badge bg-light text-dark border fw-normal px-2">
                                    <i class="fas fa-graduation-cap me-1 text-primary"></i> {{ $history->class_grade }}
                                </span>
                                <span class="d-flex align-items-center gap-1">
                                    <i class="far fa-clock text-primary"></i> 
                                    {{ $history->created_at->format('d M Y, H:i') }}
                                </span>
                                <span class="d-flex align-items-center gap-1">
                                    <i class="fas fa-user-edit text-primary"></i> 
                                    Input: {{ $history->fullname }}
                                </span>
                            </div>
                        </div>

                        <div class="flex-shrink-0">
                            <a href="{{ route('admin.history.show', $history->id) }}" class="btn btn-alive-primary rounded-pill px-4 py-2 d-flex align-items-center gap-2 shadow-sm">
                                Cek Detail <i class="fas fa-external-link-alt small"></i>
                            </a>
                        </div>

                    </div>
                </div>
                @endforeach
            </div>
        @else
            <div class="card-modern text-center p-5 border-0 shadow-sm">
                <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 100px; height: 100px;">
                    <i class="fas fa-clipboard-list fa-3x text-muted opacity-25"></i>
                </div>
                <h5 class="fw-bold text-dark">Belum Ada Data</h5>
                <p class="text-muted small">User ini belum pernah menyelesaikan tes apapun.</p>
            </div>
        @endif

    </div>
</div>

<style>
    /* Styling Kartu yang konsisten dengan halaman user */
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
</style>
@endsection