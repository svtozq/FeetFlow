<div class="mb-3">
    <label>Titre</label>
    <input type="text" name="title" class="form-control" value="{{ old('title', $survey->title ?? '') }}" required>
</div>

<div class="mb-3">
    <label>Description</label>
    <textarea name="description" class="form-control">{{ old('description', $survey->description ?? '') }}</textarea>
</div>

<div class="mb-3">
    <label>Date de début</label>
    <input type="date" name="start_date" class="form-control"
           value="{{ old('start_date', isset($survey) ? $survey->start_date->format('Y-m-d') : '') }}" required>
</div>

<div class="mb-3">
    <label>Date de fin</label>
    <input type="date" name="end_date" class="form-control"
           value="{{ old('end_date', isset($survey) ? $survey->end_date->format('Y-m-d') : '') }}" required>
</div>

<div class="form-check mb-3">
    <input type="checkbox" class="form-check-input" name="is_anonymous"
        {{ old('is_anonymous', $survey->is_anonymous ?? false) ? 'checked' : '' }}>
    <label class="form-check-label">Sondage anonyme</label>
</div>
