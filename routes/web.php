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

//SURVEYS
    // Display surveys
    Route::get('/organizations/{organization}/surveys', [SurveyController::class, 'index'])
        ->name('survey.index');

    // Display Create page for create surveys
    Route::get('/organizations/{organization}/surveys/pageCreate', [SurveyController::class, 'pageCreate'])
        ->name('surveys.pageCreate');

    // For create surveys
    Route::post('/organizations/{organization}/surveys', [SurveyController::class, 'createSurveys'])
        ->name('surveys.createSurveys');

    // For show edit form
    Route::get('/organizations/{organization}/surveys/{survey}/edit', [SurveyController::class, 'editSurveys'])
        ->name('surveys.edit');

    // Update survey
    Route::put('/organizations/{organization}/surveys/{survey}', [SurveyController::class, 'updateSurveys'])
        ->name('surveys.update');


    // For delete surveys
    Route::delete('/organizations/{organization}/surveys/{survey_id}', [SurveyController::class, 'deleteSurveys'])
        ->name('surveys.delete');



//SURVEYS QUESTIONS
    // For show Create form
    Route::get('/organizations/{organization}/surveys/{survey_id}/createPage', [SurveyController::class, 'pageCreateQuestion'])
        ->name('surveys.pageCreateQuestion');

    // For Create Questions
    Route::post('/organizations/{organization}/surveys/{survey_id}/question', [SurveyController::class, 'createQuestion'])
        ->name('surveys.createQuestion');






//Organization
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
