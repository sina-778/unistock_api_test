<?php
$serverName = "TEST-MOBILE-APP"; 
sqlsrv_configure('WarningsReturnAsErrors',0);
$connectionInfo = array( "Database"=>"ZABDBUM", "UID"=>"sa", "PWD"=>"sql@s3rv3r");
$conn = sqlsrv_connect( $serverName, $connectionInfo);

if( $conn ) {
    // echo "Connection establish.";
}else{
     echo "Connection could not be established.";
     die( print_r( sqlsrv_errors(), true));
}

?>
