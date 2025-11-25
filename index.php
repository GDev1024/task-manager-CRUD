<?php
include 'functions/db.php';
include 'functions/header.php';

$result = $conn->query("SELECT * FROM tasks ORDER BY id DESC");
?>

<a href="create.php" class="btn">Add New Task</a>

<table border="1" cellpadding="10" cellspacing="0">
    <tr>
        <th>ID</th>
        <th>Task</th>
        <th>Status</th>
        <th>Created</th>
        <th>Actions</th>
    </tr>

    <?php while ($row = $result->fetch_assoc()): ?>
    <tr>
        <td><?= $row['id']; ?></td>
        <td><?= $row['task']; ?></td>
        <td><?= ucfirst($row['status']); ?></td>
        <td><?= $row['created_at']; ?></td>
        <td>
            <a href="update.php?id=<?= $row['id']; ?>">Edit</a> |
            <a href="delete.php?id=<?= $row['id']; ?>" onclick="return confirm('Delete this task?');">
                Delete
            </a>
        </td>
    </tr>
    <?php endwhile; ?>
</table>

<?php include 'functions/footer.php'; ?>
