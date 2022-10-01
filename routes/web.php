<?php

use App\Http\Controllers\AccessController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\VehiculeController;

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
Route::get('login-admin', [AdminController::class, 'create'])->name('admin.login');

Route::get('/', [AccessController::class, 'showLoginForm']);

Route::post('admin-login', [AdminController::class, 'store'])->name('admin');

Route::get('/accueil-chauffeur', [AccessController::class, 'home'])->middleware(['auth'])->name('accueil');

Route::get('/accueil-admin', [AdminController::class, 'home'])->middleware(['admin'])->name('admin.accueil');

Route::middleware('admin')->group(function () {

    Route::get('page-parametre', [AdminController::class, 'showPageParametre'])->name('admin.parametre');

    Route::get('page-vehicule', [AdminController::class, 'showPageVehicule'])->name('admin.vehicule');

    Route::get('page-statistique', [AdminController::class, 'showPageStatistique'])->name('admin.statistique');

    Route::get('page-versement', [AdminController::class, 'showPageVersement'])->name('admin.versement');

    Route::get('page-ajout-vehicule', [AdminController::class, 'showPageAjoutVehicule'])->name('admin.ajoutVehicule');

    Route::get('page-modif-parametre-{id}', [AdminController::class, 'showPageModifParametre'])->name('admin.modifParametre');

    Route::post('ajout-vehicule', [AdminController::class, 'ajoutVehicule'])->name('admin.addVehicule');

    Route::post('modif-parametre', [AdminController::class, 'modifierParametre'])->name('admin.modification');

    Route::get('logout-admin', [AdminController::class, 'destroy'])->name('admin.logout');

});

require __DIR__.'/auth.php';

