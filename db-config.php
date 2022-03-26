<?php
// error_reporting(E_ALL);
$con = mysqli_connect("localhost","root","","Registration"); // For Connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
    }
// echo "Connected successfully";
?>