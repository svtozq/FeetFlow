<x-guest-layout>
    <h1 class="text-2xl font-bold mb-2">{{ $survey->title }}</h1>
    <p class="mb-6">{{ $survey->description }}</p>

    <form method="POST" action="{{ route('survey.submitAnswer', $survey) }}">
        @csrf

        @foreach ($survey->questions as $index => $question)
            <div class="mb-6 p-4 border rounded shadow-sm bg-gray-50">
                <strong class="block text-gray-700 mb-2">{{ $question->title }}</strong>

                @if($question->question_type === 'text')
                    <input type="text"
                           name="answers[{{ $index }}][answer]"
                           placeholder="Répondre..."
                           class="w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
                           required>

                @elseif($question->question_type === 'radio')
                    <div class="flex gap-3 flex-wrap">
                        @foreach($question->options ?? [] as $option)
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="radio"
                                       name="answers[{{ $index }}][answer]"
                                       value="{{ $option }}"
                                       class="accent-blue-500"
                                       required>
                                <span>{{ $option }}</span>
                            </label>
                        @endforeach
                    </div>

                @elseif($question->question_type === 'checkbox')
                    <div class="flex gap-3 flex-wrap">
                        @foreach($question->options ?? [] as $option)
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="checkbox"
                                       name="answers[{{ $index }}][answer][]"
                                       value="{{ $option }}"
                                       class="accent-blue-500">
                                <span>{{ $option }}</span>
                            </label>
                        @endforeach
                    </div>

                @elseif($question->question_type === 'scale')
                    <div class="flex gap-2">
                        @for($i = 1; $i <= 10; $i++)
                            <label class="flex flex-col items-center text-sm cursor-pointer">
                                <input type="radio"
                                       name="answers[{{ $index }}][answer]"
                                       value="{{ $i }}"
                                       class="accent-blue-500"
                                       required>
                                <span>{{ $i }}</span>
                            </label>
                        @endfor
                    </div>
                @endif

                <input type="hidden"
                       name="answers[{{ $index }}][survey_question_id]"
                       value="{{ $question->id }}">
            </div>
        @endforeach

        <button type="submit" class="px-4 py-2 bg-blue-600 text-black rounded hover:bg-blue-700 transition">
            Envoyer mes réponses
        </button>

    </form>
</x-guest-layout>
