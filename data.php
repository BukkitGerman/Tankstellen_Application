<?php
class MyDB extends SQLite3 {
	function __construct() {
		$this->open('database.db');
	}
}

$db = new MyDB();
if(!$db) {
	//echo $db->lastErrorMsg();
	die();
} else {
	//echo "<br/>Opened database successfully!";

}

include 'key.php';

$query = "CREATE TABLE IF NOT EXISTS TANKSTELLEN_DATEN(
ID INT PRIMARY KEY	NOT NULL,
NAME	TEXT,
TIMESPAMP DATETIME DEFAULT CURRENT_TIMESTAMP,
PRICE	FLOAT,
PLACE 	TEXT,
STREET	TEXT,
LAT		FlOAT,
LNG		FLOAT,
DIST	FLOAT,
ISOPEN	BOOLEAN,
BRAND TEXT
);";



$ret = $db->exec($query);
if(!$ret){
	//echo $db->lastErrorMsg();
} else {
	//echo " <br/>Table created successfully!";
}

if(false){
	$query = "INSERT INTO TANKSTELLEN_DATEN (ID, NAME, TIMESPAMP, PRICE, PLACE, STREET, LAT, LNG, DIST, ISOPEN, BRAND) VALUES ('0','Erster Eintrag',".time().", '0.00', 'Test', 'Test', '0.00', '0.00', '5', 'true', 'basdasd')";


	$ret = $db->exec($query);
	if(!$ret){
		echo $db->lastErrorMsg();
	} else {
		echo "<br/>Insert successfully!";
	}


}



$query="SELECT * from TANKSTELLEN_DATEN ORDER BY ID DESC LIMIT 1;";
$ret = $db->query($query);

while($row = $ret->fetchArray(SQLITE3_ASSOC)){
	$TIMESPAMP = $row['TIMESPAMP'];
	$LastID = $row['ID'];
}

$anzahl = $_GET['anzahl'];


if((time()-$TIMESPAMP) > 300){
	$LastID += 1;
	$json = file_get_contents('https://creativecommons.tankerkoenig.de/json/list.php?'."lat=".urlencode($lat)."&lng=".urlencode($lng)."&rad=".urlencode($rad)."&sort=".urlencode($sort)."&type=".urlencode($type)."&apikey=".urlencode($apikey));

	$data = json_decode($json, true);
	
	$eintreage = 0;
	foreach ($data["stations"] as $key => $value) {
		$eintreage += 1;

		

		$query = "INSERT INTO TANKSTELLEN_DATEN (ID, NAME, TIMESPAMP, PRICE, PLACE, STREET, LAT, LNG, DIST, ISOPEN, BRAND) VALUES ('".$LastID."','".$value['name']."','".time()."', '".$value['price']."', '".$value['place']."', '".$value['street']."', '".$value['lat']."', '".$value['lng']."', '".$value['dist']."', '".$value['isOpen']."', '".$value['brand']."');";

		//$stmt = $db->prepare('INSERT INTO TANKSTELLEN_DATEN (ID, NAME, TIMESPAMP, PRICE, PLACE, STREET, LAT, LNG, DIST, ISOPEN) VALUES (:id, :name, :ti, :price, :place, :street, :lat, :lng, :dist, :isopen');
		//$stmt->bindValue(':id', ($LastID + 1));
		//$stmt->bindValue(':name', $value['name']);
		//$stmt->bindValue(':ti', time());
		//$stmt->bindValue(':price', $value['price']);
		//$stmt->bindValue(':place', $value['place']);
		//$stmt->bindValue(':place', $value['street']);
		//$stmt->bindValue(':lat', $value['lat']);
		//$stmt->bindValue(':lng', $value['lng']);
		//$stmt->bindValue(':dist', $value['dist']);
		//$stmt->bindValue(':isopen', $value['isopen'])
		//$stmt->execute();

		$ret = $db->exec($query);
	if(!$ret){
		//echo $db->lastErrorMsg();
	} else {
		//echo "<br/>Insert successfully! ";
	}

	$LastID += 1;
	}
	
}else{
	//echo "<br/>Time!";
}

	

	if($anzahl == 0){
		$query="SELECT * from TANKSTELLEN_DATEN;";
	}else if($anzahl >= 1){
		$query="SELECT * from TANKSTELLEN_DATEN ORDER BY ID DESC LIMIT ".$anzahl.";";	
	}else{
		$query="SELECT * from TANKSTELLEN_DATEN ORDER BY ID DESC LIMIT 12;";
	}

	$ret = $db->query($query);


	$innerArray = array();
	

while($row = $ret->fetchArray(SQLITE3_ASSOC)){
	
	array_push($innerArray, $row);
	

}
$decOutput = array('stations' => $innerArray);

echo json_encode($decOutput);

$db->close();
?>