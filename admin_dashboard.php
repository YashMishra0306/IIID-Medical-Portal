<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// This safely starts session if not already started and redirects to login if not logged in
include 'session_check.php';

// Now do a role-specific check:
if (strtolower($_SESSION['role']) !== 'admin') {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <style>
        /* Your styling here - unchanged */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(to right, #dfe9f3, #ffffff);
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 900px;
            margin: 60px auto;
            background: #ffffff;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #2c3e50;
            margin-bottom: 30px;
        }

        .button-group {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 20px;
            justify-items: center;
        }

        a.button {
            display: block;
            width: 100%;
            text-align: center;
            padding: 15px 20px;
            background: #2980b9;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-size: 16px;
            transition: all 0.3s ease-in-out;
        }

        a.button:hover {
            background: #216a94;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        a.logout-button {
            background: #e74c3c;
        }

        a.logout-button:hover {
            background: #c0392b;
        }

        @media (max-width: 600px) {
            .container {
                margin: 30px 20px;
                padding: 25px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Welcome, Admin</h2>
        <div class="button-group">
            <a href="run_queries.php" class="button">Run SQL Queries</a>
            <a href="view_students.php" class="button">View All Students</a>
            <a href="view_doctors.php" class="button">View All Doctors</a>
            <a href="approve_certificate.php" class="button">Approve Certificates</a>
            <a href="view_medical_records.php" class="button">View Medical Records</a>
            <a href="manage_accounts.php" class="button">Manage Accounts</a>
            <a href="logout.php" class="button logout-button">Logout</a>
        </div>
    </div>
</body>
</html>
