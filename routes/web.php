<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\RakController;
use App\Http\Controllers\DDCController;
use App\Http\Controllers\FormatController;
use App\Http\Controllers\PenerbitController;
use App\Http\Controllers\PengarangController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

require __DIR__.'/auth.php';

Auth::routes();

/*------------------------------------------
--------------------------------------------
All Normal Users Routes List
--------------------------------------------
--------------------------------------------*/
Route::middleware(['auth', 'user-access:user'])->group(function () {
  
    Route::get('/home', [HomeController::class, 'index'])->name('home');
});
  
/*------------------------------------------
--------------------------------------------
All Admin Routes List
--------------------------------------------
--------------------------------------------*/
Route::middleware(['auth', 'user-access:admin'])->group(function () {
  
    Route::get('/admin/home', [HomeController::class, 'adminHome'])->name('admin.home');

    Route::prefix('admin')->group(function () {
        Route::resource('rak', RakController::class)->names([
            'index' => 'admin.rak.index',
            'create' => 'admin.rak.create',
            'store' => 'admin.rak.store',
            'edit' => 'admin.rak.edit',
            'update' => 'admin.rak.update',
            'destroy' => 'admin.rak.destroy'
        ]);
    });

    Route::prefix('admin')->group(function () {
        Route::resource('ddc', DDCController::class)->names([
            'index' => 'admin.ddc.index',
            'create' => 'admin.ddc.create',
            'store' => 'admin.ddc.store',
            'edit' => 'admin.ddc.edit',
            'update' => 'admin.ddc.update',
            'destroy' => 'admin.ddc.destroy'
        ]);
    });

    Route::prefix('admin')->group(function () {
        Route::resource('format', FormatController::class)->names([
            'index' => 'admin.format.index',
            'create' => 'admin.format.create',
            'store' => 'admin.format.store',
            'edit' => 'admin.format.edit',
            'update' => 'admin.format.update',
            'destroy' => 'admin.format.destroy'
        ]);
    });

    Route::prefix('admin')->group(function () {
        // ... route lainnya
        Route::resource('penerbit', PenerbitController::class)->names([
            'index' => 'admin.penerbit.index',
            'create' => 'admin.penerbit.create',
            'store' => 'admin.penerbit.store',
            'edit' => 'admin.penerbit.edit',
            'update' => 'admin.penerbit.update',
            'destroy' => 'admin.penerbit.destroy'
        ]);
    });

    Route::prefix('admin')->group(function () {
        // ... route lainnya
        Route::resource('pengarang', PengarangController::class)->names([
            'index' => 'admin.pengarang.index',
            'create' => 'admin.pengarang.create',
            'store' => 'admin.pengarang.store',
            'edit' => 'admin.pengarang.edit',
            'update' => 'admin.pengarang.update',
            'destroy' => 'admin.pengarang.destroy'
        ]);
    });

    // Admin Profile Routes
    Route::prefix('admin/profile')->group(function () {
        Route::get('/', [AdminController::class, 'profileAdmin'])->name('profile.edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('profile.destroy');
        Route::post('/', [ProfileController::class, 'store'])->name('admin.profile.store');
    });
});

