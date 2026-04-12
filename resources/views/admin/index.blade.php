@extends('layout.app')
@section('title', 'Kelola Pengguna')

@section('content')
<div class="row justify-content-center fade-in-up">
    <div class="col-lg-11">
        
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-end mb-5 gap-3">
            <div>
                <h6 class="text-uppercase text-primary fw-bold small ls-1 mb-2">
                    <i class="fas fa-users-cog me-2"></i>Admin Panel
                </h6>
                <h2 class="fw-bold text-dark display-6 mb-1">Daftar Pengguna</h2>
                <p class="text-muted mb-0">Kelola data siswa dan pantau aktivitas mereka.</p>
            </div>
            
            <a href="{{ route('admin.dashboard') }}" class="btn btn-alive-outline rounded-pill px-4">
                <i class="fas fa-arrow-left me-2"></i> Dashboard
            </a>
        </div>

        <div class="card-modern bg-white border-0 shadow-sm rounded-4 overflow-hidden">
            
            <div class="p-4 border-bottom border-light bg-white d-flex justify-content-between align-items-center">
                <h5 class="fw-bold text-dark m-0">Semua Siswa <span class="badge bg-light text-primary border ms-2">{{ $users->total() }}</span></h5>
                <div class="d-flex gap-2">
                    <button class="btn btn-sm btn-light border rounded-pill px-3 text-muted">
                        <i class="fas fa-search me-2"></i> Cari User...
                    </button>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0 custom-table">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-4 py-3 text-uppercase small fw-bold text-muted text-start rounded-start">User Profile</th>
                            <th class="py-3 text-uppercase small fw-bold text-muted">Status Akun</th>
                            <th class="py-3 text-uppercase small fw-bold text-muted text-center">Total Tes</th>
                            <th class="py-3 text-uppercase small fw-bold text-muted">Bergabung</th>
                            <th class="pe-4 py-3 text-uppercase small fw-bold text-muted text-end rounded-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                        <tr>
                            <td class="ps-4 py-3">
                                <div class="d-flex align-items-center">
                                    <div class="avatar-initials me-3 shadow-sm">
                                        {{ substr($user->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <span class="d-block fw-bold text-dark">{{ $user->name }}</span>
                                        <small class="text-muted">{{ $user->email }}</small>
                                    </div>
                                </div>
                            </td>

                            <td class="py-3">
                                <span class="badge bg-success bg-opacity-10 text-success border border-success-subtle px-3 py-1 rounded-pill">
                                    Active Student
                                </span>
                            </td>

                            <td class="py-3 text-center">
                                @if($user->test_results_count > 0)
                                    <span class="fw-bold text-dark h5 mb-0">{{ $user->test_results_count }}</span>
                                    <small class="text-muted d-block" style="font-size: 0.7rem;">Selesai</small>
                                @else
                                    <span class="text-muted small">-</span>
                                @endif
                            </td>

                            <td class="py-3 text-muted small">
                                {{ $user->created_at->format('d M Y') }}
                            </td>

                            <td class="pe-4 py-3 text-end">
                                <a href="{{ route('admin.user.history', $user->id) }}" class="btn btn-alive-primary btn-sm rounded-pill px-3 py-2 shadow-sm" data-bs-toggle="tooltip" title="Lihat Detail">
                                    Lihat History <i class="fas fa-arrow-right ms-1"></i>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center p-5">
                                <div class="opacity-50 mb-3">
                                    <i class="fas fa-user-slash fa-3x text-muted"></i>
                                </div>
                                <h6 class="fw-bold text-muted">Belum ada data user</h6>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <div class="p-4 border-top border-light d-flex justify-content-end">
                {{ $users->links('pagination::bootstrap-5') }}
            </div>
        </div>

    </div>
</div>

<style>
    /* Styling Tabel & Avatar */
    .custom-table tr { transition: all 0.2s ease; }
    .custom-table tr:hover td { background-color: #f8fafc; }
    
    .avatar-initials {
        width: 45px; height: 45px;
        background: linear-gradient(135deg, var(--nk-primary), #4f46e5);
        color: white; font-weight: 700; font-size: 1.2rem;
        display: flex; align-items: center; justify-content: center;
        border-radius: 12px;
    }
</style>
@endsection