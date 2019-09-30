let groupBy = (xs, expr) => {
    return xs.reduce(function(rv, x) {
        let key = expr(x)
        debugger
        (rv[key] = rv[key] || []).push(x)
        return rv
    }, {})
}

let sum = 0;
let count = 0;
fetch('./data.php?anzahl=100')
.then(response => response.json())
.then(data => groupBy(data["stations"], station => {
    return station["NAME"]+" "+station["ORT"]
}))
.then(station => {
    console.log(station)
    console.log(station["TOTAL KALL undefined"][0].PRICE)
})





var ctx = document.getElementById('chart').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
        datasets: [{
            label: 'Tankstellen-Preise Ø',
            data: [1, 2, 3, 8 ,2, 1],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});
