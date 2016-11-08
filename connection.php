<?php

$servername = "localhost";
$username = "root";
$dbPassword = "";
$database = "registered_users";

$conn = new mysqli($servername, $username, $dbPassword, $database);
if ($conn->connect_error) {
	die("Connection failed: ".$conn->connect_error);
}

?>