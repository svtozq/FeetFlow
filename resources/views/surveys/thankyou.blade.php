<x-guest-layout>
   <h1>Merci pour votre participation !</h1>

  @if(session('success'))
      <p>{{ session('success') }}</p>
    @endif

    <a href="{{ route('survey.index', $survey->organization->id) }}"
       class="bg-gray-300 text-gray-800 px-6 py-3 rounded-lg shadow hover:bg-gray-400 transition">
        Retour au menu sondage
    </a>
</x-guest-layout>
