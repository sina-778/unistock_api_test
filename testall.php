<?php
$serverName = "TEST-MOBILE-APP"; 
sqlsrv_configure('WarningsReturnAsErrors',0);
$connectionInfo = array( "Database"=>"ZABDBUM", "UID"=>"sa", "PWD"=>"sql@s3rv3r");
$conn = sqlsrv_connect( $serverName, $connectionInfo);

if ($conn)
    {
    $sql_q = "allproduct ";  
    $query = sqlsrv_query(
        $conn, 
        $sql_q, 
       
    );
    if ($query)
        {
        if (sqlsrv_has_rows($query))
            {
            while ($result= sqlsrv_fetch_array($query))
                {
                // ...
                }
            }
        else
            { die(var_dump(sqlsrv_num_rows($query))); }
        }
    else
        { die("query".$sql_q.'<br>'.print_r( sqlsrv_errors(), true)); }
    }
else
    { die ("Connection défectueuse."); } 
?>