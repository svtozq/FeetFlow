<?php

use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SurveyController;
use Illuminate\Support\Facades\Route;
use App\Models\SurveyAnswer;
use App\Events\SurveyAnswerSubmitted;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/results', function () {
    return view('results');
});

Route::post('/results', [SurveyController::class, 'chart'])->name('results.chart');

Route::middleware('auth')->group(function () {
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

//SURVEYS QUESTIONS ANSWER
    Route::get('/surveys/{survey}/answer', [SurveyController::class, 'answerPage'])
        ->name('survey.answerPage');

    Route::post('/surveys/{survey}/answer', [SurveyController::class, 'submitAnswer'])
        ->name('survey.submitAnswer');

    Route::get('/surveys/{survey}/thank-you', [SurveyController::class, 'thankYou'])
        ->name('survey.answerThankYou');







//Organization
    //Management of organization
    Route::get('/organizations', [OrganizationController::class, 'index'])
        ->name('organizations.index');

    Route::post('/organizations/create', [OrganizationController::class, 'createOrganization'])
        ->name('organizations.store');

    Route::get('/organizations/{organization}/edit', [OrganizationController::class, 'editOrganization'])
        ->name('organizations.edit');

    Route::put('/organizations/{organization}/update', [OrganizationController::class, 'updateOrganization'])
        ->name('organizations.update');

    Route::delete('/organizations/{organization}/delete', [OrganizationController::class, 'deleteOrganization'])
        ->name('organizations.delete');




});





require __DIR__.'/auth.php';




