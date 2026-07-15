<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Buku;
use App\Models\peminjaman;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class DashboardController extends Controller
{
    public function index()
    {
        // Cache the activity feed for 5 minutes — avoids 4 DB queries on every visit
        $allActivities = Cache::remember('dashboard_activities_all', 300, function () {
            // Ambil 30 peminjaman terbaru (status dipinjam = baru dipinjam)
            $peminjamanBaru = peminjaman::with(['siswa', 'buku'])
                ->where('status', 'dipinjam')
                ->latest()
                ->take(30)
                ->get()
                ->map(function ($p) {
                    return [
                        'type'  => 'pinjam',
                        'color' => 'blue',
                        'icon'  => 'bi-book',
                        'text'  => ($p->siswa->nama ?? 'Siswa') . ' meminjam',
                        'bold'  => $p->buku->judul ?? 'buku',
                        'time'  => $p->created_at,
                    ];
                });

            // Ambil 10 pengembalian terbaru
            $pengembalian = peminjaman::with(['siswa', 'buku'])
                ->where('status', 'dikembalikan')
                ->latest()
                ->take(30)
                ->get()
                ->map(function ($p) {
                    return [
                        'type'  => 'kembali',
                        'color' => 'orange',
                        'icon'  => 'bi-arrow-return-left',
                        'text'  => ($p->siswa->nama ?? 'Siswa') . ' mengembalikan',
                        'bold'  => $p->buku->judul ?? 'buku',
                        'time'  => $p->updated_at,
                    ];
                });

            // Ambil 30 siswa terbaru terdaftar
            $siswaBaru = Siswa::latest()->take(30)->get()
                ->map(function ($s) {
                    return [
                        'type'  => 'siswa',
                        'color' => 'blue',
                        'icon'  => 'bi-person-plus',
                        'text'  => 'Siswa baru terdaftar:',
                        'bold'  => $s->nama,
                        'time'  => $s->created_at,
                    ];
                });

            // Ambil 30 buku terbaru ditambahkan
            $bukuBaru = Buku::latest()->take(30)->get()
                ->map(function ($b) {
                    return [
                        'type'  => 'buku',
                        'color' => 'green',
                        'icon'  => 'bi-plus-circle',
                        'text'  => 'Buku baru ditambahkan:',
                        'bold'  => $b->judul,
                        'time'  => $b->created_at,
                    ];
                });

            // Gabung semua, urutkan dari terbaru
            return $peminjamanBaru
                ->merge($pengembalian)
                ->merge($siswaBaru)
                ->merge($bukuBaru)
                ->sortByDesc('time')
                ->values();
        });

        // Ambil 10 untuk tampilan utama
        $activities = $allActivities->take(10);

        return view('dashboard', compact('activities', 'allActivities'));
    }
}
