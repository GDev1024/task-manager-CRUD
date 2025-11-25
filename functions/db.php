<?php
$servername = "sql311.infinityfree.com";
$username = "if0_40511477";
$password = "BenBen1738";
$dbname = "if0_40511477_task_manager_crud";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
