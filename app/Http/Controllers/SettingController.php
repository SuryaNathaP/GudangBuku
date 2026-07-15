<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;

class SettingController extends Controller
{
    public function index()
    {
        $dendaPerHari = Setting::where('key', 'denda_per_hari')->value('value') ?? 1000;

        return view('settings.index', compact('dendaPerHari'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'denda_per_hari' => 'required|numeric|min:0',
        ]);

        Setting::updateOrCreate(
            ['key' => 'denda_per_hari'],
            ['value' => $request->denda_per_hari]
        );

        return redirect()->route('settings.index')->with('success', 'Pengaturan berhasil diperbarui!');
    }
}
