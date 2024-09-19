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
    Route::get('/abouts', [AboutController::class, 'index'])->middleware(['auth', 'admin'])->name('admin.abouts.index');
    Route::get('/abouts/create', [AboutController::class, 'create'])->middleware(['auth', 'admin'])->name('admin.abouts.create');
    Route::post('/abouts', [AboutController::class, 'store'])->middleware(['auth', 'admin'])->name('adminabouts.store');
    Route::get('/abouts/{about}/edit', [AboutController::class, 'edit'])->middleware(['auth', 'admin'])->name('admin.abouts.edit');
    Route::put('/abouts/{about}', [AboutController::class, 'update'])->middleware(['auth', 'admin'])->name('admin.bouts.update');
    Route::delete('/abouts/{about}', [AboutController::class, 'destroy'])->middleware(['auth', 'admin'])->name('admin.abouts.destroy');

    //Sertifikat
    Route::get('/sertifikat', [SertifikatController::class, 'index'])->middleware(['auth', 'admin'])->name('admin.sertifikat');
    Route::get('/sertifikat/create', [SertifikatController::class, 'create'])->middleware(['auth', 'admin'])->name('admin.sertifikat.create');
    Route::post('/sertifikat', [SertifikatController::class, 'store'])->name('admin.sertifikat.store');
    Route::get('/sertifikat/{id}/edit', [SertifikatController::class, 'edit'])->middleware(['auth', 'admin'])->name('admin.sertifikat.edit');
    Route::put('/sertifikat/{id}', [SertifikatController::class, 'update'])->middleware(['auth', 'admin'])->name('admin.sertifikat.update');
    Route::delete('/sertifikat/{id}', [SertifikatController::class, 'destroy'])->middleware(['auth', 'admin'])->name('admin.sertifikat.destroy');

    //Contact
    Route::get('/contacts', [ContactController::class, 'index'])->middleware(['auth', 'admin'])->name('admin.contacts.index');
    Route::get('/contacts/create', [ContactController::class, 'create'])->middleware(['auth', 'admin'])->name('admin.contacts.create');
    Route::post('/contacts', [ContactController::class, 'store'])->middleware(['auth', 'admin'])->name('admin.contacts.store');
    Route::get('/contacts/{id}/edit', [ContactController::class, 'edit'])->middleware(['auth', 'admin'])->name('admin.contacts.edit');
    Route::put('/contacts/{id}', [ContactController::class, 'update'])->middleware(['auth', 'admin'])->name('admin.contacts.update');
    Route::delete('/contacts/{id}', [ContactController::class, 'destroy'])->middleware(['auth', 'admin'])->name('admin.contacts.destroy');

    //Project
    Route::get('/projects', [ProjectController::class, 'index'])->middleware(['auth', 'admin'])->name('admin.projects.index');
    Route::get('/projects/create', [ProjectController::class, 'create'])->middleware(['auth', 'admin'])->name('admin.projects.create');
    Route::post('/projects', [ProjectController::class, 'store'])->middleware(['auth', 'admin'])->name('admin.projects.store');
    Route::get('/projects/{project}/edit', [ProjectController::class, 'edit'])->middleware(['auth', 'admin'])->name('admin.projects.edit');
    Route::put('/projects/{project}', [ProjectController::class, 'update'])->middleware(['auth', 'admin'])->name('admin.projects.update');
    Route::delete('/projects/{project}', [ProjectController::class, 'destroy'])->middleware(['auth', 'admin'])->name('admin.projects.destroy');

    //Skill
    Route::get('/skill', [SkillController::class, 'index'])->middleware(['auth', 'admin'])->name('admin.skill');
    Route::get('/skill/create', [SkillController::class, 'create'])->middleware(['auth', 'admin'])->name('admin.skill.create');
    Route::post('/skill', [SkillController::class, 'store'])->middleware(['auth', 'admin'])->name('admin.skill.store');
    Route::get('/skill/{skill}/edit', [SkillController::class, 'edit'])->middleware(['auth', 'admin'])->name('admin.skill.edit');
    Route::put('/skill/{skill}', [SkillController::class, 'update'])->middleware(['auth', 'admin'])->name('admin.skill.update');
    Route::delete('/skill/{skill}', [SkillController::class, 'destroy'])->middleware(['auth', 'admin'])->name('admin.skill.destroy');
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
