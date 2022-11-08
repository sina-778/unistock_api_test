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
    $xwh=$data["xwh"];
    $prep_id=$data["prep_id"];
  

	$sql = 
	"BEGIN
    DECLARE @xcus varchar (50)
    select @xcus = xcus from caitemapp where  xitem ='$item'

    IF EXISTS (SELECT 1 FROM imstockcountapp WHERE xitem = '$item')
    BEGIN
        UPDATE imstockcountapp 
        SET xcount=xcount + 1, xpreparer='$prep_id', lastqty = 1
        WHERE xitem = '$item';
    END
    ELSE
    BEGIN
        INSERT INTO imstockcountapp(xcountingdate,xdatecreate,xpreparer,xitem,xcus,xcount,xwh,lastqty)
        values( GETDATE(), GETDATE(), '$prep_id',  '$item', @xcus , 1,'$xwh', 1 )
    END
    END";


    
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

?> 