<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
        <form method="POST" action="{{ route('results.chart') }}">
            @csrf
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <input type="text" class="chartInput1 border-black" placeholder="right answers">
            <input type="text" class="chartInput2 border-black" placeholder="wrong answers">
            <button type="submit" class="chartButton border-black">Finish survey</button>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script type="module" src="{{asset('js/results.js')}}"></script>
</x-app-layout>
