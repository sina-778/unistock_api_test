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

	
    //$someJSON = $data["someJSON"];

	$item_code=$data["item_code"];
    $item_quantity=$data["item_quantity"];

  
    //$xtypeleave=$data["xtypeleave"];

    foreach ($data as ["id" => $id, "item_code" => $item_code, "item_quantity" => $item_quantity]) {
 
        $sql = " INSERT INTO offlineItem(id,item_code,item_quantity,create_date)
        values( '$id', '$item_code',  '$item_quantity', GETDATE())";
        
        $stmt = sqlsrv_query( $conn, $sql );

        if( $stmt === false) {
            die( print_r( sqlsrv_errors(), true) );
        }

    }


    
   // $stmt = sqlsrv_query( $conn, $sql );

	// if( $stmt === false) {
	// 	die( print_r( sqlsrv_errors(), true) );
	// }

	// $rows = array();


    // while( $r = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
      
    //     $rows[] = $r;
    //   //   echo json_encode($rows);
    // }

    // echo json_encode($rows);

    // sqlsrv_free_stmt($stmt);

}

?> 

<!-- <?php

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

	
	
	$item_code=$data["item_code"];
    $item_quantity=$data["item_quantity"];
  
    //$xtypeleave=$data["xtypeleave"];

	$sql = " INSERT INTO offlineItem(item_code,item_quantity,create_date)
    values( '$item_code',  '$item_quantity', GETDATE()) ";



    
    $stmt = sqlsrv_query( $conn, $sql );

	if( $stmt === false) {
		die( print_r( sqlsrv_errors(), true) );
	}

	$rows = array();


    while( $r = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
      
        $rows[] = $r;
      //   echo json_encode($rows);
    }

    echo json_encode($rows);

    sqlsrv_free_stmt($stmt);

}

?>  -->