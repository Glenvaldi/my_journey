@extends('layout.app')
@section('title', 'Hasil Analisis')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-11 fade-in-up">
        
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-5 bg-white p-4 rounded-4 shadow-sm border border-light" id="headerArea">
            <div class="d-flex align-items-center gap-4">
                <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                    <i class="fas fa-trophy fa-2x"></i>
                </div>
                <div>
                    <h5 class="text-uppercase text-muted small fw-bold ls-1 mb-1">Laporan Analisis Potensi</h5>
                    @if(isset($historyData))
                        <h2 class="fw-bold text-dark m-0">{{ $historyData->fullname }}</h2>
                        <span class="badge bg-secondary bg-opacity-10 text-secondary mt-2 no-print"><i class="fas fa-history me-1"></i> Arsip Riwayat</span>
                    @else
                        <h2 class="fw-bold text-dark m-0">{{ request('fullname') }}</h2>
                        <span class="badge bg-success bg-opacity-10 text-success mt-2 no-print"><i class="fas fa-check-circle me-1"></i> Hasil Terbaru</span>
                    @endif
                </div>
            </div>
            
            <div class="text-end mt-3 mt-md-0" id="headerDetail">
                <p class="text-muted small mb-1">Kelas / Jurusan</p>
                <div class="d-inline-block px-4 py-2 bg-light rounded-pill border fw-bold text-dark shadow-sm">
                    <i class="fas fa-graduation-cap text-primary me-2"></i> 
                    {{ isset($historyData) ? $historyData->class_grade : request('class_grade') }}
                </div>
            </div>
        </div>

        <div id="printableArea" class="p-3" style="background-color: #f8fafc; border-radius: 24px;">
            <div class="row g-4" id="mainRow">
                
                <div class="col-lg-5" id="colLeft"> 
                    <div class="card-result h-100 position-relative overflow-hidden text-center text-white">
                        
                        <div class="blob-bg spin-slow"></div>
                        <div class="blob-bg-2 spin-reverse"></div>

                        <div class="position-relative z-1 d-flex flex-column h-100 justify-content-center p-5">
                            <h5 class="text-white-50 text-uppercase ls-2 small fw-bold mb-4">Tipe Kepribadianmu</h5>
                            
                            <div class="result-circle mx-auto mb-4 animate-pop">
                                {{ $result->code }}
                            </div>
                            
                            <h1 class="fw-bolder mb-3 display-5">{{ $result->name }}</h1>
                            <p class="text-white-50 mb-5 fs-6 lh-lg px-2">
                                {{ $result->description }}
                            </p>
                            
                            <button onclick="takeScreenshot()" class="btn btn-white-glow w-100 py-3 rounded-pill fw-bold no-print mt-auto shadow-lg">
                                <i class="fas fa-camera text-primary me-2"></i> Simpan Gambar Hasil
                            </button>
                        </div>
                    </div>
                </div>

                <div class="col-lg-7" id="colRight">
                    <div class="d-flex flex-column gap-3 h-100">
                        
                        <div class="card-modern bg-white p-4 p-md-4 border-0 shadow-sm">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h5 class="fw-bold text-dark m-0">
                                    <i class="fas fa-chart-radar text-primary me-2"></i> Peta Kepribadian
                                </h5>
                                <div class="d-flex gap-3 small">
                                    <span class="d-flex align-items-center text-muted"><span class="d-inline-block rounded-circle me-1" style="width:10px;height:10px;background:#e2e8f0;"></span> Rata-rata</span>
                                    <span class="d-flex align-items-center fw-bold text-primary"><span class="d-inline-block rounded-circle me-1" style="width:10px;height:10px;background:var(--nk-primary);"></span> Skormu</span>
                                </div>
                            </div>
                            <div class="position-relative chart-container">
                                <canvas id="careerChart"></canvas>
                            </div>
                        </div>

                        <div class="card-modern bg-white p-4 p-md-4 border-0 shadow-sm">
                            <h5 class="fw-bold text-dark mb-4">
                                <i class="fas fa-university text-primary me-2"></i> Rekomendasi Kampus & Jurusan
                            </h5>
                            <div class="row g-3">
                                @foreach($result->universities as $major => $univs)
                                    <div class="col-md-12">
                                        <div class="p-3 rounded-4 h-100 shadow-sm" style="background-color: rgba(79, 70, 229, 0.03); border: 1px solid rgba(79, 70, 229, 0.1);">
                                            <div class="fw-bold text-dark mb-3" style="font-size: 0.95rem;">
                                                <i class="fas fa-graduation-cap text-primary me-2"></i> {{ $major }}
                                            </div>
                                            <div class="d-flex flex-wrap gap-2">
                                                @foreach($univs as $name => $url)
                                                    <a href="{{ $url }}" target="_blank" class="link-action badge bg-white border text-decoration-none py-2 px-3 shadow-sm no-print-link">
                                                        {{ $name }} <i class="fas fa-external-link-alt ms-1 text-muted" style="font-size: 0.65rem;"></i>
                                                    </a>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        
                        <div class="card-modern bg-white p-4 p-md-4 border-0 shadow-sm">
                            <h5 class="fw-bold text-dark mb-3">
                                <i class="fas fa-briefcase text-primary me-2"></i> Prospek Karir & Pekerjaan
                            </h5>
                            <div class="d-flex flex-wrap gap-2">
                                @foreach(explode(',', $result->jobs) as $job)
                                    <div class="major-pill" style="background-color: rgba(79, 70, 229, 0.05); border-color: rgba(79, 70, 229, 0.15); color: var(--nk-dark);">
                                        <i class="fas fa-star text-primary small me-2"></i> {{ trim($job) }}
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="card-modern bg-white p-4 p-md-4 border-0 shadow-sm">
                            <h5 class="fw-bold text-dark mb-3">
                                <i class="fas fa-building text-primary me-2"></i> Rekomendasi Tempat Kerja
                            </h5>
                            <div class="d-flex flex-wrap gap-2">
                                @foreach($result->companies as $companyName => $companyUrl)
                                    <a href="{{ $companyUrl }}" target="_blank" class="link-action badge bg-white border text-decoration-none py-2 px-3 shadow-sm no-print-link">
                                        <i class="fas fa-building text-primary small me-1"></i> {{ $companyName }} <i class="fas fa-external-link-alt ms-1 text-muted" style="font-size: 0.65rem;"></i>
                                    </a>
                                @endforeach
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div> 

        <div class="mt-5 mb-5 d-flex justify-content-center gap-3 fade-in-up no-print">
            @if(isset($isAdminView))
                <a href="{{ route('admin.user.history', $historyData->user_id) }}" class="btn btn-alive-outline rounded-pill px-4">
                    <i class="fas fa-arrow-left me-2"></i> Kembali ke List User
                </a>
            @elseif(isset($isHistory))
                <a href="{{ route('test.history') }}" class="btn btn-alive-outline rounded-pill px-4">
                    <i class="fas fa-arrow-left me-2"></i> Kembali ke Riwayat
                </a>
            @else
                <a href="{{ route('test.index') }}" class="btn btn-link text-muted text-decoration-none">
                    <i class="fas fa-redo me-1"></i> Ulangi Tes
                </a>
                <a href="{{ route('test.history') }}" class="btn btn-alive-primary rounded-pill px-4 shadow-sm">
                    Lihat Riwayat Saya <i class="fas fa-arrow-right ms-2"></i>
                </a>
            @endif
        </div>

    </div>
