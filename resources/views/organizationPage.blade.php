<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mes Organisations') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Formulaire de création -->
            <form action="{{ route('organizations.store') }}" method="POST" class="mb-6">
                @csrf
                <input type="text" name="name" placeholder="Nom de l'organisation" required class="border rounded p-2">
                <button type="submit" class="bg-blue-500 text-black px-4 py-2 rounded">Créer</button>
                @if(session('success'))
                    <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
                        {{ session('success') }}
                    </div>
                @endif
            </form>

            <!-- Liste des organisations -->
            <!-- Liste des organisations -->
            <h2 class="text-lg font-semibold mb-2">Liste des organisations</h2>

            @if($organizations->isEmpty())
                <p>Aucune organisation pour le moment.</p>
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white border border-gray-200">
                        <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-2 text-left border-b">Nom de l'organisation</th>
                            <th class="px-4 py-2 text-left border-b">Membres</th>
                            <th class="px-4 py-2 text-left border-b">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($organizations as $org)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-2 border-b">{{ $org->name }}</td>

                                <!-- membres -->
                                <td class="px-4 py-2 border-b">
                                    @if($org->members->isEmpty())
                                        <span class="text-gray-500">Aucun membre</span>
                                    @else
                                        <ul class="list-disc pl-5">
                                            @foreach($org->members as $member)
                                                <li>
                                                    {{ $member->first_name ?? 'Utilisateur supprimé' }}
                                                    ({{ $member->pivot->role ?? 'membre' }})
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </td>

                                <td class="px-4 py-2 border-b space-x-2">
                                    <a href="{{ route('organizations.edit', $org->id) }}"
                                       class="kt-btn inline-block px-4 py-2 rounded-full bg-blue-500 text-black hover:bg-blue-600">
                                        Modifier
                                    </a>
                                    <form action="{{ route('organizations.delete', $org->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500 text-black px-3 py-1 rounded">Supprimer</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
