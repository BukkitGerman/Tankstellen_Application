<?php


	//$lat = $_GET['lat'];
	//$lng = $_GET['lng'];
	//$rad = $_GET['rad'];
	//$sort = $_GET['sort'];
	//$type = $_GET['type'];
	//$apikey = $_GET['apikey'];


	$lat = "50.473880";
	$lng = "6.471066";
	$rad = "15";
	$sort = "price";
	$type = "diesel";
	$apikey = "885d8496-1f72-53e5-53b9-df471167af8f";



//$json = file_get_contents('https://creativecommons.tankerkoenig.de/json/list.php?'."lat=".urlencode($lat)."&lng=".urlencode($lng)."&rad=".urlencode($rad)."&sort=".urlencode($sort)."&type=".urlencode($type)."&apikey=".urlencode($apikey));

//var_dump($json);



$data = json_decode($json, true);


	$out = "<table cellspacing=10px>
				<tr class=head>
					<th>Tankstelle</th>
					<th>Ort</th>
					<th>Marke</th>
					<th>Offen</th>
					<th>Preis</th>
				</tr>";
foreach ($data["stations"] as $key => $value) {

	if($value['isOpen']){
		$offen = "Geöffnet";
	}else{
		$offen = "Geschlossen";
	}

	if(strlen($value['brand']) >= 2){
		$marke = $value['brand'];
	}else{
		$marke = "<p align=center> - </p>";
	}
	
	$out .= "
				<tr class=bordergray>
					<td class=border> <a href='https://www.google.de/maps/@".$value['lat'].",".$value['lng'].",18
					.50z'>".$value['name']. "</a></td>
					<td class=border>". $value['place']."</td>
					<td class=border>". $marke ."</td>
					<td class=border>". $offen ."</td>
					<td>" . ($value['price'] - 0.009) ."€</td>
				</tr>";
	}

	$out .= "</table>";

	echo $out;



	
	echo "<pre>";

	

	var_dump($data);
?>