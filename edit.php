<?php
include "functions/db.php";
include "functions/task_functions.php";

$id = $_GET['id'];
$task = getTask($conn, $id);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $status = $_POST['status'];
    updateTask($conn, $id, $title, $status);
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Edit Task</title>
</head>
<body>
<div class="container">
    <h1>Edit Task</h1>

    <form method="POST" class="task-form">
        <input type="text" name="title" value="<?= htmlspecialchars($task['title']) ?>" required>
        <select name="status">
            <option value="pending" <?= $task['status']=='pending'?'selected':'' ?>>Pending</option>
            <option value="completed" <?= $task['status']=='completed'?'selected':'' ?>>Completed</option>
        </select>
        <button type="submit" class="btn edit">Update Task</button>
    </form>

    <a href="index.php" class="btn add">Back to Tasks</a>
</div>
</body>
</html>
