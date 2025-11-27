<?php

namespace App\Http\Controllers;

use App\Actions\Survey\StoreSurveyAction;
use App\Actions\Survey\StoreSurveyAnswerAction;
use App\Actions\Survey\StoreSurveyQuestionAction;
use App\Actions\Survey\UpdateSurveyAction;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\DTOs\SurveyAnswerDTO;
use App\DTOs\SurveyDTO;
use App\Http\Requests\Survey\StoreSurveyAnswerRequest;
use App\Http\Requests\Survey\StoreSurveyQuestionRequest;
use App\Http\Requests\Survey\StoreSurveyRequest;
use App\Http\Requests\Survey\UpdateSurveyRequest;
use App\Models\Organization;
use App\Models\Survey;
use Illuminate\View\View;
use Illuminate\Http\Request;

class SurveyController extends Controller
{
    use AuthorizesRequests;

    /**
     * @param Request $request
     * @return View
     */
    public function chart(Request $request): View
    {
        $right = $request->input('input1');
        $wrong = $request->input('input2');

        session(['right' => $right, 'wrong' => $wrong]);
        return view('results');
    }

    /**
     * @param $token
     * @return View
     */
    public function share($token): View
    {
        $survey = Survey::where('token', $token)->first();

        return view('surveys.answer', [
            'token' => $token,
            'survey' => $survey
        ]);
    }

    /**
     * @param Organization $organization
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index(Organization $organization)
    {
        // authorization of who can make action
        $this->authorize('viewAny', [Survey::class, $organization]);

        // for display the surveys of this organization
        $surveys = Survey::where('organization_id', $organization->id)
            ->where('closed', 0)
            ->latest()
            ->get();

        return view('surveys.index', [
            'organization' => $organization,
            'surveys' => $surveys
        ]);
    }

    /**
     * @param Organization $organization
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function pageCreate(Organization $organization)
    {
        $this->authorize('create', [Survey::class, $organization]);
        $surveys = $organization->surveys;

        return view('surveys.create', compact('organization', 'surveys'));
    }


    /**
     * @param StoreSurveyRequest $request
     * @param Organization $organization
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */

    public function createSurveys(StoreSurveyRequest $request, Organization $organization)
    {

        $this->authorize('create', [Survey::class, $organization]);

        // This DTO centralizes and validates all necessary survey data
        $dto = SurveyDTO::fromRequest($request, $organization->id);

        // Call the action that handles the actual creation of the survey in the database
        (new StoreSurveyAction())->execute($dto);

        return redirect()
            ->route('survey.index', $organization->id)
            ->with('success', 'Sondage créé !');
    }

    /**
     * @param Organization $organization
     * @param Survey $survey
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */

    public function editSurveys(Organization $organization, Survey $survey)
    {
        $this->authorize('update', $survey);
        return view('surveys.edit', compact('organization', 'survey'));
    }

    /**
     * @param UpdateSurveyRequest $request
     * @param Organization $organization
     * @param Survey $survey
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */

    public function updateSurveys(UpdateSurveyRequest $request, Organization $organization, Survey $survey)
    {
        $this->authorize('update', $survey);
        $dto = SurveyDTO::fromRequest($request, $organization->id);

        (new UpdateSurveyAction())->execute($survey, $dto);

        return redirect()->route('survey.index', $organization->id)
            ->with('success', 'Sondage mis à jour avec succès.');
    }

    /**
     * @param $organization
     * @param $survey_id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */

    public function deleteSurveys($organization, $survey_id)
    {
        $survey = Survey::findOrFail($survey_id);
        $this->authorize('delete', $survey);
        $survey->delete();

        return redirect()->route('survey.index', ['organization' => $organization])
            ->with('success', 'Sondage supprimé.');
    }

    /**
     * @param $organization_id
     * @param $survey_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */

    // For question of surveys
    public function pageCreateQuestion($organization_id, $survey_id)
    {
        $organization = Organization::findOrFail($organization_id);
        $survey = Survey::findOrFail($survey_id);

        $this->authorize('update', $survey);

        return view('surveys.createQuestion', compact('organization', 'survey'));
    }

    /**
     * @param StoreSurveyQuestionRequest $request
     * @param $organization
     * @param $survey_id
     * @param StoreSurveyQuestionAction $action
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */

    public function createQuestion(StoreSurveyQuestionRequest $request, $organization, $survey_id, StoreSurveyQuestionAction $action)
    {
        $survey = Survey::findOrFail($survey_id);

        $this->authorize('update', $survey);

        $action->execute($request->validated(), $survey->id);

        return redirect()->route('survey.index', $survey->organization_id)
            ->with('success', 'Question ajoutée !');
    }


    /**
     * @param Survey $survey
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */

    public function answerPage(Survey $survey)
    {
        $this->authorize('view', $survey);
        // load the questions
        $survey->load('questions');

        return view('surveys.answer', compact('survey'));
    }

    /**
     * @param Survey $survey
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */

    public function thankYou(Survey $survey)
    {
        $this->authorize('view', $survey);

        return view('surveys.thankyou', [
            'survey' => $survey,
        ]);
    }

    /**
     * @param StoreSurveyAnswerRequest $request
     * @param Survey $survey
     * @param StoreSurveyAnswerAction $action
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function submitAnswer(StoreSurveyAnswerRequest $request, Survey $survey, StoreSurveyAnswerAction $action)
    {
        $this->authorize('view', $survey);
        $dto = SurveyAnswerDTO::fromRequest($request, $survey, auth()->id());

        $action->handle($dto);

        return redirect()
            ->route('survey.answerThankYou', $survey)
            ->with('success', 'Merci pour votre participation !');
    }

}
