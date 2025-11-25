<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Liste des sondages
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Message flash -->
            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white p-6 shadow sm:rounded-lg">
                <h1 class="text-2xl font-bold mb-4">Mes sondages</h1>

                @if($surveys->isEmpty())
                    <p>Aucun sondage pour le moment.</p>
                @else
                    @foreach($surveys as $survey)
                        <div class="p-4 border rounded mb-3">
                            <h3 class="font-semibold">{{ $survey->title }}</h3>
                            <p>{{ $survey->description }}</p>

                            <div class="flex gap-3 mt-3">
                                <!-- Bouton Modifier (uniquement si autorisé) -->
                                @can('update', $survey)
                                    <a href="{{ route('surveys.edit', $survey) }}" class="text-blue-600 hover:underline">
                                        Modifier
                                    </a>
                                @endcan

                                <!-- Bouton Supprimer (uniquement si autorisé) -->
                                @can('delete', $survey)
                                    <form action="{{ route('surveys.destroy', $survey) }}" method="POST" onsubmit="return confirm('Supprimer ce sondage ?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:underline">Supprimer</button>
                                    </form>
                                @endcan
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
