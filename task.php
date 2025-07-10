<?php
require_once 'includes/config.php';
require_once 'includes/auth.php';

if (!isLoggedIn()) {
    redirect('login.php');
}

// Get all tasks for the current user
$stmt = $pdo->prepare("SELECT * FROM tasks WHERE user_id = ? ORDER BY due_date, priority DESC");
$stmt->execute([$_SESSION['user_id']]);
$tasks = $stmt->fetchAll();

// Filter tasks if requested
$filter = $_GET['filter'] ?? 'all';
if ($filter === 'completed') {
    $tasks = array_filter($tasks, fn($task) => $task['status'] === 'Completed');
} elseif ($filter === 'pending') {
    $tasks = array_filter($tasks, fn($task) => $task['status'] !== 'Completed');
}

require_once 'header.php';
?>
<html>
 <link rel="stylesheet" href="assets/css/style.css">
<h2>My Tasks</h2>

<div class="task-filters">
    <a href="?filter=all" class="<?= $filter === 'all' ? 'active' : '' ?>">All Tasks</a>
    <a href="?filter=completed" class="<?= $filter === 'completed' ? 'active' : '' ?>">Completed</a>
    <a href="?filter=pending" class="<?= $filter === 'pending' ? 'active' : '' ?>">Pending</a>
</div>

<a href="create.php" class="btn">Add New Task</a>

<table>
    <thead>
        <tr>
            <th>Title</th>
            <th>Description</th>
            <th>Priority</th>
            <th>Due Date</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($tasks as $task): ?>
            <tr>
                <td><?= htmlspecialchars($task['title']) ?></td>
                <td><?= htmlspecialchars($task['description']) ?></td>
                <td><?= $task['priority'] ?></td>
                <td><?= $task['due_date'] ? date('M d, Y', strtotime($task['due_date'])) : 'None' ?></td>
                <td><?= $task['status'] ?></td>
                <td>
                    <a href="edit.php?id=<?= $task['id'] ?>">Edit</a>
                    <a href="delete.php?id=<?= $task['id'] ?>" onclick="return confirm('Are you sure?')">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
        <?php if (empty($tasks)): ?>
            <tr>
                <td colspan="6">No tasks found. <a href="create.php">Create one now</a></td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>
</html>

<?php require_once 'footer.php'; ?>