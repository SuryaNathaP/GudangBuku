<?php

use App\Http\Controllers\Settings;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\RegistrationController;

Route::get('/', function () {
    return view('welcome');
})->middleware('guest')->name('login');

Route::get('dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/general', [\App\Http\Controllers\SettingController::class, 'index'])->name('settings.index');
    Route::post('settings/general', [\App\Http\Controllers\SettingController::class, 'update'])->name('settings.update');

    Route::get('settings/profile', [Settings\ProfileController::class, 'edit'])->name('settings.profile.edit');
    Route::put('settings/profile', [Settings\ProfileController::class, 'update'])->name('settings.profile.update');
    Route::delete('settings/profile', [Settings\ProfileController::class, 'destroy'])->name('settings.profile.destroy');
    Route::get('settings/password', [Settings\PasswordController::class, 'edit'])->name('settings.password.edit');
    Route::put('settings/password', [Settings\PasswordController::class, 'update'])->name('settings.password.update');
    Route::get('settings/appearance', [Settings\AppearanceController::class, 'edit'])->name('settings.appearance.edit');
    Route::get('siswas', [SiswaController::class, 'index'])->name('siswas.index');
    Route::get('siswas/add', [SiswaController::class, 'add'])->name('siswas.add');
    Route::post('siswas/add', [SiswaController::class, 'store'])->name('siswas.store');
    Route::get('siswas/edit/{id}', [SiswaController::class, 'edit'])->name('siswas.edit');
    Route::post('siswas/edit/{id}', [SiswaController::class, 'update'])->name('siswas.update');
    Route::post('siswas/delete/{id}', [SiswaController::class, 'delete'])->name('siswas.delete');

    Route::get('bukus', [BukuController::class, 'index'])->name('bukus.index');
    Route::get('bukus/add', [BukuController::class, 'add'])->name('bukus.add');
    Route::post('bukus/add', [BukuController::class, 'store'])->name('bukus.store');
    Route::get('bukus/edit/{id}', [BukuController::class, 'edit'])->name('bukus.edit');
    Route::post('bukus/edit/{id}', [BukuController::class, 'update'])->name('bukus.update');
    Route::post('bukus/delete/{id}', [BukuController::class, 'delete'])->name('bukus.delete');

    Route::get('kategoris', [KategoriController::class, 'index'])->name('kategoris.index');
    Route::get('kategoris/add', [KategoriController::class, 'add'])->name('kategoris.add');
    Route::post('kategoris/add', [KategoriController::class, 'store'])->name('kategoris.store');
    Route::get('kategoris/edit/{id}', [KategoriController::class, 'edit'])->name('kategoris.edit');
    Route::post('kategoris/edit/{id}', [KategoriController::class, 'update'])->name('kategoris.update');
    Route::post('kategoris/delete/{id}', [KategoriController::class, 'delete'])->name('kategoris.delete');

    Route::get('peminjamans', [PeminjamanController::class, 'index'])->name('peminjamans.index');
    Route::get('peminjamans/add', [PeminjamanController::class, 'add'])->name('peminjamans.add');
    Route::post('peminjamans/add', [PeminjamanController::class, 'store'])->name('peminjamans.store');
    Route::get('peminjamans/edit/{id}', [PeminjamanController::class, 'edit'])->name('peminjamans.edit');
    Route::post('peminjamans/edit/{id}', [PeminjamanController::class, 'update'])->name('peminjamans.update');
    Route::post('peminjamans/delete/{id}', [PeminjamanController::class, 'delete'])->name('peminjamans.delete');
    Route::patch('peminjamans/{id}/bayar-denda', [PeminjamanController::class, 'bayarDenda'])->name('peminjamans.bayarDenda');

    Route::get('users', [UserController::class, 'index'])->name('users.index');
    Route::get('users/add', [UserController::class, 'add'])->name('users.add');
    Route::post('users/add', [UserController::class, 'store'])->name('users.store');
    Route::get('users/edit/{id}', [UserController::class, 'edit'])->name('users.edit');
    Route::post('users/edit/{id}', [UserController::class, 'update'])->name('users.update');
    Route::post('users/delete/{id}', [UserController::class, 'delete'])->name('users.delete');

    Route::get('register', [RegistrationController::class, 'create'])->name('register');
    Route::post('register', [RegistrationController::class, 'store']);
});


require __DIR__ . '/auth.php';
