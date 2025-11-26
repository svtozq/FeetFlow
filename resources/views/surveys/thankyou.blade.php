<x-guest-layout>
    <h1>Merci pour votre participation !</h1>

    @if(session('success'))
        <p>{{ session('success') }}</p>
    @endif
</x-guest-layout>
