<?php

ini_set('memory_limit', '256M');
header('content-type: application/json');

	$request = $_SERVER['REQUEST_METHOD'];


	switch ( $request) {


	

		case 'GET':
			// code...
			getMethod();
		break;


		default:

			echo '{"name" : "data not found"}';
		break;
	}




function getMethod(){


include "index.php";
   // json file name
$filename = "myfile.json";

// Read the JSON file in PHP
$data = file_get_contents($filename); 

// Convert the JSON String into PHP Array
$array = json_decode($data, true); 



// Extracting row by row
foreach($array as $row) {
    echo $row["xitem"];
    // Database query to insert data 
    // into database Make Multiple 
    // Insert Query 
    $sql = "INSERT INTO itemtest (xitem, xdesc,xcus,xbodycode,xoldcode) 
                values( '".$row["xitem"]."' , '".$row["xdesc"]."', '".$row["xcus"]."', 
                '".$row["xbodycode"]."', '".$row["xoldcode"]."')";
    

// , xdesc,xcus,xbodycode,xoldcode
// , '$row[xdesc]',  '$row[xcus]', '$row[xbodycode]', '$row[xoldcode]'

    // VALUES ('".$row["xitem"]."', '".$row["xdesc"]."', '".$row["xcus"]."',
    // '".$row["xbodycode"]."', '".$row["xoldcode"]."'); "; 
    $stmt = sqlsrv_query( $conn, $sql );
}





}

?> 