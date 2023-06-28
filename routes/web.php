<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Guest\GuestController;
use App\Http\Controllers\Admin\TypeController;

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

/************************** 
        G U E S T 
**************************/

// home
Route::get( '/', function () {
    return view('guest.index');
})->name('home');

// about
Route::get( '/about', function () {
    return view('guest.about');
})->name('about');

// work
Route::resource( 'guest', GuestController::class )->only([
    'index', 
    'show'
]);


/************************** 
        A D M I N 
**************************/
// MIDDLEWARE: metodo che consente l'accesso solo agli utenti loggati
Route::middleware([ 'auth', 'verified' ])->prefix('admin')->group(function () {
    Route::get( '/profile', [ProfileController::class, 'edit'] )->name('profile.edit');
    Route::patch( '/profile', [ProfileController::class, 'update'] )->name('profile.update');
    Route::delete( '/profile', [ProfileController::class, 'destroy'] )->name('profile.destroy');

    Route::get( '/', [DashboardController::class, 'index'] )->name('admin.dashboard');

    // per far in modo che l'elemento venga passsato alla funzione di controller deve combaciare con il nome della route definita nel file web
    Route::resource( '/projects', ProjectController::class)->parameters([
        'projects' => 'project:slug'
    ]);

    Route::resource( '/types', TypeController::class )->parameters([
        'types' => 'type:slug'
    ]);
});

require __DIR__.'/auth.php';