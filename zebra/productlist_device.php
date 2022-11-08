<?php


header('content-type: application/json');

	$request = $_SERVER['REQUEST_METHOD'];


	switch ( $request) {
        
        case 'GET':
			// code...
			getMethod();
		break;

		case 'POST':
			// code...
			$data=json_decode(file_get_contents('php://input'),true);
			postmethod($data);
		break;
		default:
		echo '{"name" : "data not found"}';
		break;
	}




//     function postmethod($data){


//     include "index.php";
//     $device=$data["device"];

// 	$sql = " select  id,zid,CONVERT(varchar,ztime,7) as ztime,CONVERT(varchar,zutime,7) as zutime,tag_no,item_code,item_desc,price,scan_qty,adj_qty,auto_qty,manual_qty,xcus,xorg,device,empid,countingsetup_id,outlet,store,zactive,zuuserid,zauserid  from zebra where device = '$device' order by zutime desc ";

//     $stmt = sqlsrv_query( $conn, $sql );


// 	if( $stmt === false) {
//         http_response_code(404);
// 		die( print_r( sqlsrv_errors(), true) );

// 	}
//     else{
//         $rows = array();


//         while( $r = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
//             $rows[] = $r;
//         }
//         echo json_encode($rows, JSON_PRETTY_PRINT);

		
// 	}

// }

function getMethod(){

    include "index.php";
    ini_set('max_execution_time', 3000);
    sqlsrv_configure("WarningsReturnAsErrors", 0);

	$sql = "select  id,zid,CONVERT(varchar,ztime,7) as ztime,CONVERT(varchar,zutime,7) as zutime,tag_no,item_code,item_desc,price,scan_qty,adj_qty,auto_qty,manual_qty,xcus,xorg,device,empid,countingsetup_id,outlet,store,zactive,zuuserid,zauserid  from zebra ORDER BY CONVERT(time, zutime) desc ";

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