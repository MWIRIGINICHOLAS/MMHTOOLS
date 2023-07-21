<?php
// open database
$servername = "localhost";
$username = "root";
$password = "";
$database = "mmhtools";

$connection = new mysqli($servername, $username, $password, $database);

// Check for connection errors
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

?>
