<?php
include "functions/db.php";
include "functions/task_functions.php";

$id = $_GET['id'];
deleteTask($conn, $id);

header("Location: index.php");
exit();
?>
