<?php
include 'db_connection.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['user_id']) && strtolower($_SESSION['role']) === 'admin') {
    $userId = intval($_POST['user_id']);

    // Prevent deletion of own admin account (optional)
    if ($_SESSION['user_id'] == $userId) {
        echo "You cannot delete your own account.";
        exit();
    }

    $sql = "DELETE FROM users WHERE id = $userId";

    if ($conn->query($sql) === TRUE) {
        header("Location: manage_accounts.php");
        exit();
    } else {
        echo "Error deleting user: " . $conn->error;
    }
} else {
    header("Location: login.php");
    exit();
}
?>
