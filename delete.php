<?php
require_once '../includes/config.php';
require_once '../includes/auth.php';

if (!isLoggedIn()) {
    redirect('../users/login.php');
}

$task_id = $_GET['id'] ?? 0;
$user_id = $_SESSION['user_id'];

// Delete task
$stmt = $pdo->prepare("DELETE FROM tasks WHERE id = ? AND user_id = ?");
$stmt->execute([$task_id, $user_id]);

redirect('index.php');
?>