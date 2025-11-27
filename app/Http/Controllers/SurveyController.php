<?php

namespace App\Http\Controllers;

use App\Actions\Survey\StoreSurveyAction;
use App\Actions\Survey\StoreSurveyQuestionAction;
use App\Actions\Survey\UpdateSurveyAction;
use App\DTOs\OrganizationDTO;
use App\DTOs\SurveyDTO;
use App\Http\Requests\Organization\UpdateOrganization;
use App\Http\Requests\Survey\StoreSurveyQuestionRequest;
use App\Http\Requests\Survey\StoreSurveyRequest;
use App\Http\Requests\Survey\UpdateSurveyRequest;
use App\Models\Organization;
use App\Models\Survey;
use Illuminate\View\View;
use Illuminate\Http\Request;

class SurveyController extends Controller
{
    public function chart(Request $request): View
    {
        $right = $request->input('input1');
        $wrong = $request->input('input2');

        session(['right' => $right, 'wrong' => $wrong]);
        return view('results');
    }

    public function share($token): View
    {
        $survey = Survey::where('token', $token)->first();

        return view('surveys.shareIndex', [
            'token' => $token,
            'survey' => $survey
        ]);
    }

    public function index(Organization $organization)
    {
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


    public function pageCreate(Organization $organization)
    {
        $surveys = $organization->surveys;

        return view('surveys.create', compact('organization', 'surveys'));
    }



    public function createSurveys(StoreSurveyRequest $request, Organization $organization)
    {
        $dto = SurveyDTO::fromRequest($request, $organization->id);

        (new StoreSurveyAction())->execute($dto);

        return redirect()
            ->route('survey.index', $organization->id)
            ->with('success', 'Sondage créé !');
    }


    public function editSurveys(Organization $organization, Survey $survey)
    {
        return view('surveys.edit', compact('organization', 'survey'));
    }


    public function updateSurveys(UpdateSurveyRequest $request, Organization $organization, Survey $survey)
    {
        $dto = SurveyDTO::fromRequest($request, $organization->id);

        (new UpdateSurveyAction())->execute($survey, $dto);

        return redirect()->route('survey.index', $organization->id)
            ->with('success', 'Sondage mis à jour avec succès.');
    }


    public function deleteSurveys($organization, $survey_id)
    {
        $survey = Survey::findOrFail($survey_id);

        $survey->delete();

        return redirect()->route('survey.index', ['organization' => $organization])
            ->with('success', 'Sondage supprimé.');
    }


    // For question of surveys
    public function pageCreateQuestion($organization_id, $survey_id)
    {
        $organization = Organization::findOrFail($organization_id);
        $survey = Survey::findOrFail($survey_id);

        return view('surveys.createQuestion', compact('organization', 'survey'));
    }


    public function createQuestion(StoreSurveyQuestionRequest $request, $organization, $survey_id, StoreSurveyQuestionAction $action)
    {
        $survey = Survey::findOrFail($survey_id);

        $action->execute($request->validated(), $survey->id);

        return redirect()->route('survey.index', $survey->organization_id)
            ->with('success', 'Question ajoutée !');
    }




}
