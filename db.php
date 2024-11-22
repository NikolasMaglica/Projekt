<?php

    $con = mysqli_connect("localhost","root","Nikola.123","nova");


    // Check connection
    if (mysqli_connect_errno()){
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
?>
