<?php

namespace App\Http\Controllers;

use App\Actions\Survey\CloseSurveyAction;
use App\Actions\Survey\StoreSurveyAction;
use App\Actions\Survey\UpdateSurveyAction;
use App\DTOs\OrganizationDTO;
use App\DTOs\SurveyDTO;
use App\Http\Requests\Organization\UpdateOrganization;
use App\Http\Requests\Survey\StoreSurveyRequest;
use App\Http\Requests\Survey\UpdateSurveyRequest;
use App\Models\Organization;
use App\Models\Survey;

class SurveyController extends Controller
{
    public function index(Organization $organization)
    {
        // for display the surveys of this organization
        $surveys = Survey::where('organization_id', $organization->id)
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


    public function deleteSurveys($organization, $survey_id, CloseSurveyAction $closeAction)
    {
        $survey = Survey::findOrFail($survey_id);

        $closeAction->execute($survey);

        return redirect()->route('survey.index', ['organization' => $organization])
            ->with('success', 'Sondage supprimé.');
    }



}
