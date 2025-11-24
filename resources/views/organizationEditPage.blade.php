<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Modifier l'organisation : {{ $organization->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 bg-white p-6 rounded shadow">

            <!-- Formulaire -->
            <form action="{{ route('organizations.update', $organization->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Nom -->
                <div class="mb-6">
                    <label class="block font-semibold mb-2">Nom de l'organisation</label>
                    <input type="text" name="name" value="{{ $organization->name }}"
                           class="w-full border p-2 rounded">
                </div>

                <!-- Membres -->
                <div class="mb-6">
                    <label class="block font-semibold mb-2">Membres associés</label>

                    <select name="members[]" multiple
                            class="w-full border p-2 rounded h-40">
                        @foreach($users as $user)
                            <option value="{{ $user->id }}"
                                    @if($organization->members->pluck('id')->contains($user->id)) selected @endif>
                                {{ $user->first_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Boutons -->
                <div class="flex space-x-4">
                    <button type="submit" class="kt-btn px-4 py-2 rounded-full bg-blue-500 text-black">
                        Mettre à jour
                    </button>

                    <a href="{{ route('organizations.index') }}"
                       class="bg-gray-300 px-4 py-2 rounded-full">
                        Annuler
                    </a>
                </div>
            </form>

        </div>
    </div>
</x-app-layout>
