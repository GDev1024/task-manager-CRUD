<?php
include "functions/db.php";
include "functions/task_functions.php";

$tasks = getTasks($conn);

$search = $_GET['search'] ?? '';
$filter = $_GET['filter'] ?? 'all';

if ($search || $filter != 'all') {
    $tasks = searchTasks($conn, $search, $filter);
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Task Manager</title>
</head>
<body>

<!-- Welcome Overlay -->
<div id="welcome">
    <h1>Welcome to Task Manager</h1>
</div>

<!-- Main Content -->
<div id="main-content" style="display:none;">
    <div class="container">
        <h1>Task Manager</h1>

        <!-- Search & Filter -->
        <div class="search-bar">
            <form method="GET">
                <input type="text" name="search" placeholder="Search tasks..." value="<?= htmlspecialchars($search) ?>">
                <select name="filter">
                    <option value="all" <?= $filter=='all'?'selected':'' ?>>All</option>
                    <option value="pending" <?= $filter=='pending'?'selected':'' ?>>Pending</option>
                    <option value="completed" <?= $filter=='completed'?'selected':'' ?>>Completed</option>
                </select>
                <button type="submit" class="btn btn-add">Filter</button>
            </form>
        </div>

        <!-- Add Task -->
        <a href="create.php" class="btn btn-add">+ Add Task</a>

        <!-- Task Cards -->
        <?php if (!empty($tasks)): ?>
            <?php foreach($tasks as $task): ?>
                <div class="task-card">
                    <div class="task-title"><?= htmlspecialchars($task['title']) ?></div>
                    <div>
                        <span class="badge <?= $task['status'] ?>"><?= ucfirst($task['status']) ?></span>
                        <a href="edit.php?id=<?= $task['id'] ?>" class="btn btn-edit">Edit</a>
                        <a href="delete.php?id=<?= $task['id'] ?>" class="btn btn-delete" onclick="return confirm('Delete this task?');">Delete</a>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No tasks found.</p>
        <?php endif; ?>
    </div>
</div>

<script src="assets/js/app.js"></script>
</body>
</html>
