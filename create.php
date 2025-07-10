<?php
require_once 'includes/config.php';
require_once 'includes/auth.php';

if (!isLoggedIn()) {
    redirect('login.php');
}

$errors = [];
$title = $description = '';
$priority = 'Medium';
$due_date = '';
$status = 'To-Do';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);
    $priority = $_POST['priority'];
    $due_date = $_POST['due_date'];
    $status = $_POST['status'];

    if (empty($title)) $errors[] = 'Title is required';

    if (empty($errors)) {
        $stmt = $pdo->prepare("INSERT INTO tasks (user_id, title, description, priority, due_date, status) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([
            $_SESSION['user_id'],
            $title,
            $description,
            $priority,
            $due_date ?: null,
            $status
        ]);
        
        redirect('index.php');
    }
}

require_once 'header.php';
?>
<html>
    <head><link rel="stylesheet" href="assets/css/style.css">
</head>
<div class="form-container">
    <h2>Create New Task</h2>
    
    <?php if (!empty($errors)): ?>
        <div class="alert alert-danger">
            <?php foreach ($errors as $error): ?>
                <p><?= $error ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <form method="post">
        <div class="form-group">
            <label for="title">Title*</label>
            <input type="text" id="title" name="title" class="form-control" 
                   value="<?= htmlspecialchars($title) ?>" required>
        </div>
        
        <div class="form-group">
            <label for="description">Description</label>
            <textarea id="description" name="description" class="form-control" 
                      rows="4"><?= htmlspecialchars($description) ?></textarea>
        </div>
        
        <div class="form-group">
            <label for="priority">Priority</label>
            <select id="priority" name="priority" class="form-control">
                <option value="Low" <?= $priority === 'Low' ? 'selected' : '' ?>>Low</option>
                <option value="Medium" <?= $priority === 'Medium' ? 'selected' : '' ?>>Medium</option>
                <option value="High" <?= $priority === 'High' ? 'selected' : '' ?>>High</option>
            </select>
        </div>
        
        <div class="form-group">
            <label for="due_date">Due Date</label>
            <input type="date" id="due_date" name="due_date" class="form-control" 
                   value="<?= htmlspecialchars($due_date) ?>">
        </div>
        
        <div class="form-group">
            <label for="status">Status</label>
            <select id="status" name="status" class="form-control">
                <option value="To-Do" <?= $status === 'To-Do' ? 'selected' : '' ?>>To-Do</option>
                <option value="In Progress" <?= $status === 'In Progress' ? 'selected' : '' ?>>In Progress</option>
                <option value="Completed" <?= $status === 'Completed' ? 'selected' : '' ?>>Completed</option>
                <option value="Blocked" <?= $status === 'Blocked' ? 'selected' : '' ?>>Blocked</option>
            </select>
        </div>
        
        <div class="form-group" style="display: flex; gap: 1rem;">
            <button type="submit" class="btn">Create Task</button>
            <a href="index.php" class="btn btn-outline">Cancel</a>
        </div>
    </form>
</div>
</html>
<?php require_once 'footer.php'; ?>