<html lang="en">
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Dashboard') }}
            </h2>
        </x-slot>
        <div class="py-12">
            <div class="max-w-1xl mx-auto sm:px-6 lg:px-8">
                <div class="py-1 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <canvas id="myChart" width="50px" height="50px"></canvas>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script type="module" src="{{asset('js/results.js')}}"></script>
    </x-app-layout>
</html>
