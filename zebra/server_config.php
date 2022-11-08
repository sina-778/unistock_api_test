<?php

header('content-type: application/json');

	$request = $_SERVER['REQUEST_METHOD'];


	switch ( $request) {
		case 'POST':
			// code...
			$data=json_decode(file_get_contents('php://input'),true);
			postmethod($data);
		break;
		default:
		echo '{"name" : "data not found"}';
		break;
	}




//function for post data
function postmethod($data){
    include 'index.php';


    $device = $data["device"];
    $ip_add = $data["ip_add"];

    echo http_response_code(200);

}


?>