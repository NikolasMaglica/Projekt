<?php

include "dbConn.php"; 

$id = $_GET['id']; 

$del = mysqli_query($db,"delete from rezervacije_sisanje where id = '$id'"); 

if($del)
{
    mysqli_close($db); 
    header("location:dashboard.php"); 
    exit;	
}
else
{
    echo "Error deleting record"; 
}
?>