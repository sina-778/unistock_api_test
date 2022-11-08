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




function postmethod($data){


    include "index.php";
	
	$item=$data["item"];
    $xwh=$data["xwh"];
    $user_id=$data["user_id"];
    $qty=$data["qty"];
    $tag_no=$data["tag_no"];
    $admin_id=$data["admin_id"];
    $outlet=$data["outlet"];
    $store=$data["store"];

	$sql = 
	"BEGIN
    DECLARE @xcus varchar (50),
			@xdesc varchar (250),
			@xorg varchar (250)
    select  @xcus = xcus, @xdesc = xdesc, @xorg = xcusname from caitemapp where  xitem ='$item'

    IF EXISTS ( SELECT 1 FROM zebra WHERE item_code = '$item' )
    BEGIN
        UPDATE zebra 
        SET scan_qty=scan_qty + '$qty', auto_qty= auto_qty + '$qty', zuuserid = '$user_id', zutime = GETDATE()
        WHERE item_code = '$item';
    END
    ELSE
    BEGIN
        INSERT INTO zebra(zid, ztime, zauserid, tag_no, item_code,item_desc,scan_qty,adj_qty,auto_qty,manual_qty,xcus,xorg,device,empid,countingsetup_id,outlet,store, zactive)
        values( 100080, GETDATE(), '$user_id', '$tag_no', '$item', @xdesc, 1, 0, 1, 0,  @xcus , @xorg, '$device','$user_id', '$admin_id', '$outlet', '$store', 1 )
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