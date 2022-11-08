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

  
    //$xtypeleave=$data["xtypeleave"];

	$sql = "select ISNULL((select xcount  from imstockcountapp where xitem ='$item'), 0) as qty ,* from caitemapp where xitem ='$item' or xbodycode='$item' or xoldcode='$item'";



    
    $stmt = sqlsrv_query( $conn, $sql );

	if( $stmt === false) {
		die( print_r( sqlsrv_errors(), true) );
	}

	$rows = array();


    while( $r = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
        //echo $row['LastName'].", ".$row['FirstName']."<br />";
        $rows = $r;
      //   echo json_encode($rows);
    }

    echo json_encode($rows, JSON_PRETTY_PRINT);

    sqlsrv_free_stmt($stmt);

}

?> 