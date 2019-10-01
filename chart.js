let groupBy = (xs, expr) => {
    return xs.reduce(function(expr, rv, x) {
        var key = expr(x)
        ;(rv[key] = rv[key] || []).push(x)
        return rv
    }.bind(this, expr), {})
}

let sum = 0;
let count = 0;
fetch('./data.php?anzahl=0')
.then(response => response.json())
.then(data => groupBy(data["stations"], station => {
    return station["NAME"]+", "+station["PLACE"]
}))
.then(stations => {
    console.log(stations)
    console.log(stations["TOTAL KALL, KALL"][0].PRICE)

    Object.keys(stations).forEach(function(station){
        let s = stations[station]
        //console.log(s)
        //console.log(s[0].PRICE)
        console.log(station, durschnittProStunde(s))
    })
})


function durschnittProStunde(obj){
    

    let wholetime = []
    for(let m = 0; m <= 23; m++){  
    let time = []
        for(let i = 0; i < obj.length; i++){
            let date = new Date(obj[i].TIMESPAMP*1000)
            if(date.getHours() == m){
                time.push(obj[i].PRICE)
            }
        }
        let result = 0
        let summe = 0  
        for(let n = 0; n < time.length; n++){
            summe += time[n];
            result = summe/(n+1)
        }
        wholetime.push(result)
    }
    return wholetime;
    
}


let he = window.innerHeight
he -= (window.innerHeight)/2.5
document.getElementById("chartcv").style.height = he+'px'




let time = ['05:00',
            '05:30',
            '06:00',
            '06:30',
            '07:00',
            '07:30',
            '08:00',
            '08:30',
            '09:00',
            '09:30',
            '10:00',
            '10:30',
            '11:00',
            '11:30',
            '12:00',
            '12:30',
            '13:00',
            '13:30',
            '14:00',
            '14:30',
            '15:00',
            '15:30',
            '16:00',
            '16:30',
            '17:00',
            '17:30',
            '18:00',
            '18:30',
            '19:00',
            '19:30',
            '20:00',
            '20:30',
            '21:00',
            '21:30',
            '22:00',
            '22:30',
            '23:00',
            '23:30',
            ]
let testTankstellenPreise = ['1.22',
                             '1.23',
                             '1.34',
                             '1.21',
                             '1.32',
                             '1.26',
                             '1.27',
                             '1.23',
                             '1.33',
                             '1.21',
                             '1.22',
                             '1.25',
                             '1.25',
                             '1.28',
                             '1.21',
                             '1.21',
                             '1.24',
                             '1.23',
                             '1.23',
                             '1.23',
                             '1.22',
                             '1.31',
                             '1.22',
                             '1.23',
                             '1.24',
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
                             '1.25',
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
        label: "Tankstelle 2",
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
