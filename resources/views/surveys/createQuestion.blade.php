<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800">
            Ajouter une question pour le sondage : {{ $survey->title }}
        </h2>
    </x-slot>

    <div class="max-w-3xl mx-auto py-6 bg-gray-50 min-h-screen">
        <form action="{{ route('surveys.createQuestion', ['organization' => $organization->id, 'survey_id' => $survey->id]) }}"
              method="POST" class="space-y-6 bg-white p-6 rounded-xl shadow-md">
            @csrf

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

            <!-- Titre de la question -->
            <div>
                <label class="font-medium text-gray-700 mb-1 block">Titre de la question</label>
                <input type="text" name="title" value="{{ old('title') }}" required
                       class="w-full border border-gray-300 rounded-md p-3 focus:outline-none focus:ring-2 focus:ring-blue-400 transition">
            </div>

            <!-- Type de question -->
            <div>
                <label class="font-medium text-gray-700 mb-1 block">Type de question</label>
                <select id="question_type" name="question_type" required
                        class="w-full border border-gray-300 rounded-md p-3 focus:outline-none focus:ring-2 focus:ring-blue-400 transition">
                    <option value="radio" {{ old('question_type') == 'radio' ? 'selected' : '' }}>Choix unique</option>
                    <option value="checkbox" {{ old('question_type') == 'checkbox' ? 'selected' : '' }}>Choix multiple</option>
                    <option value="text" {{ old('question_type') == 'text' ? 'selected' : '' }}>Texte</option>
                    <option value="scale" {{ old('question_type') == 'scale' ? 'selected' : '' }}>Échelle 1-10</option>
                </select>
            </div>

            <!-- Options dynamiques -->
            <div id="options-container" class="mt-2"></div>

            <!-- Boutons -->
            <div class="flex gap-3 flex-wrap">
                <button type="submit"
                        class="bg-blue-600 text-black font-semibold px-6 py-3 rounded-lg shadow hover:bg-blue-700 transition">
                    Ajouter la question
                </button>
                <a href="{{ route('survey.index', $organization->id) }}"
                   class="bg-gray-300 text-gray-800 px-6 py-3 rounded-lg shadow hover:bg-gray-400 transition">
                    Annuler
                </a>
            </div>
        </form>
    </div>

    <script type="module" src="{{asset('js/choiseOption.js')}}"></script>
</x-app-layout>
