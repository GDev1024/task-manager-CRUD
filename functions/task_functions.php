<?php
// Fetch all tasks (with optional search/filter)
function getTasks($conn, $search='', $filter='all') {
    $sql = "SELECT * FROM tasks WHERE 1";
    $params = [];
    $types = '';

    if ($search) {
        $sql .= " AND title LIKE ?";
        $params[] = "%$search%";
        $types .= 's';
    }
    if ($filter != 'all') {
        $sql .= " AND status=?";
        $params[] = $filter;
        $types .= 's';
    }
    $sql .= " ORDER BY id DESC";

    $stmt = $conn->prepare($sql);
    if(!empty($params)) $stmt->bind_param($types, ...$params);
    $stmt->execute();
    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}

// Get single task
function getTask($conn, $id) {
    $stmt = $conn->prepare("SELECT * FROM tasks WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
}

// Create task
function createTask($conn, $title, $due_date, $status='pending') {
    $stmt = $conn->prepare("INSERT INTO tasks (title, due_date, status) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $title, $due_date, $status);
    $stmt->execute();
}

// Update task
function updateTask($conn, $id, $title, $status, $due_date) {
    $stmt = $conn->prepare("UPDATE tasks SET title=?, status=?, due_date=? WHERE id=?");
    $stmt->bind_param("sssi", $title, $status, $due_date, $id);
    $stmt->execute();
}

// Delete task
function deleteTask($conn, $id) {
    $stmt = $conn->prepare("DELETE FROM tasks WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
}
?>
