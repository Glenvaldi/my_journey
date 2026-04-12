<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\TestResult;
use App\Models\Category; // <--- WAJIB IMPORT INI

class AdminController extends Controller
{
    public function index()
    {
        $users = User::where('is_admin', false)
                    ->withCount('testResults')
                    ->latest()
                    ->paginate(10);
        return view('admin.index', compact('users'));
    }

    public function userHistory($userId)
    {
        $user = User::findOrFail($userId);
        $histories = TestResult::where('user_id', $userId)
                        ->orderBy('created_at', 'desc')
                        ->get();
        return view('admin.user_history', compact('user', 'histories'));
    }

    // --- FUNGSI BARU UNTUK MENGATASI 404 ---
    public function show($id)
    {
        // Ambil data langsung berdasarkan ID (Admin bebas akses)
        $history = TestResult::findOrFail($id);

        // Ambil data kategori
        $result = Category::where('code', $history->result_code)->first();

        // Siapkan data grafik
        $categories = Category::all();
        $chartLabels = $categories->pluck('name')->toArray();
        $savedScores = $history->scores ?? []; 
        $chartData = [];

        foreach($categories as $cat) {
            $chartData[] = $savedScores[$cat->id] ?? 0; 
        }

        // Tampilkan ke view 'result' tapi kasih tanda kalau ini ADMIN yang lihat
        return view('result', [
            'result' => $result,
            'chartLabels' => $chartLabels,
            'chartData' => $chartData,
            'isHistory' => true,
            'isAdminView' => true, // <--- KUNCI PENTING AGAR TOMBOL KEMBALI BENAR
            'historyData' => $history
        ]);
    }
}