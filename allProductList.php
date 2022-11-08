<?php


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
    ini_set('max_execution_time', 3000);
    sqlsrv_configure("WarningsReturnAsErrors", 0);

	$sql = "SELECT i.xitem, c.xdesc ,i.xcount,i.lastqty, i.xcus, c.xcusname, c.xbodycode, c.xoldcode  FROM imstockcountapp i join caitemapp c on c.xitem=i.xitem order by i.xdatecreate";

    $stmt = sqlsrv_query( $conn, $sql );


	if( $stmt === false) {
        http_response_code(404);
		die( print_r( sqlsrv_errors(), true) );

	}
    else{
        $rows = array();


        while( $r = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
            $rows[] = $r;
        }
        echo json_encode($rows, JSON_PRETTY_PRINT);
        //file_put_contents('myfile.json', json_encode($rows));
    
        // sqlsrv_free_stmt($stmt);
		
	}

  

	//$rows = array();




}

?> 