<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Akuns1Controller;
use App\Http\Controllers\Akuns2Controller;
use App\Http\Controllers\Akuns3Controller;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\JurnalMemorialController;
use App\Http\Controllers\BukubesarController;
use App\Http\Controllers\NeracasaldoController;
use App\Http\Controllers\KlienController;


// routes/web.php

// Show login form and Process login
Route::middleware(['guest'])->group(function(){
    Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.post');
});


// Redirect to dashboard after login
Route::get('/home', function () {
    return redirect('/dashboard');
});

Route::middleware(['auth'])->group(function(){
    // Dashboard
    Route::get('/dashboard', function () {
        $user = auth()->user();

        if ($user->role_id === 1) {
            return redirect()->route('dashboard.admin');
        } elseif ($user->role_id === 2) {
            return redirect()->route('dashboard.manajer');
        } else {
            // Logika jika pengguna memiliki peran lain atau tidak memiliki peran tertentu
            return redirect()->route('dashboard.user');
        }
    })->name('dashboard');

    // Admin Dashboard
    Route::get('/dashboard/admin', [DashboardController::class, 'admin'])
        ->middleware('userAkses:1')
        ->name('dashboard.admin');

    // Manajer Dashboard
    Route::get('/dashboard/manajer', [DashboardController::class, 'manajer'])
        ->middleware('userAkses:2')
        ->name('dashboard.manajer');

    // Logout
    Route::get('/logout', [LoginController::class, 'logout']);
});


Route::get('/akuns1', [Akuns1Controller::class, 'index'])->name('akuns1.index');
Route::get('/akuns1/create', [Akuns1Controller::class, 'create'])->name('akuns1.create');
Route::post('/akuns1', [Akuns1Controller::class, 'store'])->name('akuns1.store');
Route::get('/akuns1/{id}', [Akuns1Controller::class, 'show'])->name('akuns1.show');
Route::get('/akuns1/{id}/edit', [Akuns1Controller::class, 'edit'])->name('akuns1.edit');
Route::put('/akuns1/{id}', [Akuns1Controller::class, 'update'])->name('akuns1.update');
Route::delete('/akuns1/{id}', [Akuns1Controller::class, 'destroy'])->name('akuns1.destroy');



Route::get('/akuns2', [Akuns2Controller::class, 'index'])->name('akuns2.index');
Route::get('/akuns2/create', [Akuns2Controller::class, 'create'])->name('akuns2.create');
Route::post('/akuns2', [Akuns2Controller::class, 'store'])->name('akuns2.store');
Route::get('/akuns2/{id}', [Akuns2Controller::class, 'show'])->name('akuns2.show');
Route::get('/akuns2/{id}/edit', [Akuns2Controller::class, 'edit'])->name('akuns2.edit');
Route::put('/akuns2/{id}', [Akuns2Controller::class, 'update'])->name('akuns2.update');
Route::delete('/akuns2/{id}', [Akuns2Controller::class, 'destroy'])->name('akuns2.destroy');



Route::get('/akuns3', [Akuns3Controller::class, 'index'])->name('akuns3.index');
Route::get('/akuns3/create', [Akuns3Controller::class, 'create'])->name('akuns3.create');
Route::post('/akuns3', [Akuns3Controller::class, 'store'])->name('akuns3.store');
Route::get('/akuns3/{akun3}/edit', [Akuns3Controller::class, 'edit'])->name('akuns3.edit');
Route::put('/akuns3/{akun3}', [Akuns3Controller::class, 'update'])->name('akuns3.update');
Route::delete('/akuns3/{akun3}', [Akuns3Controller::class, 'destroy'])->name('akuns3.destroy');


Route::get('/transaksi', [TransaksiController::class, 'index'])->name('transaksi.index');
Route::get('/transaksi/create', [TransaksiController::class, 'create'])->name('transaksi.create');
Route::post('/transaksi', [TransaksiController::class, 'store'])->name('transaksi.store');
Route::get('/transaksi/{id}', [TransaksiController::class, 'show'])->name('transaksi.show');
Route::get('/transaksi/{id}/edit', [TransaksiController::class, 'edit'])->name('transaksi.edit');
Route::put('/transaksi/{id}', [TransaksiController::class, 'update'])->name('transaksi.update');
Route::delete('/transaksi/{id}', [TransaksiController::class, 'destroy'])->name('transaksi.destroy');
Route::get('/transaksi/{id}/vouchercetak', [TransaksiController::class, 'vouchercetak'])->name('transaksi.vouchercetak');


Route::get('/jurnalmemorial', [JurnalMemorialController::class, 'index'])->name('jurnalmemorial.index');
Route::get('/jurnalmemorial/cetak', [JurnalMemorialController::class, 'cetak'])->name('jurnalmemorial.cetak');

Route::get('/bukubesar', [BukubesarController::class, 'index'])->name('bukubesar.index');
Route::get('/bukubesar/cetak', [BukubesarController::class, 'cetak'])->name('bukubesar.cetakbukubesar');

Route::get('/neracasaldo', [NeracasaldoController::class, 'index'])->name('neracasaldo.index');

Route::get('/kliens', [KlienController::class, 'index'])->name('kliens.index');
Route::get('/kliens/create', [KlienController::class, 'create'])->name('kliens.create');
Route::post('/kliens', [KlienController::class, 'store'])->name('kliens.store');
Route::get('/kliens/{klien}/edit', [KlienController::class, 'edit'])->name('kliens.edit');
Route::put('/kliens/{klien}', [KlienController::class, 'update'])->name('kliens.update');
Route::delete('/kliens/{klien}', [KlienController::class, 'destroy'])->name('kliens.destroy');
