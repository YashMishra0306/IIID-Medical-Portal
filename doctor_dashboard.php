<?php
include 'session_check.php';

if ($_SESSION['role'] !== 'Doctor') {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Doctor Dashboard</title>
    <style>
        body { font-family: Arial; background: #f2f6fc; }
        .container { width: 70%; margin: auto; margin-top: 50px; background: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        h2 { color: #2c3e50; margin-bottom: 20px; }
        a.button {
            display: inline-block;
            padding: 12px 20px;
            background: #27ae60;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            margin-right: 15px;
        }
        a.button:hover { background: #219150; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Welcome, Doctor</h2>
        <a href="issue_certificate.php" class="button">Issue Medical Certificate</a>
        <a href="view_visited_students.php" class="button">View Visited Students</a>
        <a href="logout.php" class="button" style="background:#e74c3c;">Logout</a>
    </div>
</body>
</html>
