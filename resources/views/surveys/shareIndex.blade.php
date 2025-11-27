<x-app-layout>
    <x-slot name="header">
    </x-slot>

    <div class="py-6 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow rounded-xl">
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-3xl font-bold text-gray-800">Sondage</h1>
                </div>

                @if(!now()->between($survey->start_date, $survey->end_date))
                    <p class="text-gray-600">Le Sondage n'est pas encore disponible, ou a expiré..</p>
                @else
                    <div class="space-y-6">
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
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>

