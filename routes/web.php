<?php

use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Models\SubmitAnswer;
use App\Events\SurveyAnswerSubmitted;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');



Route::get('/test-email', function () {

    // 1. On simule une fausse réponse
    $fakeAnswer = new SubmitAnswer([
        'survey_id' => 1,
        'user_id' => 1,
        'answer' => 'Ceci est une réponse de test.'
    ]);

    // 2. On déclenche ton Event
    event(new SurveyAnswerSubmitted($fakeAnswer));

    return "Event déclenché → Vérifie ton email !";
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

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
