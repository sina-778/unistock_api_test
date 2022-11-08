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
    ini_set('max_execution_time', 30000);
    ini_set('memory_limit', '4096M');
    sqlsrv_configure("WarningsReturnAsErrors", 0);

	$sql = "select  * from itemtest where id between 1 and 1000";
   
    $stmt = sqlsrv_query( $conn, $sql );


	if( $stmt === false && $result === false) {
        http_response_code(404);
		die( print_r( sqlsrv_errors(), true) );

	}
    else{
        $rows = array();
        //$rows->put_MaxResponseSize(100000);

 

        // while( $r = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
        //     //print_r ($r);
        //     $rows[] = $r;
        //     print_r ($rows);
        // }


        while ($r = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)){
            // extract row
            // this will make $row['name'] to
            // just $name only
            extract($r);
        
            $row_item=array(
                "id" => $r['id'],
                "xdesc" => $r['xdesc'],
                "xitem" => $r['xitem']
            );
        
            // array_push($books_arr["records"], $books_item);
            array_push($rows, $row_item);
        }

  
        echo json_encode($row_item, JSON_PRETTY_PRINT);
        //file_put_contents('myfile.json', json_encode($rows));
    
        // 
		
	}


}

?> 