<?php
$servername = "localhost";
$username = "root";
$password = ""; // your MySQL password
$dbname = "task_manager"; // database name

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
