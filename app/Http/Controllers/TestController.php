<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TestResult;
use Illuminate\Support\Facades\Auth;

class TestController extends Controller
{
    public function index()
    {
        $questions = collect($this->getHardcodedQuestions())->shuffle(); 
        return view('test', compact('questions'));
    }

    public function store(Request $request)
    {
        $answers = $request->input('answers');
        $questions = $this->getHardcodedQuestions();
        $totalQuestions = count($questions);
        
        if (!$answers || count($answers) < $totalQuestions) {
            return back()->with('error', 'Mohon lengkapi semua pertanyaan sebelum melihat hasil.');
        }

        $stats = [1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0, 6 => 0];

        foreach($answers as $questionId => $value) {
            $parts = explode('_cat', $value); 
            if(count($parts) == 2) {
                $skor = (int)$parts[0]; 
                $catId = (int)$parts[1]; 
                if(isset($stats[$catId])) {
                    $stats[$catId] += $skor;
                }
            }
        }

        $maxScore = max($stats);
        $maxCategoryId = array_search($maxScore, $stats) ?: 1; 
        
        $categories = $this->getRiasecCategories();
        $result = $categories[$maxCategoryId];

        TestResult::create([
            'user_id' => Auth::id(), 
            'fullname' => $request->input('fullname'),       
            'class_grade' => $request->input('class_grade'), 
            'result_code' => $result->code,
            'result_name' => $result->name,
            'scores' => $stats 
        ]);

        $chartLabels = [];
        foreach($categories as $cat) {
            $chartLabels[] = $cat->name;
        }
        $chartData = array_values($stats);

        return view('result', compact('result', 'chartLabels', 'chartData'));
    }

    public function history()
    {
        $histories = TestResult::where('user_id', Auth::id())
                        ->orderBy('created_at', 'desc')
                        ->get();

        return view('history', compact('histories'));
    }

    public function show($id)
    {
        $history = TestResult::where('id', $id)
                    ->where('user_id', Auth::id())
                    ->firstOrFail();

        $categories = $this->getRiasecCategories();
        $result = null;
        foreach ($categories as $cat) {
            if ($cat->code === $history->result_code) {
                $result = $cat;
                break;
            }
        }

        $chartLabels = [];
        foreach($categories as $cat) {
            $chartLabels[] = $cat->name;
        }
        
        $savedScores = $history->scores ?? []; 
        $chartData = [];
        foreach($categories as $catId => $cat) {
            $chartData[] = $savedScores[$catId] ?? 0; 
        }

        return view('result', [
            'result' => $result,
            'chartLabels' => $chartLabels,
            'chartData' => $chartData,
            'isHistory' => true,      
            'historyData' => $history 
        ]);
    }

    // =====================================================================
    // GUDANG DATA HARDCODE (LINK KAMPUS & PERUSAHAAN LENGKAP!)
    // =====================================================================

