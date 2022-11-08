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

	$sql = "select  xitem,CONVERT(varchar,xdatecreate,7) as date , CONVERT(varchar,xdatecreate,8) as xtime ,(select xdesc from caitemapp where xitem = imstockcountapp.xitem) as itemname,(select xcusname from caitemapp where xitem = imstockcountapp.xitem) as supname,xcount,lastqty from imstockcountapp order by xdatecreate desc";
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
    
        sqlsrv_free_stmt($stmt);
		
	}

	$rows = array();




}

?> 