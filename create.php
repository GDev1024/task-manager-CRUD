<?php
include 'functions/db.php';
include 'functions/header.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $task = $_POST['task'];

    $stmt = $conn->prepare("INSERT INTO tasks (task) VALUES (?)");
    $stmt->bind_param("s", $task);
    $stmt->execute();

    header("Location: index.php");
    exit();
}
?>

<h2>Add New Task</h2>

<form method="POST">
    <label>Task:</label><br>
    <input type="text" name="task" required><br><br>
    <button type="submit">Save</button>
</form>

<?php include 'functions/footer.php'; ?>