    private function getRiasecCategories()
    {
        return [
            1 => (object) [
                'id' => 1, 'code' => 'R', 'name' => 'Realistic (The Doers)', 
                'description' => 'Anda praktis, menyukai aktivitas fisik, bekerja dengan mesin, alat, atau hewan. Anda lebih suka bekerja dengan benda daripada orang atau data.', 
                'majors' => 'Teknik Mesin, Teknik Sipil, Pertanian, Kehutanan, Olahraga, Peternakan, Teknik Elektro.',
                'jobs' => 'Mekanik, Insinyur, Pilot, Koki, Teknisi Jaringan, Arsitek, Petani Modern.',
                'companies' => [
                    'PT Astra International' => 'https://www.astra.co.id/',
                    'Pertamina' => 'https://www.pertamina.com/',
                    'PLN' => 'https://web.pln.co.id/',
                    'Garuda Indonesia' => 'https://www.garuda-indonesia.com/',
                    'PT Waskita Karya' => 'https://www.waskita.co.id/',
                    'Indofood' => 'https://www.indofood.com/'
                ],
                'universities' => [
                    'Teknik Mesin' => ['ITB' => 'https://ftmd.itb.ac.id/id/', 'ITS' => 'https://www.its.ac.id/tmesin/', 'UGM' => 'https://ugm.ac.id/id/prodi/teknik-mesin/', 'UI' => 'https://mech.eng.ui.ac.id/'],
                    'Teknik Sipil' => ['ITB' => 'https://ftsl.itb.ac.id/', 'ITS' => 'https://www.its.ac.id/tsipil/', 'UGM' => 'https://tsipil.ugm.ac.id/', 'UI' => 'https://civil.ui.ac.id/', 'UNDIP' => 'https://sipil.undip.ac.id/'],
                    'Pertanian' => ['IPB' => 'https://faperta.ipb.ac.id/', 'UGM' => 'https://faperta.ugm.ac.id/', 'UB' => 'https://fp.ub.ac.id/', 'UNPAD' => 'https://faperta.unpad.ac.id/'],
                    'Kehutanan' => ['IPB' => 'https://fahutan.ipb.ac.id/', 'UGM' => 'https://fkt.ugm.ac.id/', 'UNHAS' => 'https://kehutanan.unhas.ac.id/'],
                    'Olahraga' => ['UNJ' => 'https://fik.unj.ac.id/', 'UPI' => 'https://fpok.upi.edu/', 'UNY' => 'https://fik.uny.ac.id/', 'UM' => 'https://fik.um.ac.id/'],
                    'Peternakan' => ['IPB' => 'https://fapet.ipb.ac.id/', 'UGM' => 'https://fapet.ugm.ac.id/', 'UB' => 'https://fapet.ub.ac.id/', 'UNPAD' => 'https://peternakan.unpad.ac.id/'],
                    'Teknik Elektro' => ['ITB' => 'https://stei.itb.ac.id/', 'ITS' => 'https://www.its.ac.id/tektro/', 'UI' => 'https://ee.ui.ac.id/', 'UGM' => 'https://te.ugm.ac.id/']
                ]
            ],
            2 => (object) [
                'id' => 2, 'code' => 'I', 'name' => 'Investigative (The Thinkers)', 
                'description' => 'Anda analitis, logis, dan suka memecahkan masalah yang rumit. Anda gemar mengamati, meneliti, dan memahami fenomena alam atau sosial.', 
                'majors' => 'Kedokteran, Biologi, Kimia, Fisika, Matematika, Psikologi, Ilmu Komputer/IT.',
                'jobs' => 'Dokter, Programmer, Data Analyst, Ilmuwan, Peneliti, Apoteker, Ahli Forensik.',
                'companies' => [
                    'Google Indonesia' => 'https://careers.google.com/locations/jakarta/',
                    'Bio Farma' => 'https://www.biofarma.co.id/',
                    'Kalbe Farma' => 'https://www.kalbe.co.id/',
                    'BRIN' => 'https://www.brin.go.id/',
                    'Telkom Indonesia' => 'https://www.telkom.co.id/'
                ],
                'universities' => [
                    'Kedokteran' => ['UI' => 'https://fk.ui.ac.id/', 'UNAIR' => 'https://fk.unair.ac.id/', 'UGM' => 'https://fkkmk.ugm.ac.id/', 'UNPAD' => 'https://fk.unpad.ac.id/', 'UNDIP' => 'https://fk.undip.ac.id/'],
                    'Biologi' => ['UGM' => 'https://biologi.ugm.ac.id/', 'UI' => 'https://biologi.sci.ui.ac.id/', 'ITB' => 'https://sith.itb.ac.id/', 'IPB' => 'https://biologi.ipb.ac.id/', 'UNAIR' => 'https://biologi.fst.unair.ac.id/'],
                    'Kimia' => ['ITB' => 'https://chem.itb.ac.id/', 'UI' => 'https://chem.ui.ac.id/', 'UGM' => 'https://chemistry.ugm.ac.id/', 'ITS' => 'https://www.its.ac.id/kimia/'],
                    'Fisika' => ['UNS' => 'https://mipa.uns.ac.id/fisika/', 'ITB' => 'https://fi.itb.ac.id/', 'UI' => 'https://physics.ui.ac.id/'],
                    'Matematika' => ['ITB' => 'https://math.itb.ac.id/', 'UI' => 'https://math.ui.ac.id/', 'UGM' => 'https://math.fmipa.ugm.ac.id/', 'ITS' => 'https://www.its.ac.id/matematika/', 'UNAIR' => 'https://matematika.fst.unair.ac.id/', 'UB' => 'https://math.ub.ac.id/'],
                    'Psikologi' => ['UI' => 'https://psikologi.ui.ac.id/', 'UPI' => 'https://psikologi.upi.edu/', 'UGM' => 'https://psikologi.ugm.ac.id/', 'UM' => 'https://fpsi.um.ac.id/', 'UNP' => 'https://psikologi.unp.ac.id/'],
                    'Ilmu Komputer / IT' => ['ITB' => 'https://stei.itb.ac.id/', 'UI' => 'https://cs.ui.ac.id/', 'UGM' => 'https://dcse.fmipa.ugm.ac.id/']
                ]
            ],
            3 => (object) [
                'id' => 3, 'code' => 'A', 'name' => 'Artistic (The Creators)', 
                'description' => 'Anda kreatif, ekspresif, dan imajinatif. Anda tidak suka aturan yang kaku dan lebih suka lingkungan yang membebaskan ekspresi diri.', 
                'majors' => 'Desain Komunikasi Visual (DKV), Arsitektur, Sastra, Seni Musik, Film & Televisi, Tata Busana.',
                'jobs' => 'Desainer Grafis, Animator, Penulis, Musisi, Fotografer, Content Creator, Sutradara.',
                'companies' => [
                    'Shopee Creative' => 'https://careers.shopee.co.id/',
                    'Kompas Gramedia' => 'https://www.kompasgramedia.com/',
                    'MD Pictures' => 'https://mdentertainment.com/',
                    'Visinema' => 'https://visinema.co/',
                    'Ogilvy Indonesia' => 'https://www.ogilvy.com/id/'
                ],
                'universities' => [
                    'Desain Kom. Visual' => ['ITB' => 'https://fsrd.itb.ac.id/', 'ISI Yogya' => 'https://isi.ac.id/', 'Binus' => 'https://binus.ac.id/design/', 'Telkom Univ' => 'https://fik.telkomuniversity.ac.id/'],
                    'Arsitektur' => ['ITB' => 'https://sappk.itb.ac.id/', 'UGM' => 'https://archi.ugm.ac.id/', 'UI' => 'https://architecture.ui.ac.id/', 'ITS' => 'https://www.its.ac.id/arsitektur/'],
                    'Ilmu Sastra' => ['UI' => 'https://fib.ui.ac.id/', 'UGM' => 'https://fib.ugm.ac.id/', 'UNPAD' => 'https://fib.unpad.ac.id/', 'UNAIR' => 'https://fib.unair.ac.id/'],
                    'Seni Musik' => ['ISI Yogya' => 'https://isi.ac.id/', 'IKJ' => 'https://ikj.ac.id/', 'UPI' => 'https://fpsd.upi.edu/'],
                    'Film & Televisi' => ['IKJ' => 'https://fftv.ikj.ac.id/', 'ISI' => 'https://isi.ac.id/', 'Binus' => 'https://binus.ac.id/film/'],
                    'Tata Busana' => ['UNJ' => 'https://ft.unj.ac.id/', 'UNY' => 'https://ft.uny.ac.id/', 'UPI' => 'https://fptk.upi.edu/']
                ]
            ],
            4 => (object) [
                'id' => 4, 'code' => 'S', 'name' => 'Social (The Helpers)', 
                'description' => 'Anda ramah, suka menolong, dan pandai bergaul. Anda mendapatkan energi dari berinteraksi dengan orang lain dan membantu mereka berkembang.', 
                'majors' => 'Pendidikan/Keguruan, Keperawatan, Ilmu Komunikasi, Hubungan Internasional, Sosiologi, Pariwisata.',
                'jobs' => 'Guru, Dosen, Perawat, HRD, Konselor, Psikolog, Pekerja Sosial, Tour Guide.',
                'companies' => [
                    'Kemdikbud RI' => 'https://www.kemdikbud.go.id/',
                    'Ruangguru' => 'https://www.ruangguru.com/',
                    'Siloam Hospitals' => 'https://www.siloamhospitals.com/',
                    'Halodoc' => 'https://www.halodoc.com/',
                    'UNICEF Indonesia' => 'https://www.unicef.org/indonesia/',
                    'Traveloka' => 'https://www.traveloka.com/'
                ],
                'universities' => [
                    'Keguruan & Pendidikan' => ['UNY' => 'https://fip.uny.ac.id/', 'UPI' => 'https://fip.upi.edu/', 'UM' => 'https://fip.um.ac.id/', 'UNJ' => 'https://fip.unj.ac.id/'],
                    'Keperawatan' => ['UI' => 'https://nursing.ui.ac.id/', 'UNAIR' => 'https://fkp.unair.ac.id/', 'UGM' => 'https://fkkmk.ugm.ac.id/'],
                    'Ilmu Komunikasi' => ['UI' => 'https://fisip.ui.ac.id/', 'UGM' => 'https://fisipol.ugm.ac.id/', 'UNAIR' => 'https://fisip.unair.ac.id/', 'UNPAD' => 'https://fikom.unpad.ac.id/', 'UNDIP' => 'https://fisip.undip.ac.id/'],
                    'Hubungan Internasional' => ['UI' => 'https://fisip.ui.ac.id/', 'UGM' => 'https://fisipol.ugm.ac.id/', 'UNPAD' => 'https://fisip.unpad.ac.id/', 'UNAIR' => 'https://fisip.unair.ac.id/', 'UNDIP' => 'https://fisip.undip.ac.id/'],
                    'Sosiologi' => ['UGM' => 'https://fisipol.ugm.ac.id/', 'UI' => 'https://fisip.ui.ac.id/', 'UNAIR' => 'https://fisip.unair.ac.id/'],
                    'Pariwisata' => ['UGM' => 'https://pariwisata.fib.ugm.ac.id/', 'UI' => 'https://vokasi.ui.ac.id/', 'Univ Udayana' => 'https://fpar.unud.ac.id/', 'STP Trisakti' => 'https://stptrisakti.ac.id/']
                ]
            ],
            5 => (object) [
                'id' => 5, 'code' => 'E', 'name' => 'Enterprising (The Persuaders)', 
                'description' => 'Anda berjiwa pemimpin, percaya diri, dan suka tantangan. Anda pandai memengaruhi orang lain dan tertarik pada dunia bisnis atau politik.', 
                'majors' => 'Manajemen Bisnis, Hukum, Ilmu Politik, Pemasaran (Marketing), Kewirausahaan.',
                'jobs' => 'Pengusaha, Manajer, Pengacara, Sales Executive, Politikus, Public Relations, CEO.',
                'companies' => [
                    'Bank BCA' => 'https://www.bca.co.id/',
                    'Unilever Indonesia' => 'https://www.unilever.co.id/',
                    'McKinsey & Company' => 'https://www.mckinsey.com/id',
                    'GoTo (Gojek Tokopedia)' => 'https://www.gotocompany.com/',
                    'Kementerian BUMN' => 'https://bumn.go.id/'
                ],
                'universities' => [
                    'Manajemen Bisnis' => ['UGM' => 'https://feb.ugm.ac.id/', 'UI' => 'https://feb.ui.ac.id/', 'ITB (SBM)' => 'https://www.sbm.itb.ac.id/', 'UNAIR' => 'https://manajemen.feb.unair.ac.id/', 'UNDIP' => 'https://feb.undip.ac.id/'],
                    'Ilmu Hukum' => ['UI' => 'https://law.ui.ac.id/', 'UGM' => 'https://law.ugm.ac.id/', 'UNAIR' => 'https://fh.unair.ac.id/', 'UNPAD' => 'https://fh.unpad.ac.id/', 'UNDIP' => 'https://fh.undip.ac.id/'],
                    'Ilmu Politik' => ['UI' => 'https://politics.fisip.ui.ac.id/', 'UGM' => 'https://fisipol.ugm.ac.id/', 'UNAIR' => 'https://politik.fisip.unair.ac.id/'],
                    'Marketing' => ['ITB (SBM)' => 'https://www.sbm.itb.ac.id/', 'UI' => 'https://feb.ui.ac.id/course/manajemen-pemasaran/', 'Binus' => 'https://binus.ac.id/program/marketing-communication-2/', 'Telkom Univ' => 'https://dmm.telkomuniversity.ac.id/'],
                    'Kewirausahaan' => ['SBM ITB' => 'https://itb.ac.id/program-studi-sarjana-kewirausahaan', 'Binus' => 'https://binus.ac.id/entrepreneur/2023/04/19/kewirausahaan/', 'UB' => 'https://feb.ub.ac.id/program-sarjana-kewirausahaan/', 'UNPAD' => 'https://mbkm.unpad.ac.id/?program=wirausaha']
                ]
            ],
            6 => (object) [
                'id' => 6, 'code' => 'C', 'name' => 'Conventional (The Organizers)', 
                'description' => 'Anda rapi, terstruktur, dan teliti. Anda menyukai aturan yang jelas, data yang akurat, dan pekerjaan yang berhubungan dengan administrasi.', 
                'majors' => 'Akuntansi, Administrasi Perkantoran, Perpajakan, Statistika, Manajemen Keuangan, Arsiparis.',
                'jobs' => 'Akuntan, Staf Administrasi, Auditor, Data Entry, Pustakawan, Teller Bank, Sekretaris.',
                'companies' => [
                    'Bank Mandiri' => 'https://www.bankmandiri.co.id/',
                    'PwC Indonesia' => 'https://www.pwc.com/id/',
                    'Ernst & Young (EY)' => 'https://www.ey.com/en_id',
                    'Kementerian Keuangan' => 'https://www.kemenkeu.go.id/',
                    'BPK RI' => 'https://www.bpk.go.id/',
                    'Otoritas Jasa Keuangan' => 'https://www.ojk.go.id/'
                ],
                'universities' => [
                    'Akuntansi' => ['UI' => 'https://feb.ui.ac.id/', 'UGM' => 'https://feb.ugm.ac.id/', 'UNAIR' => 'https://feb.unair.ac.id/', 'UNDIP' => 'https://feb.undip.ac.id/', 'UNPAD' => 'https://feb.unpad.ac.id/'],
                    'Administrasi Perkantoran' => ['UI' => 'https://vokasi.ui.ac.id/', 'UNDIP' => 'https://vokasi.undip.ac.id/', 'UNAIR' => 'https://vokasi.unair.ac.id/', 'UNY' => 'https://fe.uny.ac.id/'],
                    'Perpajakan' => ['UI' => 'https://vokasi.ui.ac.id/', 'UB' => 'https://fia.ub.ac.id/', 'UNAIR' => 'https://vokasi.unair.ac.id/', 'UNDIP' => 'https://vokasi.undip.ac.id/'],
                    'Statistika' => ['ITS' => 'https://www.its.ac.id/statistika/', 'UGM' => 'https://fmipa.ugm.ac.id/', 'UI' => 'https://sci.ui.ac.id/', 'IPB' => 'https://fmipa.ipb.ac.id/', 'UNPAD' => 'https://fmipa.unpad.ac.id/'],
                    'Manajemen Keuangan' => ['UI' => 'https://feb.ui.ac.id/', 'UGM' => 'https://feb.ugm.ac.id/', 'ITB' => 'https://sbm.itb.ac.id/'],
                    'Arsiparis' => ['UGM' => 'https://vokasi.ugm.ac.id/', 'UI' => 'https://vokasi.ui.ac.id/', 'UNDIP' => 'https://vokasi.undip.ac.id/', 'UNPAD' => 'https://fikom.unpad.ac.id/', 'UNAIR' => 'https://vokasi.unair.ac.id/']
                ]
            ],
        ];
    }

