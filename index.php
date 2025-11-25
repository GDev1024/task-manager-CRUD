<?php
session_start();
include 'functions/db.php';
include 'functions/task_functions.php';

// Welcome animation session
$showWelcome = false;
if (!isset($_SESSION['welcome_shown'])) {
    $_SESSION['welcome_shown'] = true;
    $showWelcome = true;
}

// Handle filter/search
$search = $_GET['search'] ?? '';
$filter = $_GET['filter'] ?? 'all';
$tasks = getTasks($conn, $search, $filter);

// Stats
$total = count($tasks);
$completed = count(array_filter($tasks, fn($t) => $t['status']==='completed'));
$pending = $total - $completed;

// Calendar events
$calendarEvents = array_map(fn($task)=>[
    'title'=>$task['title'],
    'start'=>$task['due_date'],
    'color'=>$task['status']==='completed'?'#5cb85c':'#f0ad4e'
], $tasks);
$calendarEventsJSON = json_encode($calendarEvents);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Task Manager</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.js"></script>
</head>
<body>
<?php if($showWelcome): ?>
<div id="welcome-animation">
    <h1>Welcome to Task Manager</h1>
</div>
<?php endif; ?>

<div class="container">
    <h1>Task Manager</h1>

    <!-- Stats -->
    <div class="stats">
        <div>Total Tasks: <?= $total ?></div>
        <div>Completed: <?= $completed ?></div>
        <div>Pending: <?= $pending ?></div>
    </div>

    <!-- Search/Filter -->
    <form method="GET" class="search-filter">
        <input type="text" name="search" placeholder="Search tasks..." value="<?= htmlspecialchars($search) ?>">
        <select name="filter">
            <option value="all" <?= $filter==='all'?'selected':'' ?>>All</option>
            <option value="pending" <?= $filter==='pending'?'selected':'' ?>>Pending</option>
            <option value="completed" <?= $filter==='completed'?'selected':'' ?>>Completed</option>
        </select>
        <button type="submit" class="btn">Filter</button>
        <a href="create.php" class="btn add">+ Add Task</a>
    </form>

    <!-- Task cards -->
    <div class="task-list">
        <?php if(empty($tasks)): ?>
            <p class="no-tasks">No tasks found.</p>
        <?php else: ?>
            <?php foreach($tasks as $task): ?>
            <div class="task-card">
                <h3 class="task-title"><?= htmlspecialchars($task['title']) ?></h3>
                <p>Due: <?= $task['due_date'] ?></p>
                <div class="task-buttons">
                    <span class="status <?= $task['status'] ?>"><?= ucfirst($task['status']) ?></span>
                    <a href="edit.php?id=<?= $task['id'] ?>" class="btn edit">Edit</a>
                    <a href="delete.php?id=<?= $task['id'] ?>" class="btn delete" onclick="return confirm('Delete this task?');">Delete</a>
                </div>
            </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

    <!-- Calendar -->
    <div id="calendar"></div>
</div>

<script>
window.calendarEvents = <?= $calendarEventsJSON ?>;
</script>
<script src="assets/js/app.js"></script>
</body>
</html>
