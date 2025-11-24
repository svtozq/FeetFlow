<html lang="en">
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Dashboard') }}
            </h2>
        </x-slot>

        <div class="flex justify-center">
            <div class="max-w-[250px] max-h-[250px]">
                <canvas id="myChart1"></canvas>
                <canvas id="myChart2"></canvas>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script type="module" src="{{asset('js/results.js')}}"></script>
    </x-app-layout>
</html>
