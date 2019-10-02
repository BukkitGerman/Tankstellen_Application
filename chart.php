<!DOCTYPE html>
<html>
<head>
	<title>Tankstellen - Diagramm</title>
	<link rel="apple-touch-icon" href="./image/disel.png">
	<link rel="shortcut icon" href="./image/favicon.ico" type="image/x-icon">
	<link rel="icon" href="./image/favicon.ico" type="image/x-icon">
	<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0/dist/Chart.min.js"></script>
	<link rel="stylesheet" type="text/css" href="./css/nav.css">
</head>
<nav>
	<div class="nav">
		<a href="./index.php">Overview</a>
	</div>
</nav>
<body>
	<form method="POST">
		<b>Wählen Sie Eine Tankstelle:</b>
		<select name="tankstelle" id="tankstelle" size="1" onchange="newSelection(event)">
			<option>Tankstelle Im Hahnborn, Stadtkyll</option>
			<option>Bauzentrale Schumacher GmbH, Kall</option>
			<option>NETTERSHEIM, SCHWALBENWEG, NETTERSHEIM</option>
			<option>trinkkontor Bitburger Bier GmbH, Hellenthal</option>
			<option>Esso Tankstelle, HELLENTHAL</option>
			<option>Aral Tankstelle, Stadtkyll</option>
			<option>Aral Tankstelle, Blankenheim</option>
			<option>Tank-Wasch-Punkt Karls Simone Viell, Kall</option>
			<option>Tankstelle Finder Gbr, Kall</option>
			<option>Aral Tankstelle, Schleiden</option>
			<option>TOTAL KALL, KALL</option>
			<option>SCHLEIDEN, GEMUENDER STR, SCHLEIDEN</option>
		</select>
	</form>
	<div id="chartcv">
		<canvas id="chart" style="position: relative; height: 50vh"></canvas>
	</div>
	<script src="./js/chart.js"></script>
</body>
</html>