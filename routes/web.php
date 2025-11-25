<?php

use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SurveyController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // 👉 LA SEULE ROUTE QUI GÈRE LES SONDAGES :
    Route::get('survey', [SurveyController::class, 'create'])
        ->name('survey.create');

    Route::post('survey', [SurveyController::class, 'store'])
        ->name('surveys.store');


    //Management of organization
    Route::get('/organizations', [OrganizationController::class, 'index'])
        ->name('organizations.index');

    Route::post('/organizations', [OrganizationController::class, 'createOrganization'])
        ->name('organizations.store');

    Route::get('/organizations/{organization}/edit', [OrganizationController::class, 'editOrganization'])
        ->name('organizations.edit');

    Route::put('/organizations/{organization}', [OrganizationController::class, 'updateOrganization'])
        ->name('organizations.update');

    Route::delete('/organizations/{organization}', [OrganizationController::class, 'deleteOrganization'])
        ->name('organizations.delete');
});

require __DIR__.'/auth.php';
