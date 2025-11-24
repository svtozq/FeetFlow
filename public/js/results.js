document.addEventListener("DOMContentLoaded", function () {
    const data = {
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
    const config = {
        type: 'doughnut',
        data: data,
    }
    new Chart(
        document.getElementById('myChart'),
        config,
    );
})
