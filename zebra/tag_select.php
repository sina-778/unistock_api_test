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

	$sql = "select CONVERT(varchar,ztime,7) as ztime, CONVERT(varchar,zutime,7) as zutime, zid,zauserid,zuuserid,xtagnum,xlong,xref,xwh,xstatustag,zaip,zuip,CONVERT(varchar,xdate,7) as date,CONVERT(varchar,xdatecom,7) as datecom from imtag where xstatustag='Open'";

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
		
	}

}

?> 