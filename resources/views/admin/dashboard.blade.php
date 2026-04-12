@extends('layout.app')

@section('title', 'Dashboard Admin')

@section('content')
<div class="row justify-content-center fade-in-up">
    <div class="col-lg-11">
        
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-end mb-5 gap-3">
            <div>
                <h6 class="text-uppercase text-primary fw-bold small ls-1 mb-2">
                    <i class="fas fa-layer-group me-2"></i>Overview
                </h6>
                <h2 class="fw-bold text-dark display-6 mb-1">Dashboard Admin</h2>
                <p class="text-muted mb-0">
                    Halo, <strong class="text-dark">{{ Auth::user()->name }}</strong>! Berikut ringkasan aktivitas terbaru.
                </p>
            </div>
            
            <div class="d-flex gap-2">
                <a href="{{ route('home') }}" class="btn btn-alive-outline rounded-pill px-4">
                    <i class="fas fa-home me-2"></i> Ke Beranda
                </a>
            </div>
        </div>

        <div class="row g-4 mb-5">
            <div class="col-md-4">
                <div class="stat-card bg-white p-4 rounded-4 shadow-sm border border-light h-100 position-relative overflow-hidden">
                    <div class="d-flex align-items-center justify-content-between position-relative z-1">
                        <div>
                            <p class="text-muted small text-uppercase fw-bold mb-1">Total Pengguna</p>
                            <h2 class="fw-bolder text-dark mb-0 display-5">{{ $total_students }}</h2>
                            <small class="text-success fw-bold"><i class="fas fa-arrow-up me-1"></i> Siswa Terdaftar</small>
                        </div>
                        <div class="icon-box bg-primary bg-opacity-10 text-primary">
                            <i class="fas fa-users fa-2x"></i>
                        </div>
                    </div>
                    <div class="stat-blob bg-primary"></div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="stat-card bg-white p-4 rounded-4 shadow-sm border border-light h-100 position-relative overflow-hidden">
                    <div class="d-flex align-items-center justify-content-between position-relative z-1">
                        <div>
                            <p class="text-muted small text-uppercase fw-bold mb-1">Aktivitas Hari Ini</p>
                            <h2 class="fw-bolder text-dark mb-0 display-5">{{ $total_today }}</h2>
                            <small class="text-info fw-bold"><i class="fas fa-chart-line me-1"></i> Tes Dikerjakan</small>
                        </div>
                        <div class="icon-box bg-info bg-opacity-10 text-info">
                            <i class="fas fa-file-signature fa-2x"></i>
                        </div>
                    </div>
                    <div class="stat-blob bg-info"></div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="stat-card bg-white p-4 rounded-4 shadow-sm border border-light h-100 position-relative overflow-hidden">
                    <div class="d-flex align-items-center justify-content-between position-relative z-1">
                        <div>
                            <p class="text-muted small text-uppercase fw-bold mb-1">Dominasi Minat</p>
                            <h4 class="fw-bolder text-dark mb-0 text-truncate" style="max-width: 150px;">
                                {{ $top_interest ?? '-' }}
                            </h4>
                            <small class="text-warning fw-bold"><i class="fas fa-star me-1"></i> Paling Populer</small>
                        </div>
                        <div class="icon-box bg-warning bg-opacity-10 text-warning">
                            <i class="fas fa-crown fa-2x"></i>
                        </div>
                    </div>
                    <div class="stat-blob bg-warning"></div>
                </div>
            </div>
        </div>

        <div class="card-modern bg-white border-0 shadow-sm p-4 rounded-4">
            <div class="d-flex justify-content-between align-items-center mb-4 px-2">
                <h5 class="fw-bold text-dark m-0">Riwayat Tes Terbaru</h5>
                <button class="btn btn-sm btn-light text-muted border rounded-pill px-3">
                    <i class="fas fa-filter me-2"></i> Filter
                </button>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0 custom-table">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-4 py-3 text-uppercase small fw-bold text-muted rounded-start">Siswa</th>
                            <th class="py-3 text-uppercase small fw-bold text-muted">Tanggal</th>
                            <th class="py-3 text-uppercase small fw-bold text-muted">Kelas</th>
                            <th class="py-3 text-uppercase small fw-bold text-muted">Hasil Dominan</th>
                            <th class="pe-4 py-3 text-uppercase small fw-bold text-muted text-end rounded-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($results as $data)
                        <tr>
                            <td class="ps-4 py-3">
                                <div class="d-flex align-items-center">
                                    <div class="avatar-sm bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3 fw-bold shadow-sm">
                                        {{ substr($data->fullname, 0, 1) }}
                                    </div>
                                    <div>
                                        <span class="d-block fw-bold text-dark">{{ $data->fullname }}</span>
                                        <small class="text-muted" style="font-size: 0.75rem;">User ID: #{{ $data->user_id }}</small>
                                    </div>
                                </div>
                            </td>
                            
                            <td class="py-3">
                                <div class="d-flex align-items-center text-muted small">
                                    <i class="far fa-calendar-alt me-2 text-primary opacity-50"></i>
                                    {{ $data->created_at->format('d M Y, H:i') }}
                                </div>
                            </td>

                            <td class="py-3">
                                <span class="badge bg-light text-dark border px-3 py-2 rounded-pill fw-normal">
                                    {{ $data->class_grade }}
                                </span>
                            </td>

                            <td class="py-3">
                                <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill">
                                    {{ $data->result_name }}
                                </span>
                            </td>

                            <td class="pe-4 py-3 text-end">
                                <a href="{{ route('admin.history.show', $data->id) }}" class="btn btn-icon btn-sm btn-light text-primary border rounded-circle" data-bs-toggle="tooltip" title="Lihat Detail">
                                    <i class="fas fa-arrow-right"></i>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center p-5">
                                <div class="opacity-50 mb-3">
                                    <i class="fas fa-inbox fa-3x text-muted"></i>
                                </div>
                                <h6 class="fw-bold text-muted">Belum ada data masuk</h6>
                                <p class="text-muted small">Data hasil tes siswa akan muncul di sini.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <div class="d-flex justify-content-end pt-4 px-2">
                {{ $results->links('pagination::bootstrap-5') }}
            </div>
        </div>

    </div>