    private function getHardcodedQuestions()
    {
        return [
            (object)['id' => 1, 'category_id' => 1, 'question_text' => 'Saya suka memperbaiki alat elektronik atau mesin yang rusak.'],
            (object)['id' => 2, 'category_id' => 1, 'question_text' => 'Saya suka kegiatan outdoor seperti berkemah atau mendaki.'],
            (object)['id' => 3, 'category_id' => 1, 'question_text' => 'Saya lebih suka pelajaran praktik daripada teori di kelas.'],
            (object)['id' => 4, 'category_id' => 1, 'question_text' => 'Saya tertarik merakit komputer atau robotik.'],
            (object)['id' => 5, 'category_id' => 1, 'question_text' => 'Saya suka bekerja dengan tangan saya (membuat kerajinan, menanam, dll).'],
            
            (object)['id' => 6, 'category_id' => 2, 'question_text' => 'Saya suka memecahkan teka-teki logika atau matematika.'],
            (object)['id' => 7, 'category_id' => 2, 'question_text' => 'Saya sering penasaran bagaimana alam semesta bekerja.'],
            (object)['id' => 8, 'category_id' => 2, 'question_text' => 'Saya suka membaca buku ilmiah atau artikel penelitian.'],
            (object)['id' => 9, 'category_id' => 2, 'question_text' => 'Saya lebih suka bekerja sendiri untuk menganalisa masalah.'],
            (object)['id' => 10, 'category_id' => 2, 'question_text' => 'Saya teliti dalam melihat detail angka atau data.'],

            (object)['id' => 11, 'category_id' => 3, 'question_text' => 'Saya suka menggambar, melukis, atau mendesain sesuatu.'],
            (object)['id' => 12, 'category_id' => 3, 'question_text' => 'Saya bisa memainkan alat musik atau bernyanyi.'],
            (object)['id' => 13, 'category_id' => 3, 'question_text' => 'Saya suka menulis puisi, cerpen, atau skenario.'],
            (object)['id' => 14, 'category_id' => 3, 'question_text' => 'Saya sangat memperhatikan estetika (keindahan) suatu benda.'],
            (object)['id' => 15, 'category_id' => 3, 'question_text' => 'Saya tidak suka rutinitas yang monoton dan berulang-ulang.'],

            (object)['id' => 16, 'category_id' => 4, 'question_text' => 'Saya mudah bergaul dan memulai percakapan dengan orang baru.'],
            (object)['id' => 17, 'category_id' => 4, 'question_text' => 'Saya suka mengajari teman yang belum paham pelajaran.'],
            (object)['id' => 18, 'category_id' => 4, 'question_text' => 'Saya sering menjadi tempat curhat teman-teman.'],
            (object)['id' => 19, 'category_id' => 4, 'question_text' => 'Saya tertarik dengan kegiatan sosial atau sukarelawan.'],
            (object)['id' => 20, 'category_id' => 4, 'question_text' => 'Saya lebih suka bekerja dalam tim daripada sendirian.'],

            (object)['id' => 21, 'category_id' => 5, 'question_text' => 'Saya suka memimpin kelompok atau menjadi ketua organisasi.'],
            (object)['id' => 22, 'category_id' => 5, 'question_text' => 'Saya tertarik untuk memulai bisnis sendiri suatu hari nanti.'],
            (object)['id' => 23, 'category_id' => 5, 'question_text' => 'Saya berani mengambil risiko untuk mendapatkan keuntungan.'],
            (object)['id' => 24, 'category_id' => 5, 'question_text' => 'Saya pandai meyakinkan orang lain (negosiasi).'],
            (object)['id' => 25, 'category_id' => 5, 'question_text' => 'Saya suka berkompetisi dan menjadi juara.'],

            (object)['id' => 26, 'category_id' => 6, 'question_text' => 'Saya suka segala sesuatu yang teratur dan rapi.'],
            (object)['id' => 27, 'category_id' => 6, 'question_text' => 'Saya teliti dalam menghitung uang atau anggaran.'],
            (object)['id' => 28, 'category_id' => 6, 'question_text' => 'Saya suka membuat daftar (to-do list) dan jadwal harian.'],
            (object)['id' => 29, 'category_id' => 6, 'question_text' => 'Saya taat pada aturan dan prosedur yang berlaku.'],
            (object)['id' => 30, 'category_id' => 6, 'question_text' => 'Saya suka mengelola data atau dokumen (filling).'],
        ];
    }
}