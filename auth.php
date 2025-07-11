<?php
require_once 'config.php';

if (!isLoggedIn()) {
    redirect('login.php');
}

// Optional: Role-based access control
function isAdmin() {
    return isset($_SESSION['role']) && $_SESSION['role'] === 'Admin';
}

function isManager() {
    return isset($_SESSION['role']) && ($_SESSION['role'] === 'Manager' || $_SESSION['role'] === 'Admin');
}

function getCurrentUser() {
    global $pdo;
    
    if (!isset($_SESSION['user_id'])) {
        return null;
    }
    
    $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->execute([$_SESSION['user_id']]);
    return $stmt->fetch();
}
?>