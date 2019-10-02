let ctx = document.getElementById('chart').getContext('2d');

let groupBy = (xs, expr) => {
    return xs.reduce(function(expr, rv, x) {
        var key = expr(x)
        ;(rv[key] = rv[key] || []).push(x)
        return rv
    }.bind(this, expr), {})
}

let time = ['00:00',
            '01:00',
            '02:00',
            '03:00',
            '04:00',
            '05:00',
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
            '23:00'
            ]


let allnames = [];
let allrs = [];
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
        allrs.push(durschnittProStunde(s))
        allnames.push(station)
        console.log(durschnittProStunde(s))

    })
    let allDatasets =  []
    function getAlldatasets(){
        for(let i = 0; i < 12; i++){
            let color = "#xxxxxx".replace(/x/g, y=>(Math.random()*16|0).toString(16))
            allDatasets.push({label: allnames[i+1], data: allrs[i+1], backgroundColor: color, borderColor: color, fill: false, lineTension: 0, radius: 5}) 
        }
        return allDatasets;
    }

    
    console.log(allDatasets)

    let myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: time,
        datasets: getAlldatasets()
    },
      options: {
            responsive: true,
            maintainAspectRatio: false,
        }
});
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

//Size Settings
let he = window.innerHeight
he -= (window.innerHeight)/2.5
document.getElementById("chartcv").style.height = he+'px'





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



