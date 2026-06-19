<?php

$host = "localhost";
$user = "root";
$password = "Nikoloza!12";
$database = "nikas_autoservice_db";

$conn = new mysqli($host, $user, $password, $database, 3306);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>