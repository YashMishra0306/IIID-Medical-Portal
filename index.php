<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
// session_start(); // ✅ MUST be before using $_SESSION

include('db_connection.php');

if (isset($_SESSION['role'])) {
    switch ($_SESSION['role']) {
        case 'admin':
            header('Location: admin_dashboard.php');
            break;
        case 'doctor':
            header('Location: doctor_dashboard.php');
            break;
        case 'student':
            header('Location: student_dashboard.php');
            break;
    }
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IIIT Medical Portal</title>
    <link rel="stylesheet" href="styles.css"> <!-- Optional CSS -->
    <style>
        /* Basic fallback styles in case styles.css is empty */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f6f9;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #2c3e50;
            color: white;
            padding: 10px 0;
        }

        nav ul {
            list-style: none;
            display: flex;
            justify-content: center;
            gap: 20px;
            padding: 0;
            margin: 0;
        }

        nav ul li a {
            color: white;
            text-decoration: none;
            font-weight: bold;
        }

        main {
            text-align: center;
            padding: 50px;
        }

        .button {
            display: inline-block;
            margin-top: 20px;
            padding: 12px 20px;
            background-color: #2980b9;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }

        footer {
            text-align: center;
            background-color: #ecf0f1;
            padding: 15px;
            margin-top: 40px;
        }
    </style>
</head>
<body>

    <!-- Header Section -->
    <header>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="login.php">Login</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="contact.php">Contact</a></li>
            </ul>
        </nav>
    </header>

    <!-- Main Section -->
    <main>
        <h1>Welcome to IIIT Medical Portal</h1>
        <p>This portal helps you manage medical certificates, track exams, and interact with the medical department.</p>
        <p>Please log in to access your dashboard and related services.</p>
        <a href="login.php" class="button">Login</a>
    </main>

    <!-- Footer Section -->
    <footer>
        <p>&copy; 2025 IIIT Medical Portal. All rights reserved.</p>
    </footer>

</body>
</html>
