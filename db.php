<?php
class MyDB extends SQLite3 {
	function __construct() {
		$this->open('database.db');
	}
}

$db = new MyDB();
if(!$db) {
	echo $db->lastErrorMsg();
	die();
} else {
	echo "Opened database successfully!";

}



    #  $sql =<<<EOF
    #  CREATE TABLE TANKSTELLEN_DATEN(
	#	ID INT PRIMARY KEY	NOT NULL,
	#	NAME	TEXT,
	#	TIMESPAMP DATETIME DEFAULT CURRENT_TIMESTAMP,
	#	PRICE	FLOAT,
	#	PLACE 	TEXT,
	#	STREET	TEXT,
	#	LAT		FlOAT,
	#	LNG		FLOAT,
	#	DIST	FLOAT,
	#	ISOPEN	BOOLEAN
	#	);
	#EOF;

$lat = "50.473880";
$lng = "6.471066";
$rad = "15";
$sort = "price";
$type = "diesel";
$apikey = "885d8496-1f72-53e5-53b9-df471167af8f";


$sql =<<<EOF
SELECT * from TANKSTELLEN_DATEN SORT_BY ID LIMIT 1;
EOF;

#FEHLER


//$row = $ret->fetchArray(SQLITE3_ASSOC);
//$TIMP = $row['TIMESPAMP'];



echo "3";

if((time() - $TIMP) > 300){
	$json = file_get_contents('https://creativecommons.tankerkoenig.de/json/list.php?'."lat=".urlencode($lat)."&lng=".urlencode($lng)."&rad=".urlencode($rad)."&sort=".urlencode($sort)."&type=".urlencode($type)."&apikey=".urlencode($apikey));

	$data = json_decode($json, true);

	foreach ($data["stations"] as $key => $value) {

	


	$stmt = $db->prepare('INSERT INTO TANKSTELLEN_DATEN (NAME, TIMESPAMP, PRICE, PLACE, STREET, LAT, LNG, DIST, ISOPEN) VALUES (:name, :ti, :price, :place, :street, :lat, :lng, :dist, :isopen');
	$stmt->bindValue(':name', $value['name']);
	$stmt->bindValue(':ti', time());
	$stmt->bindValue(':price', $value['price']);
	$stmt->bindValue(':place', $value['place']);
	$stmt->bindValue(':lat', $value['lat']);
	$stmt->bindValue(':lng', $value['lng']);
	$stmt->bindValue(':dist', $value['dist']);
	$stmt->bindValue(':isopen', $value['isopen']);

	$stmt->execute();



}
	
}

$sql =<<<EOF
SELECT * from TANKSTELLEN_DATEN;
EOF;

$ret = $db->query($sql);
while($row = $ret->fetchArray(SQLITE3_ASSOC) ) {
	$stations = array($row['ID'] => array('name' => $row['name'], 'PRICE' => $row['PRICE'], 'PLACE' => $row['PLACE'], 'STREET	' => $row['STREET'], 'LAT' => $row['LAT'], 'LNG' => $row['LNG'], 'DIST' => $row['DIST'], 'ISOPEN' => $row['ISOPEN']))	;
}
echo json_encode($stations);
echo "test";
$db->close();