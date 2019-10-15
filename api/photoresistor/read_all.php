<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");


//Creating Array for JSON response
$response = array();
 
// Include data base connect class
$filepath = realpath (dirname(__FILE__));
require_once($filepath."/db_connect.php");

 // Connecting to database 
$db = new DB_CONNECT();	
 
 // Fire SQL query to get all data from photoresistor
$result = mysql_query("SELECT *FROM photoresistor") or die(mysql_error());
 
// Check for succesfull execution of query and no results found
if (mysql_num_rows($result) > 0) {
    
	// Storing the returned array in response
    $response["photoresistor"] = array();
 
	// While loop to store all the returned response in variable
    while ($row = mysql_fetch_array($result)) {
        // temperoary user array
        $photoresistor = array();
        $photoresistor["id"] = $row["id"];
        $photoresistor["voltage"] = $row["voltage"];


		// Push all the items 
        array_push($response["photoresistor"], $photoresistor);
    }
    // On success
    $response["success"] = 1;
 
    // Show JSON response
    echo json_encode($response);
}	
else 
{
    // If no data is found 
	$response["success"] = 0;
    $response["message"] = "No data on photoresistor found";
 
    // Show JSON response
    echo json_encode($response);
}
?>