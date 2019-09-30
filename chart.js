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
fetch('./data.php?anzahl=12')
.then(response => response.json())
.then(data => groupBy(data["stations"], station => {
    return station["NAME"]+" "+station["ORT"]
}))
.then(station => {
    console.log(station)
    console.log(station["TOTAL KALL undefined"][0].PRICE)   
})


let he = window.innerHeight
he -= (window.innerHeight)/2.5
document.getElementById("chartcv").style.height = he+'px'

let time = ['05:00',
            '06:00',
            '07:00',
            '08:00',
            '09:00',
            '10:00',
            '11:00',
            '12:00',
            '13:00',
            '14:00',
            '15:00',
            '16:00',
            '17:00',
            '18:00',
            '19:00',
            '20:00',
            '21:00',
            '22:00',
            '23:00',
            ]
let testTankstellenPreise = ['1.23',
                             '1.22',
                             '1.30',
                             '1.22',
                             '1.23',
                             '1.26',
                             '1.23',
                             '1.24',
                             '1.33',
                             '1.22',
                             '1.23',
                             '1.24',
                             '1.23',
                             '1.27',
                             '1.21',
                             '1.25',
                             '1.29',
                             '1.21',
                             '1.22',
]

let testTankstellenPreise2 =['1.25',
                             '1.22',
                             '1.33',
                             '1.27',
                             '1.36',
                             '1.21',
                             '1.22',
                             '1.23',
                             '1.33',
                             '1.24',
                             '1.23',
                             '1.27',
                             '1.21',
                             '1.29',
                             '1.28',
                             '1.21',
                             '1.22',
                             '1.28',
                             '1.27',
]

let ctx = document.getElementById('chart').getContext('2d');
let myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: time,
    datasets: [
      {
        label: "Tankstelle 1",
        data: testTankstellenPreise,
        backgroundColor: "blue",
        borderColor: "lightblue",
        fill: false,
        lineTension: 0,
        radius: 5
      },
      {
        label: "TeamB Score",
        data: testTankstellenPreise2,
        backgroundColor: "green",
        borderColor: "lightgreen",
        fill: false,
        lineTension: 0,
        radius: 5
      }
    ]
    },
      options: {
            responsive: true,
            maintainAspectRatio: false,
        }
});
