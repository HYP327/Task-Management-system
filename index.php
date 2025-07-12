<?php
require_once 'includes/config.php';
require_once 'includes/auth.php';

if (!isLoggedIn()) {
    redirect('login.php');
}

$user_id = $_SESSION['user_id'];
$filter = isset($_GET['filter']) ? $_GET['filter'] : 'all';

// Build query based on filter
$query = "SELECT * FROM tasks WHERE user_id = ?";
$params = [$user_id];

switch ($filter) {
    case 'completed':
        $query .= " AND status = 'Completed'";
        break;
    case 'pending':
        $query .= " AND status != 'Completed'";
        break;
    // 'all' shows all tasks
}

$query .= " ORDER BY due_date ASC, priority DESC";
$stmt = $pdo->prepare($query);
$stmt->execute($params);
$tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Tasks</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="container">
        <h2>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?></h2>
        <a href="create.php" class="btn">Add New Task</a>
        <a href="logout.php" class="btn">Logout</a>
        
        <div class="filter">
            <a href="?filter=all" class="<?php echo $filter === 'all' ? 'active' : ''; ?>">All</a>
            <a href="?filter=completed" class="<?php echo $filter === 'completed' ? 'active' : ''; ?>">Completed</a>
            <a href="?filter=pending" class="<?php echo $filter === 'pending' ? 'active' : ''; ?>">Pending</a>
        </div>
        
        <div class="tasks">
            <?php if (empty($tasks)): ?>
                <p>No tasks found.</p>
            <?php else: ?>
                <?php foreach ($tasks as $task): ?>
                    <div class="task-filters">
    <a href="?filter=all" class="<?= $filter === 'all' ? 'active' : '' ?>">All Tasks</a>
    <a href="?filter=completed" class="<?= $filter === 'completed' ? 'active' : '' ?>">Completed</a>
    <a href="?filter=pending" class="<?= $filter === 'pending' ? 'active' : '' ?>">Pending</a>
</div>

<a href="create.php" class="btn">Add New Task</a>

<?php foreach ($tasks as $task): ?>
    <div class="task-card">
        <h3><?= htmlspecialchars($task['title']) ?></h3>
        <div class="task-meta">
            <span class="priority-<?= strtolower($task['priority']) ?>">
                <i class="fas fa-flag"></i> <?= $task['priority'] ?>
            </span>
            <?php if ($task['due_date']): ?>
                <span><i class="far fa-calendar-alt"></i> <?= date('M d, Y', strtotime($task['due_date'])) ?></span>
            <?php endif; ?>
            <span class="status-badge status-<?= strtolower(str_replace(' ', '-', $task['status'])) ?>">
                <?= $task['status'] ?>
            </span>
        </div>
        <p><?= htmlspecialchars($task['description']) ?></p>
        <div class="task-actions">
            <a href="edit.php?id=<?= $task['id'] ?>" class="btn btn-outline">Edit</a>
            <a href="delete.php?id=<?= $task['id'] ?>" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
        </div>
    </div>
<?php endforeach; ?>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>