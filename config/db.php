<?php

$hostname = 'localhost'; // Replace with your database hostname
$username = 'root'; // Replace with your database username
$password = ''; // Replace with your database password
$dbname = 'php_tms_app';   // Replace with your database name

// Create a MySQLi instance
$conn = new mysqli($hostname, $username, $password, $dbname);

// Check for connection errors
if ($conn->connect_errno) {
    echo "Failed to connect to MySQL: " . $conn->connect_error;
    exit();
}
