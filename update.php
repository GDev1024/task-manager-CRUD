<?php
include 'functions/db.php';
include 'functions/header.php';

$id = $_GET['id'];
$result = $conn->query("SELECT * FROM tasks WHERE id=$id");
$task = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $taskname = $_POST['task'];
    $status = $_POST['status'];

    $stmt = $conn->prepare("UPDATE tasks SET task=?, status=? WHERE id=?");
    $stmt->bind_param("ssi", $taskname, $status, $id);
    $stmt->execute();

    header("Location: index.php");
    exit();
}
?>

<h2>Edit Task</h2>

<form method="POST">
    <label>Task:</label><br>
    <input type="text" name="task" value="<?= $task['task']; ?>" required><br><br>

    <label>Status:</label><br>
    <select name="status">
        <option value="pending" <?= $task['status'] == 'pending' ? 'selected' : '' ?>>Pending</option>
        <option value="completed" <?= $task['status'] == 'completed' ? 'selected' : '' ?>>Completed</option>
    </select><br><br>

    <button type="submit">Update</button>
</form>

<?php include 'functions/footer.php'; ?>
