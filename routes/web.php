<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\frontendController;
use App\Http\Controllers\KokiController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/dashboard', function () {
//     return view('./dashboard/index');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::get('/dashboard', function () {
//     return view('./dashboard/index');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard', [PemesananController::class, 'Statistics'])->middleware(['auth', 'verified'])->name('dashboard');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('add-to-cart/{id}', [frontendController::class, 'addToCart'])->name('add_to_cart');
Route::get('cart', [frontendController::class, 'cart'])->name('cart');




Route::resource('/dashboard/categories', CategoryController::class)->middleware('auth');
Route::get('/', [frontendController::class, 'index']);

Route::post('/session', [frontendController::class, 'session'])->name('session');


Route::get('/dashboard/menus/checkSlug', [MenuController::class, 'checkSlug'])->middleware('auth');
Route::resource('/dashboard/menus', MenuController::class)->middleware('auth');

Route::get('/dashboard/cetakNota',[PemesananController::class, 'cetakNota'])->middleware('auth');
Route::get('/dashboard/cetakNota',[PemesananController::class, 'cetakNota'])->middleware('auth');
Route::get('/dashboard/pemesanan',[PemesananController::class, 'index'])->middleware('auth');


Route::post('prossesPesanan/{id}',[KokiController::class, 'prosses'])->name('prosses')->middleware('auth');
Route::delete('deletePesanan/{id}',[PemesananController::class, 'destroy'])->name('deletePesanan')->middleware('auth');

Route::post('pemesananSelesai/{id}',[PemesananController::class, 'pemesananSelesai'])->name('pemesananSelesai')->middleware('auth');
Route::get('invoice/{id}',[PemesananController::class, 'cetakInvoice'])->name('invoice')->middleware('auth');
Route::patch('update-cart', [frontendController::class, 'update'])->name('update_cart');
Route::delete('remove-from-cart', [frontendController::class, 'remove'])->name('remove_from_cart');
Route::get('/dashboard/pesananMasuk',[PemesananController::class, 'pesananMasuk'])->middleware('auth');

Route::get('signOut',[AuthenticatedSessionController::class, 'destroy'])->name('signOut');


require __DIR__.'/auth.php';
