<?php

namespace App\Http\Controllers;

use App\Models\peminjaman;
use Illuminate\Http\Request;

use App\Models\Siswa;
use App\Models\Buku;
use App\Models\User;

class PeminjamanController extends Controller
{
    public function index()
    {
        // Paginate to 25 rows — never loads the entire table into memory
        $peminjaman = peminjaman::with(['siswa', 'buku', 'user'])->paginate(25);

        // Use app timezone so date is accurate regardless of server UTC offset
        $today = \Carbon\Carbon::now(config('app.timezone'))->toDateString();

        $dendaPerHari = (int) (\App\Models\Setting::where('key', 'denda_per_hari')->value('value') ?? 1000);

        // Count currently overdue (active loans past deadline)
        $overdueRecords = peminjaman::whereIn('status', ['dipinjam', 'sebagian dikembalikan'])
            ->whereNotNull('tanggal_kembali')
            ->where('tanggal_kembali', '<', $today)
            ->get(['tanggal_kembali', 'jumlah_buku', 'denda_lunas']);

        $totalSiswaTerlambat = $overdueRecords->count();

        // Total denda AKUMULATIF:
        // Komponen 1 — denda aktif (terlambat, belum dibayar, masih dipinjam)
        $dendaAktif = $overdueRecords->where('denda_lunas', false)
            ->sum(function ($p) use ($dendaPerHari, $today) {
                $hariTelat = (int) \Carbon\Carbon::parse($p->tanggal_kembali)->diffInDays($today);
                return $hariTelat * $dendaPerHari * ($p->jumlah_buku ?? 1);
            });

        // Komponen 2 — denda yang sudah lunas/dibayar (buku sudah dikembalikan setelah terlambat)
        // Ini adalah denda yang pernah ada dan sudah diselesaikan — nilainya dihitung saat deadline
        $dendaLunas = peminjaman::where('denda_lunas', true)
            ->whereNotNull('tanggal_kembali')
            ->where('tanggal_kembali', '<', $today)
            ->get(['tanggal_kembali', 'jumlah_buku', 'updated_at'])
            ->sum(function ($p) use ($dendaPerHari) {
                $bayarDate = $p->updated_at
                    ? \Carbon\Carbon::parse($p->updated_at)->startOfDay()
                    : \Carbon\Carbon::now(config('app.timezone'))->startOfDay();
                $deadline = \Carbon\Carbon::parse($p->tanggal_kembali)->startOfDay();
                
                if ($bayarDate->lte($deadline)) {
                    return 0;
                }
                
                $hariTelat = (int) $bayarDate->diffInDays($deadline);
                return $hariTelat * $dendaPerHari * ($p->jumlah_buku ?? 1);
            });

        $totalDenda = $dendaAktif + $dendaLunas;

        return view('peminjamans.index', compact('peminjaman', 'totalSiswaTerlambat', 'totalDenda'));
    }

    public function add()
    {
        $siswas = Siswa::all();
        $bukus = Buku::all();
        $users = User::all();
        return view('peminjamans.add', compact('siswas', 'bukus', 'users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'siswa_id' => 'required',
            'buku_id' => 'required',
            'jumlah_buku' => 'required|integer|min:1',
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali' => 'nullable|date',
            'status' => 'required',
        ]);

        $data = $request->all();
        $data['user_id'] = auth()->id() ?? 1;

        peminjaman::create($data);

        return redirect()->route('peminjamans.index')->with('success', 'Data peminjaman berhasil ditambahkan');
    }

    public function edit($id)
    {
        $peminjaman = peminjaman::findOrFail($id);
        $siswas = Siswa::all();
        $bukus = Buku::all();
        $users = User::all();
        return view('peminjamans.edit', compact('peminjaman', 'siswas', 'bukus', 'users'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'siswa_id' => 'required',
            'buku_id' => 'required',
            'jumlah_buku' => 'required|integer|min:1',
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali' => 'nullable|date',
            'status' => 'required',
        ]);

        $peminjaman = peminjaman::findOrFail($id);
        
        $data = $request->all();
        $data['user_id'] = auth()->id() ?? 1;
        $peminjaman->update($data);

        return redirect()->route('peminjamans.index')->with('success', 'Data peminjaman berhasil diperbarui');
    }

public function bayarDenda($id)
{
    $peminjaman = Peminjaman::findOrFail($id);
    // Tandai denda lunas DAN ubah status menjadi dikembalikan
    $peminjaman->update([
        'denda_lunas' => true,
        'status'      => 'dikembalikan',
    ]);

    return redirect()->route('peminjamans.index')
                     ->with('status', 'Denda berhasil dibayar dan buku telah dikembalikan.');
}
    public function delete($id)
    {
        $peminjaman = peminjaman::findOrFail($id);
        $peminjaman->delete();

        return redirect()->route('peminjamans.index')->with('success', 'Data peminjaman berhasil dihapus');
    }
}