document.addEventListener("DOMContentLoaded", function () {
    const data = {
        labels: ['right answers', 'wrong answers'],
        datasets: [{
            label: 'Survey result',
            data: [Number(right), Number(wrong)],
            backgroundColor: [
                'rgb(56,255,0)',
                'rgb(255,0,0)',
            ],
        }]
    }
    const config = {
        type: 'pie',
        data: data,
    }
    new Chart(
        document.getElementById('myChart1'),
        config,
    );
})