</div>

<div id="loadingOverlay" class="d-none position-fixed top-0 start-0 w-100 h-100 d-flex flex-column justify-content-center align-items-center bg-white bg-opacity-75" style="backdrop-filter: blur(5px); z-index: 9999;">
    <div class="spinner-border text-primary mb-3" style="width: 3rem; height: 3rem;" role="status"></div>
    <h5 class="fw-bold text-dark">Memproses Sertifikat...</h5>
    <p class="text-muted">Merapikan desain untuk disimpan.</p>
</div>

<style>
    /* Styling Tampilan Layar */
    .card-result { background: linear-gradient(135deg, var(--nk-dark) 0%, #0f172a 100%); border-radius: 24px; box-shadow: 0 20px 40px rgba(0, 29, 61, 0.2); color: white; }
    .blob-bg { position: absolute; top: -50px; right: -50px; width: 200px; height: 200px; background: var(--nk-primary); opacity: 0.3; filter: blur(60px); border-radius: 50%; }
    .blob-bg-2 { position: absolute; bottom: -50px; left: -50px; width: 200px; height: 200px; background: var(--nk-secondary); opacity: 0.2; filter: blur(60px); border-radius: 50%; }
    
    .spin-slow { animation: spinBlob 12s linear infinite; }
    .spin-reverse { animation: spinBlob 18s linear infinite reverse; }
    @keyframes spinBlob { 100% { transform: rotate(360deg) scale(1.1); } }

    .result-circle { width: 120px; height: 120px; background: rgba(255, 255, 255, 0.1); backdrop-filter: blur(10px); border: 2px solid rgba(255, 255, 255, 0.2); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 3.5rem; font-weight: 800; color: white; box-shadow: 0 0 30px rgba(79, 70, 229, 0.3); }
    .animate-pop { animation: popIn 0.8s cubic-bezier(0.175, 0.885, 0.32, 1.275); }
    @keyframes popIn { 0% { transform: scale(0); opacity: 0; } 100% { transform: scale(1); opacity: 1; } }
    
    .btn-white-glow { background: white; color: var(--nk-primary); border: none; transition: all 0.3s ease; }
    .btn-white-glow:hover { background: #f8fafc; transform: translateY(-3px) scale(1.02); box-shadow: 0 15px 25px rgba(255, 255, 255, 0.3); color: var(--nk-dark); }
    .btn-alive-outline { border: 2px solid #e2e8f0; color: var(--nk-dark); font-weight: 700; transition: all 0.3s; }
    .btn-alive-outline:hover { border-color: var(--nk-primary); color: var(--nk-primary); background: white; transform: translateX(-3px); box-shadow: 0 10px 20px rgba(0,0,0,0.05); }
    
    .chart-container { position: relative; height: 320px; width: 100%; }
    .major-pill { background: #f8fafc; border: 1px solid #e2e8f0; padding: 10px 20px; border-radius: 50px; font-weight: 600; color: #334155; font-size: 0.95rem; transition: all 0.3s ease; cursor: default; }
    .major-pill:hover { background: white; border-color: var(--nk-primary); transform: translateY(-2px); box-shadow: 0 4px 10px rgba(79, 70, 229, 0.1); }

    /* Tombol Link Kampus & Perusahaan */
    .link-action {
        color: var(--nk-dark) !important;
        border-color: rgba(79, 70, 229, 0.2) !important;
        transition: all 0.2s;
    }
    .link-action:hover {
        background-color: var(--nk-primary) !important;
        color: white !important;
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(79, 70, 229, 0.2) !important;
    }
    .link-action:hover i { color: white !important; }

    /* CSS Memaksa Tampilan Screenshot */
    .capture-mode {
        width: 1200px !important; max-width: 1200px !important; margin: 0 auto; padding: 40px !important;
    }
    .capture-mode #headerArea { flex-direction: row !important; }
    .capture-mode #headerDetail { margin-top: 0 !important; text-align: right !important; }
    
    .capture-mode #mainRow { flex-wrap: nowrap !important; }
    .capture-mode #colLeft { width: 41.666667% !important; max-width: 41.666667% !important; flex: 0 0 41.666667% !important; }
    .capture-mode #colRight { width: 58.333333% !important; max-width: 58.333333% !important; flex: 0 0 58.333333% !important; }

    /* Sembunyikan ikon "Link External" pas di-Screenshot biar rapi */
    .capture-mode .no-print-link i.fa-external-link-alt { display: none !important; }
</style>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

<script>
    // 1. RENDER GRAFIK RADAR
    const ctx = document.getElementById('careerChart');
    const chartLabels = {!! json_encode($chartLabels) !!};
    const chartData = {!! json_encode($chartData) !!};

    if (chartLabels.length > 0) {
        const maxDataVal = Math.max(...chartData);
        const suggestedMax = maxDataVal > 0 ? maxDataVal + (maxDataVal * 0.2) : 5;

        new Chart(ctx, {
            type: 'radar',
            data: {
                labels: chartLabels, 
                datasets: [{
                    label: 'Skor Minat',
                    data: chartData,
                    borderWidth: 2, 
                    backgroundColor: 'rgba(79, 70, 229, 0.15)', // Warna Indigo Transparan
                    borderColor: '#4f46e5', 
                    pointBackgroundColor: '#4f46e5',
                    pointBorderColor: '#fff',
                    pointHoverBackgroundColor: '#fff',
                    pointHoverBorderColor: '#4f46e5',
                    pointRadius: 5
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    r: {
                        angleLines: { display: true, color: 'rgba(0,0,0,0.1)' }, 
                        grid: { color: 'rgba(0,0,0,0.1)', circular: true }, 
                        pointLabels: { font: { size: 12, family: 'Plus Jakarta Sans', weight: '700' }, color: '#334155' },
                        ticks: { display: true, stepSize: 5, color: '#94a3b8', backdropColor: 'transparent', font: { size: 10, weight: 'bold' } },
                        beginAtZero: true,
                        suggestedMax: suggestedMax
                    }
                },
                plugins: { legend: { display: false } }
            }
        });
    }

    // 2. FUNGSI SCREENSHOT (Dilengkapi Trik Responsif HP)
    async function takeScreenshot() {
        document.getElementById('loadingOverlay').classList.remove('d-none');

        const noPrintElements = document.querySelectorAll('.no-print, header, footer, nav, .navbar');
        noPrintElements.forEach(el => el.style.display = 'none');

        const headerArea = document.getElementById('headerArea');
        const printableArea = document.getElementById('printableArea');
        printableArea.prepend(headerArea);

        // Paksa ke Layout Desktop
        printableArea.classList.add('capture-mode');

        // Sembunyikan Blob biar nggak ngeblur di canvas
        const blobs = document.querySelectorAll('.blob-bg, .blob-bg-2');
        blobs.forEach(b => b.style.display = 'none'); 

        const circle = document.querySelector('.result-circle');
        const originalBackdrop = circle.style.backdropFilter;
        circle.style.backdropFilter = 'none';
        circle.style.backgroundColor = 'rgba(255, 255, 255, 0.15)'; 

        try {
            await new Promise(resolve => setTimeout(resolve, 100));

            const canvas = await html2canvas(printableArea, {
                scale: 2, 
                useCORS: true,
                backgroundColor: '#f8fafc',
                windowWidth: 1200 
            });

            const link = document.createElement('a');
            link.download = 'Hasil-Asesmen-MyJourney.png'; 
            link.href = canvas.toDataURL('image/png');
            link.click(); 

        } catch (error) {
            console.error("Oops, ada error saat foto:", error);
            alert("Maaf, terjadi kesalahan saat mengambil gambar.");
        } finally {
            // Kembalikan ke mode awal
            printableArea.classList.remove('capture-mode');
            noPrintElements.forEach(el => el.style.display = '');
            blobs.forEach(b => b.style.display = '');
            circle.style.backdropFilter = originalBackdrop;
            circle.style.backgroundColor = 'rgba(255, 255, 255, 0.1)';
            
            printableArea.parentElement.insertBefore(headerArea, printableArea);
            document.getElementById('loadingOverlay').classList.add('d-none');
        }
    }
</script>
@endpush
@endsection