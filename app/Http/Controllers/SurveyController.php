<?php

namespace App\Http\Controllers;

use App\Actions\Survey\StoreSurveyAction;
use App\DTOs\SurveyDTO;
use App\Http\Requests\Survey\StoreSurveyRequest;
use App\Models\Survey;

class SurveyController extends Controller
{
    public function index()
    {
        $organizationId = session('current_organization_id');
        $surveys = Survey::where('organization_id', $organizationId)->latest()->get();
        return view('surveys.index', compact('surveys'));
    }

    public function create()
    {
        return view('surveys/create');
    }


    public function store(StoreSurveyRequest $request, StoreSurveyAction $action)
    {
        $dto = SurveyDTO::fromRequest($request);
        $survey = $action->execute($dto);

        return redirect()->route('surveys.show', $survey->id)
            ->with('success', 'Sondage créé avec succès.');
    }

    public function show(Survey $survey)
    {
        return view('surveys.show', compact('survey'));
    }

    public function edit(Survey $survey)
    {
        $this->authorize('update', $survey);
        return view('surveys.edit', compact('survey'));
    }

    public function update(StoreSurveyRequest $request, Survey $survey)
    {
        $this->authorize('update', $survey);

        $dto = SurveyDTO::fromRequest($request);
        $survey->update([
            'title' => $dto->title,
            'description' => $dto->description,
            'start_date' => $dto->start_date,
            'end_date' => $dto->end_date,
            'is_anonymous' => $dto->is_anonymous,
        ]);

        return redirect()->route('surveys.show', $survey->id)
            ->with('success', 'Sondage mis à jour avec succès.');
    }

    public function destroy(Survey $survey)
    {
        $this->authorize('delete', $survey);
        $survey->delete();

        return redirect()->route('surveys.index')
            ->with('success', 'Sondage supprimé.');
    }
}
