<?php

$con=new mysqli("localhost","root","","jobconnect");

if($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
    echo "unConnected unsuccessfully";

} else {
    echo "Connected successfully";
}

?>