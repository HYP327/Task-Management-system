<?php
require 'db.php';

// Get all tasks for a user
function getUserTasks($user_id, $filter = 'all') {
    global $pdo;
    
    $sql = "SELECT * FROM tasks WHERE user_id = ?";
    
    switch ($filter) {
        case 'completed':
            $sql .= " AND status = 'Completed'";
            break;
        case 'pending':
            $sql .= " AND status != 'Completed'";
            break;
    }
    
    $sql .= " ORDER BY due_date ASC, priority DESC";
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$user_id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Add a new task
function addTask($user_id, $title, $description, $priority = 'Medium', $due_date = null, $status = 'To-Do') {
    global $pdo;
    
    $stmt = $pdo->prepare("INSERT INTO tasks (user_id, title, description, priority, due_date, status) VALUES (?, ?, ?, ?, ?, ?)");
    return $stmt->execute([$user_id, $title, $description, $priority, $due_date, $status]);
}

// Update a task
function updateTask($task_id, $title, $description, $priority, $due_date, $status) {
    global $pdo;
    
    $stmt = $pdo->prepare("UPDATE tasks SET title = ?, description = ?, priority = ?, due_date = ?, status = ? WHERE id = ?");
    return $stmt->execute([$title, $description, $priority, $due_date, $status, $task_id]);
}

// Delete a task
function deleteTask($task_id) {
    global $pdo;
    
    $stmt = $pdo->prepare("DELETE FROM tasks WHERE id = ?");
    return $stmt->execute([$task_id]);
}

// Get task by ID
function getTaskById($task_id) {
    global $pdo;
    
    $stmt = $pdo->prepare("SELECT * FROM tasks WHERE id = ?");
    $stmt->execute([$task_id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}