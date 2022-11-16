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
			// code...

			echo '{"name" : "data not found"}';
		break;
	}




function postmethod($data){


    include "index.php";

	
	
	$item=$data["item"];
    $qty=$data["qty"];
	$device=$data["device"];
    $user_id=$data["user_id"];
    $tag_no=$data["tag_no"];
    //$xtypeleave=$data["xtypeleave"];

	$sql = " IF EXISTS (SELECT 1 FROM zebra WHERE item_code = '$item')
    BEGIN
        UPDATE zebra SET scan_qty = scan_qty - $qty, adj_qty= $qty, zuuserid = '$user_id', zutime = GETDATE(), device = '$device' WHERE item_code = '$item' and tag_no = '$tag_no';
    END";




    
    $stmt = sqlsrv_query( $conn, $sql );

	if( $stmt === false) {
		die( print_r( sqlsrv_errors(), true) );
	}

	$rows = array();


    while( $r = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
      
        $rows = $r;
      //   echo json_encode($rows);
    }

    echo json_encode($rows);

    sqlsrv_free_stmt($stmt);

}

?> 