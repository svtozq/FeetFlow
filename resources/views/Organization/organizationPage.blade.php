<link rel="stylesheet" href="{{ asset('css/organizationPage.css') }}">

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-800 leading-tight">
            {{ __('Mes Organisations') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Formulaire de création -->
            <form action="{{ route('organizations.store') }}" method="POST" class="mb-6 flex gap-2 items-center">
                @csrf
                <input type="text" name="name" placeholder="Nom de l'organisation" required class="form-input">
                <button type="submit" class="btn btn-create">Créer</button>
            </form>

            @if(session('success'))
                <div class="alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Liste des organisations -->
            <h2 class="text-xl font-semibold mb-4">Liste des organisations</h2>

            @if($organizations->isEmpty())
                <p class="text-gray-500">Aucune organisation pour le moment.</p>
            @else
                <div class="overflow-x-auto">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Membres</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($organizations as $org)
                            <tr>
                                <td>{{ $org->name }}</td>
                                <td>
                                    @if($org->members->isEmpty())
                                        <span class="text-gray-400 italic">Aucun membre</span>
                                    @else
                                        <ul class="list-disc pl-5">
                                            @foreach($org->members as $member)
                                                <li>{{ $member->first_name ?? 'Utilisateur supprimé' }}
                                                    ({{ $member->pivot->role ?? 'membre' }})
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </td>
                                <td class="space-x-2">
                                    <a href="{{ route('organizations.edit', $org->id) }}" class="btn btn-edit">Modifier</a>
                                    <form action="{{ route('organizations.delete', $org->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-delete">Supprimer</button>
                                    </form>
                                    <a href="{{ route('survey.index', $org->id) }}" class="btn btn-edit">Sondage</a>
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