</div>

<style>
    /* Styling Kartu Statistik */
    .stat-card {
        transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }
    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0, 102, 255, 0.1) !important;
        border-color: var(--nk-primary) !important;
    }
    
    /* Icon Box di Kartu Stat */
    .icon-box {
        width: 60px; height: 60px;
        border-radius: 16px;
        display: flex; align-items: center; justify-content: center;
    }

    /* Dekorasi Blob di Kartu Stat */
    .stat-blob {
        position: absolute; bottom: -20px; right: -20px;
        width: 100px; height: 100px;
        border-radius: 50%; opacity: 0.1; filter: blur(30px);
        z-index: 0;
    }

    /* Tabel Modern */
    .custom-table tr {
        transition: all 0.2s ease;
    }
    .custom-table tr:hover td {
        background-color: #f8fafc;
    }
    .avatar-sm {
        width: 40px; height: 40px; font-size: 1.1rem;
        background: linear-gradient(135deg, var(--nk-primary), #004ecc);
    }

    /* Tombol Icon Bulat */
    .btn-icon {
        width: 35px; height: 35px;
        display: inline-flex; align-items: center; justify-content: center;
        transition: all 0.2s;
    }
    .btn-icon:hover {
        background-color: var(--nk-primary); color: white !important; border-color: var(--nk-primary) !important;
    }

    /* Tombol Outline Hidup (Copied from other pages) */
    .btn-alive-outline {
        border: 2px solid #e2e8f0; color: var(--nk-dark); font-weight: 700; transition: all 0.3s;
    }
    .btn-alive-outline:hover {
        border-color: var(--nk-primary); color: var(--nk-primary); background: white;
        transform: translateX(5px);
    }
</style>
@endsection