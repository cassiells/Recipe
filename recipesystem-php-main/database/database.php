<?php

$host = "localhost";
$username = "root";
$password = "";
$database = "recipes_system";


$conn = new mysqli($host, $username, $password, $database);


if ($conn->connect_error) {
    die("Database connection unsuccessful: " .$conn->connect_error);
} else {
   
}

?>