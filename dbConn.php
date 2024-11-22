<?php

$db = mysqli_connect("localhost","root","Nikola.123","nova");

if(!$db)
{
    die("Connection failed: " . mysqli_connect_error());
}

?>
