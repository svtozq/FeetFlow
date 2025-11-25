<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Modifier un sondage</h2>
    </x-slot>

    <div class="max-w-3xl mx-auto py-6">
        <form action="{{ route('surveys.update', $survey) }}" method="POST" class="space-y-5">
            @csrf
            @method('PUT')

            <!-- Affichage des erreurs -->
            @if($errors->any())
                <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                    <ul class="list-disc pl-5">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Titre -->
            <div>
                <label class="font-medium">Titre</label>
                <input type="text" name="title" value="{{ old('title', $survey->title) }}" class="border p-2 w-full">
            </div>

            <!-- Description -->
            <div>
                <label class="font-medium">Description</label>
                <textarea name="description" class="border p-2 w-full">{{ old('description', $survey->description) }}</textarea>
            </div>

            <!-- Date début -->
            <div>
                <label class="font-medium">Date de début</label>
                <input type="date" name="start_date" value="{{ old('start_date', $survey->start_date) }}" class="border p-2 w-full">
            </div>

            <!-- Date fin -->
            <div>
                <label class="font-medium">Date de fin</label>
                <input type="date" name="end_date" value="{{ old('end_date', $survey->end_date) }}" class="border p-2 w-full">
            </div>

            <!-- Anonyme ? -->
            <div class="flex items-center gap-2">
                <input type="checkbox" name="is_anonymous" value="1" {{ old('is_anonymous', $survey->is_anonymous) ? 'checked' : '' }}>
                <label>Sondage anonyme</label>
            </div>

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
                Modifier
            </button>
        </form>
    </div>
</x-app-layout>
