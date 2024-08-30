<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbName = "sale invoice";

// Create connection
$con = mysqli_connect($servername, $username, $password, $dbName);


// Check connection
if ($con->connect_error) {
  die("Connection failed: " . $con->connect_error);
}
