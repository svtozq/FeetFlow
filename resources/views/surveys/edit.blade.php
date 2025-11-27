<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800">Modifier un sondage</h2>
    </x-slot>

    <div class="max-w-3xl mx-auto py-6 bg-gray-50 min-h-screen">
        <form action="{{ route('surveys.update', [$organization->id, $survey->id]) }}"
              method="POST" class="space-y-6 bg-white p-6 rounded-xl shadow-md">
            @csrf
            @method('PUT')

            <!-- Erreurs -->
            @if($errors->any())
                <div class="p-4 bg-red-50 border-l-4 border-red-400 text-red-700 rounded shadow">
                    <ul class="list-disc pl-5">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Titre -->
            <div>
                <label class="font-medium text-gray-700 mb-1 block">Titre</label>
                <input type="text" name="title" value="{{ old('title', $survey->title) }}"
                       class="w-full border border-gray-300 rounded-md p-3 focus:outline-none focus:ring-2 focus:ring-blue-400 transition">
            </div>

            <!-- Description -->
            <div>
                <label class="font-medium text-gray-700 mb-1 block">Description</label>
                <textarea name="description" rows="4"
                          class="w-full border border-gray-300 rounded-md p-3 focus:outline-none focus:ring-2 focus:ring-blue-400 transition">{{ old('description', $survey->description) }}</textarea>
            </div>

            <!-- Dates -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="font-medium text-gray-700 mb-1 block">Date de début</label>
                    <input type="date" name="start_date" value="{{ old('start_date', optional($survey->start_date)->format('Y-m-d')) }}"
                           class="w-full border border-gray-300 rounded-md p-3 focus:outline-none focus:ring-2 focus:ring-blue-400 transition">
                </div>
                <div>
                    <label class="font-medium text-gray-700 mb-1 block">Date de fin</label>
                    <input type="date" name="end_date" value="{{ old('end_date', optional($survey->end_date)->format('Y-m-d')) }}"
                           class="w-full border border-gray-300 rounded-md p-3 focus:outline-none focus:ring-2 focus:ring-blue-400 transition">
                </div>
            </div>

            <!-- Anonyme -->
            <div class="flex items-center gap-2">
                <input type="checkbox" name="is_anonymous" value="1" {{ old('is_anonymous', $survey->is_anonymous) ? 'checked' : '' }}
                class="accent-blue-500">
                <label class="text-gray-700">Sondage anonyme</label>
            </div>

            <!-- Boutons -->
            <div class="flex gap-3 flex-wrap">
                <button type="submit"
                        class="bg-blue-600 text-black font-semibold px-6 py-3 rounded-lg shadow hover:bg-blue-700 transition">
                    Modifier
                </button>
                <a href="{{ route('survey.index', $organization->id) }}"
                   class="bg-gray-300 text-gray-800 px-6 py-3 rounded-lg shadow hover:bg-gray-400 transition">
                    Annuler
                </a>
            </div>
        </form>
    </div>
</x-app-layout>
