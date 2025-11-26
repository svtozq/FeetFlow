<x-guest-layout>
    <h1>{{ $survey->title }}</h1>
    <p>{{ $survey->description }}</p>

    <form method="POST" action="{{ route('survey.answer.submit', $survey) }}">
        @csrf

        @foreach ($survey->questions as $index => $question)
            <div class="mb-4">
                <label class="block mb-1">
                    {{ $question->question }}
                </label>

                <input type="text"
                       name="answers[{{ $index }}][answer]"
                       class="border rounded px-2 py-1 w-full"
                       required>

                <input type="hidden"
                       name="answers[{{ $index }}][survey_question_id]"
                       value="{{ $question->id }}">
            </div>
        @endforeach

        <button type="submit" class="px-4 py-2 ">
            Envoyer mes réponses
        </button>
    </form>
</x-guest-layout>
