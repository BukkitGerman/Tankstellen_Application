<!DOCTYPE html>
<html>
<head>
	<title>Simple Loop</title>
</head>
<body>

<style type="text/css">
	button{
		background-color: gray;
		border-radius: 4px;
	}
</style>
<button onclick="loop()">Start loop!</button>
<p id="data"></p>
<script type="text/javascript">
		
	function loop() {
		let currentdate = new Date();
		let time = currentdate.getMinutes();
		let arr = [];
		console.log("Start record!")
		setInterval(function(){
			document.getElementById("data").innerHTML = "Last Refresh at: " + time;
			console.log("Tracked new Data.")
			fetch('./data.php?anzahl=1')
			.then(response => response.json())
			.then(data => {
				data["stations"].forEach(station => {
					arr.push(station)
				})
				console.log(arr)
				arr = [];
			})
		}, 300000);
	}


</script>

</body>
</html>

