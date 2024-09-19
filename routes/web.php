<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\SertifikatController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SkillController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin')->group(function () {
    //About
    Route::prefix('abouts')->name('admin.abouts.')->group(function () {
        Route::get('/', [AboutController::class, 'index'])->name('index');
        Route::get('/create', [AboutController::class, 'create'])->name('create');
        Route::post('/', [AboutController::class, 'store'])->name('store');
        Route::get('/{about}/edit', [AboutController::class, 'edit'])->name('edit');
        Route::put('/{about}', [AboutController::class, 'update'])->name('update');
        Route::delete('/{about}', [AboutController::class, 'destroy'])->name('destroy');
    });

    //Sertifikat
    Route::prefix('sertifikat')->name('admin.sertifikat.')->group(function () {
        Route::get('/', [SertifikatController::class, 'index'])->name('index');
        Route::get('/create', [SertifikatController::class, 'create'])->name('create');
        Route::post('/', [SertifikatController::class, 'store'])->name('store');
        Route::get('/{sertifikat}/edit', [SertifikatController::class, 'edit'])->name('edit');
        Route::put('/{sertifikat}', [SertifikatController::class, 'update'])->name('update');
        Route::delete('/{sertifikat}', [SertifikatController::class, 'destroy'])->name('destroy');
    });

    //Contact
    Route::prefix('contacts')->name('admin.contacts.')->group(function () {
        Route::get('/', [ContactController::class, 'index'])->name('index');
        Route::get('/create', [ContactController::class, 'create'])->name('create');
        Route::post('/', [ContactController::class, 'store'])->name('store');
        Route::get('/{contact}/edit', [ContactController::class, 'edit'])->name('edit');
        Route::put('/{contact}', [ContactController::class, 'update'])->name('update');
        Route::delete('/{contact}', [ContactController::class, 'destroy'])->name('destroy');
    });

    //Project
    Route::prefix('projects')->name('admin.projects.')->group(function () {
        Route::get('/', [ProjectController::class, 'index'])->name('index');
        Route::get('/create', [ProjectController::class, 'create'])->name('create');
        Route::post('/', [ProjectController::class, 'store'])->name('store');
        Route::get('/{project}/edit', [ProjectController::class, 'edit'])->name('edit');
        Route::put('/{project}', [ProjectController::class, 'update'])->name('update');
        Route::delete('/{project}', [ProjectController::class, 'destroy'])->name('destroy');
    });

    //Skill
    Route::prefix('skills')->name('admin.skills.')->group(function () {
        Route::get('/', [SkillController::class, 'index'])->name('index');
        Route::get('/create', [SkillController::class, 'create'])->name('create');
        Route::post('/', [SkillController::class, 'store'])->name('store');
        Route::get('/{skill}/edit', [SkillController::class, 'edit'])->name('edit');
        Route::put('/{skill}', [SkillController::class, 'update'])->name('update');
        Route::delete('/{skill}', [SkillController::class, 'destroy'])->name('destroy');
    });
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
