<?php

set_time_limit(0);
ini_set('max_execution_time', 1800);
ini_set('memory_limit', '512M');	
 
error_reporting(TRUE);


$servername = "localhost";
$username = "zwemmers_adt";
$password = "Alldone?123";
$dbname = "zwemmers_wehshopapi";

date_default_timezone_set("Europe/Berlin");
date_default_timezone_get();

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$api = new WebshopappApiClient('live', '224c3242542ca04f3c8167b647b8808b', '2f529f57520c5750b676315603cfc689', 'nl');


$sqlgetrecords = "SELECT * FROM `webshopproducts` WHERE `lastupdated_date` LIKE '%2017-06-30%' ORDER BY `webshop_id` ASC";
$resultgetrecords = $conn->query($sqlgetrecords);
$data = array();
$i = 0;
if ($resultgetrecords->num_rows > 0) {
    // output data of each row
    while($row = $resultgetrecords->fetch_assoc()) {
    
	if($i < 10){
    
    $data[] = $row ;
	
	}
    $i ++;
	
    }
} else {
    echo "0 results";
}

echo count($data);
echo '<pre/>';print_r($data);

echo $totalcountproducts =  $api->products->count();


