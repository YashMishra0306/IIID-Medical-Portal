<?php
include 'session_check.php';

if (strtolower($_SESSION['role']) !== 'admin') {
    header("Location: login.php");
    exit();
}

include 'db_connection.php';

$sql = "SELECT * FROM Student ORDER BY StudentID";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>All Students</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #eef6fb;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 95%;
            margin: 50px auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        h2 {
            text-align: center;
            color: #2c3e50;
            margin-bottom: 25px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 15px;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 12px 15px;
            text-align: left;
        }
        th {
            background-color: #3498db;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f0f9ff;
        }
        a.back-link {
            display: inline-block;
            margin-top: 20px;
            color: #3498db;
            text-decoration: none;
        }
        a.back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>All Registered Students</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Department</th>
            <th>Phone</th>
            <th>Semester</th>
            <th>Email</th>
            <th>Gender</th>
        </tr>
        <?php
        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>
                        <td>{$row['StudentID']}</td>
                        <td>{$row['Name']}</td>
                        <td>{$row['Department']}</td>
                        <td>{$row['Phone']}</td>
                        <td>{$row['Semester']}</td>
                        <td>{$row['Email']}</td>
                        <td>{$row['Gender']}</td>
                    </tr>";
            }
        } else {
            echo "<tr><td colspan='7'>No students found.</td></tr>";
        }
        ?>
    </table>
    <a href='admin_dashboard.php' class='back-link'>&larr; Back to Dashboard</a>
</div>
</body>
</html>
