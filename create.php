<?php 
include "functions/db.php";
include "functions/task_functions.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $due_date = $_POST['due_date'];
    $status = 'pending'; // always pending on creation
    createTask($conn, $title, $due_date, $status);
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

    <form method="POST">
        <input type="text" name="title" placeholder="Task title..." required>
        <label>Due Date:</label>
        <input type="date" name="due_date" required>
        <button type="submit" class="btn btn-add">Save Task</button>
    </form>

    <a href="index.php" class="btn btn-edit" style="margin-top:15px;">Back to Tasks</a>
</div>
</body>
</html>
