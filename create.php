<?php 
include "functions/db.php";
include "functions/task_functions.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $status = $_POST['status'];
    createTask($conn, $title, $status);
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Add Task</title>
</head>
<body>
<div class="container">
    <h1>Add New Task</h1>

    <form method="POST" class="task-form">
        <input type="text" name="title" placeholder="Task title..." required>
        <select name="status">
            <option value="pending">Pending</option>
            <option value="completed">Completed</option>
        </select>
        <button type="submit" class="btn add">Save Task</button>
    </form>

    <a href="index.php" class="btn edit">Back to Tasks</a>
</div>
</body>
</html>
