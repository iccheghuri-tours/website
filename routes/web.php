<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoyaltiController;
use App\Http\Controllers\PointDealController;
use App\Http\Controllers\RegularDealController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\Fortify\Features;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canRegister' => Features::enabled(Features::registration()),
    ]);
})->name('home');

Route::get('dashboard', function () {
    // return Inertia::render('Dashboard');
    return redirect()->route('profile.edit');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/settings.php';


Route::get('/points/{slug}', [LoyaltiController::class, 'index']);
Route::prefix('/admin')->middleware(['auth', AdminMiddleware::class])->name('admin.')->group(function (){
    Route::get('/', [AdminController::class, 'index']);
    Route::get('/mail', [AdminController::class, 'mail']);
    Route::post('/mail', [AdminController::class, 'sendMail']);
    Route::resource('/users',UserController::class);
    Route::resource('/partners',RegularDealController::class);
    Route::resource('/offers',PointDealController::class);
});
