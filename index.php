<!DOCTYPE HTML> 
<HTML>
<html>
<head>
	<title>Tankstellen Preise</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="theme-color" content="#e1b12c">
	<link rel="manifest" href="tankapp.webmanifest">
	<link rel="manifest" href="tankapp.json">
	<link rel="apple-touch-icon" href="./image/disel.png">
	<link rel="shortcut icon" href="./image/favicon.ico" type="image/x-icon">
	<link rel="icon" href="./image/favicon.ico" type="image/x-icon">
	<link rel="stylesheet" type="text/css" href="style.css">

	
	<script type="text/javascript">
		/*if('serviceWorker' in navigator) {
    		navigator.serviceWorker.register('./worker.js');
		}*/
	</script>
</head>
<body>
	<table cellspacing=10px>
				<tr class=head>
					<th>Tankstelle</th>
					<th>Ort</th>
					<th>Marke</th>
					<th>Offen</th>
					<th>Preis</th>
				</tr>
	</table>
	<hr/>
	<p class="cWhite">Project on <a class="cWhite" href="https://github.com/BukkitGerman/Tankstellen_Application">Github</a></p>
	<script type="text/javascript">
		let table = document.querySelector("table")

		fetch('./data.php?anzahl=12')
		.then(response => response.json())
		.then(data => {
			data["stations"].forEach(station => {
				console.log(station)

				let row = table.insertRow(1)
				let tankstelle = row.insertCell(0)
				let ort = row.insertCell(1)
				let marke = row.insertCell(2)
				let offen = row.insertCell(3)
				let preis = row.insertCell(4)	

				tankstelle.innerText = station.NAME
				ort.innerText = station.PLACE
				marke.innerText = station.BRAND
				offen.innerText = station.ISOPEN ? "Offen" : "Geschlossen" 
				let preisText = station.PRICE.toString().split("")
				preisText.splice(-1, 0, "<sup class='tiny'>")
				preis.innerHTML = preisText.join("")+"</sup>"
			})
		})
	</script>
	<script src="./js/app.js"></script>
</body>
</html>

