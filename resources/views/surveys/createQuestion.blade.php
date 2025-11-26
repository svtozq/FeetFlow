<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Ajouter une question pour le sondage : {{ $survey->title }}
        </h2>
    </x-slot>

    <div class="max-w-3xl mx-auto py-6">
        <form action="{{ route('surveys.createQuestion', ['organization' => $organization->id, 'survey_id' => $survey->id]) }}" method="POST" class="space-y-5">
            @csrf

            @if($errors->any())
                <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                    <ul class="list-disc pl-5">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div>
                <label class="font-medium">Titre de la question</label>
                <input type="text" name="title" class="border p-2 w-full" value="{{ old('title') }}" required>
            </div>

            <div>
                <label class="font-medium">Type de question</label>
                <select name="question_type" class="border p-2 w-full" required>
                    <option value="radio" {{ old('question_type') == 'radio' ? 'selected' : '' }}>Choix unique</option>
                    <option value="checkbox" {{ old('question_type') == 'checkbox' ? 'selected' : '' }}>Choix multiple</option>
                    <option value="text" {{ old('question_type') == 'text' ? 'selected' : '' }}>Texte</option>
                    <option value="scale" {{ old('question_type') == 'scale' ? 'selected' : '' }}>Échelle 1-10</option>
                </select>
            </div>

            @if(old('question_type') == 'radio' || old('question_type') == 'checkbox')
                <div class="space-y-2">
                    <label class="font-medium">Options</label>
                    <input type="text" name="options[]" class="border p-2 w-full" placeholder="Option 1" value="{{ old('options.0') }}">
                    <input type="text" name="options[]" class="border p-2 w-full" placeholder="Option 2" value="{{ old('options.1') }}">
                    <input type="text" name="options[]" class="border p-2 w-full" placeholder="Option 3" value="{{ old('options.2') }}">
                    <!-- L'utilisateur peut remplir autant d'options qu'il veut -->
                </div>
            @endif

            <button type="submit" class="bg-blue-600 text-black px-4 py-2 rounded">
                Ajouter la question
            </button>
        </form>
    </div>
</x-app-layout>
