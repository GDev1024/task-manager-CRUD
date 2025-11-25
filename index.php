<?php
session_start();
include 'functions/db.php';
include 'functions/task_functions.php';

// Session-based welcome animation
$showWelcome = false;
if (!isset($_SESSION['welcome_shown'])) {
    $_SESSION['welcome_shown'] = true;
    $showWelcome = true;
}

// Handle filter and search
$search = $_GET['search'] ?? '';
$filter = $_GET['filter'] ?? 'all';

$tasks = getTasks($conn, $search, $filter);

// Stats
$total = count($tasks);
$completed = count(array_filter($tasks, fn($t) => $t['status'] === 'completed'));
$pending = $total - $completed;

// Calendar tasks event initialization
$calendarEvents = array_map(function($task) {
    return [
        'title' => $task['title'],
        'start' => date('Y-m-d'), // for now, just show today
        'color' => $task['status'] === 'completed' ? '#5cb85c' : '#f0ad4e'
    ];
}, $tasks);

$calendarEventsJSON = json_encode($calendarEvents);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Task Manager</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- FullCalendar CSS -->
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.css" rel="stylesheet">
    <!-- FullCalendar JS -->
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.js"></script>

</head>
<body>
    <!-- Welcome animation -->
    <?php if($showWelcome): ?>
    <div id="welcome-animation">
        <h1>Welcome to Task Manager</h1>
    </div>
    <?php endif; ?>

    <div class="container">
        <h1>Task Manager</h1>

        <!-- Stats Widget -->
        <div class="stats">
            <div>Total Tasks: <?php echo $total; ?></div>
            <div>Completed: <?php echo $completed; ?></div>
            <div>Pending: <?php echo $pending; ?></div>
        </div>

        <!-- Calendar -->
        <div id="calendar"></div>
        


        <!-- Search & Filter -->
        <form method="GET" class="search-filter">
            <input type="text" name="search" placeholder="Search tasks..." value="<?php echo htmlspecialchars($search); ?>">
            <select name="filter">
                <option value="all" <?php if($filter==='all') echo 'selected'; ?>>All</option>
                <option value="pending" <?php if($filter==='pending') echo 'selected'; ?>>Pending</option>
                <option value="completed" <?php if($filter==='completed') echo 'selected'; ?>>Completed</option>
            </select>
            <button type="submit" class="btn">Filter</button>
            <a href="create.php" class="btn add">+ Add Task</a>
        </form>

        <!-- Task Cards -->
        <div class="task-list">
            <?php if(empty($tasks)): ?>
                <p class="no-tasks">No tasks found.</p>
            <?php else: ?>
                <?php foreach($tasks as $task): ?>
                <div class="task-card">
                    <h3 class="task-title"><?php echo htmlspecialchars($task['title']); ?></h3>
                    <div class="task-buttons">
                        <span class="status <?php echo $task['status']; ?>"><?php echo ucfirst($task['status']); ?></span>
                        <a href="edit.php?id=<?php echo $task['id']; ?>" class="btn edit">Edit</a>
                        <a href="delete.php?id=<?php echo $task['id']; ?>" class="btn delete">Delete</a>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>

<script src="assets/js/app.js"></script>
</body>
</html>
 