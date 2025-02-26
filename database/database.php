<?php
// Replace with your database credentials
$servername = "localhost";
$username = "root"; // default username for XAMPP
$password = ""; // default password for XAMPP (no password)
$dbname = "recipe_system"; // make sure the database name matches your actual database

// Create a new MySQLi connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
