<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800">
            Liste des sondages de l'organisme {{ $organization->name }}
        </h2>
    </x-slot>

    <div class="py-6 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Message flash -->
            @if(session('success'))
                <div class="mb-6 p-4 bg-green-50 border-l-4 border-green-400 text-green-700 rounded shadow">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white p-6 shadow rounded-xl">
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-3xl font-bold text-gray-800">Mes sondages</h1>
                    <a href="{{ route('surveys.pageCreate', $organization->id) }}" class="bg-blue-600 text-black font-semibold px-5 py-2 rounded-lg shadow hover:bg-blue-700 transition">
                        Créer
                    </a>
                </div>

                @if($surveys->isEmpty())
                    <p class="text-gray-600">Aucun sondage pour le moment.</p>
                @else
                    <div class="space-y-6">
                        @foreach($surveys as $survey)
                            <div class="p-6 border border-gray-200 rounded-xl shadow-md hover:shadow-lg transition bg-white">
                                <h3 class="text-xl font-bold text-gray-800 mb-2">{{ $survey->title }}</h3>
                                <p class="text-gray-600 mb-4">{{ $survey->description }}</p>

                                <!-- Questions -->
                                <div class="space-y-4">
                                    @foreach($survey->questions as $question)
                                        <div class="bg-gray-50 p-4 rounded-lg border border-gray-100 shadow-sm">
                                            <strong class="block text-gray-700 mb-2">{{ $question->title }}</strong>

                                            @if($question->question_type === 'text')
                                                <input type="text" name="question_{{ $question->id }}" placeholder="Répondre..."
                                                       class="w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-400 transition">
                                            @elseif(in_array($question->question_type, ['radio','checkbox']))
                                                <div class="flex gap-3 flex-wrap">
                                                    @foreach($question->options ?? [] as $option)
                                                        <label class="flex items-center gap-2 cursor-pointer">
                                                            <input type="{{ $question->question_type }}"
                                                                   name="question_{{ $question->id }}{{ $question->question_type === 'checkbox' ? '[]' : '' }}"
                                                                   value="{{ $option }}"
                                                                   class="accent-blue-500">
                                                            <span>{{ $option }}</span>
                                                        </label>
                                                    @endforeach
                                                </div>
                                            @elseif($question->question_type === 'scale')
                                                <div class="flex gap-2">
                                                    @for($i=1;$i<=10;$i++)
                                                        <label class="flex flex-col items-center text-sm cursor-pointer">
                                                            <input type="radio" name="question_{{ $question->id }}" value="{{ $i }}" class="accent-blue-500">
                                                            <span>{{ $i }}</span>
                                                        </label>
                                                    @endfor
                                                </div>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>

                                <!-- Actions -->
                                <div class="flex flex-wrap gap-3 mt-4 items-center">
                                    @can('update', $survey)
                                        <a href="{{ route('surveys.edit', [$organization->id, $survey->id]) }}"
                                           class="bg-yellow-400 text-gray-900 font-semibold px-4 py-2 rounded-lg shadow hover:bg-yellow-500 transition">
                                            Modifier
                                        </a>
                                    @endcan

                                    @can('delete', $survey)
                                        <form action="{{ route('surveys.delete', [$organization->id, $survey->id]) }}" method="POST" onsubmit="return confirm('Supprimer ce sondage ?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-500 text-black font-semibold px-4 py-2 rounded-lg shadow hover:bg-red-600 transition">
                                                Supprimer
                                            </button>
                                        </form>
                                    @endcan

                                    @can('create', $survey)
                                    <a href="{{ route('surveys.pageCreateQuestion', [$organization->id, $survey->id]) }}"
                                       class="bg-green-500 text-black font-semibold px-4 py-2 rounded-lg shadow hover:bg-green-600 transition">
                                        Ajouter des questions
                                    </a>
                                    @endcan
                                        <a href="{{ route('survey.answerPage', $survey) }}"
                                           class="bg-green-500 text-black font-semibold px-4 py-2 rounded-lg shadow hover:bg-green-600 transition">
                                            Repondre au sondage
                                        </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
