document.addEventListener("DOMContentLoaded", function () {
    const data1 = {
        labels: [
            'right answers',
            'wrong answers',
        ],
        datasets: [{
            label: 'Survey result',
            data: [25, 75],
            backgroundColor: [
                'rgb(56,255,0)',
                'rgb(255,0,0)',
            ],
        }]
    }
    const config1 = {
        type: 'pie',
        data: data1,
    }
    new Chart(
        document.getElementById('myChart1'),
        config1,
    );

    const data2 = {
        labels: [
            'right answers',
            'wrong answers',
        ],
        datasets: [{
            label: 'Survey result',
            data: [75, 25],
            backgroundColor: [
                'rgb(56,255,0)',
                'rgb(255,0,0)',
            ],
        }]
    }
    const config2 = {
        type: 'pie',
        data: data2,
    }
    new Chart(
        document.getElementById('myChart2'),
        config2,
    );
})
