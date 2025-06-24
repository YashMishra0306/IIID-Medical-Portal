<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit();
}
include '../db_connection.php';

$sql = "SELECT Department, COUNT(*) AS StudentCount
        FROM Student
        GROUP BY Department";

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Query 2 - Student Count by Department</title>
    <style>
        body { font-family: Arial; padding: 20px; background: #f0f8ff; }
        table { border-collapse: collapse; width: 60%; margin: auto; margin-top: 30px; }
        th, td { border: 1px solid #888; padding: 10px; text-align: center; }
        th { background-color: #28a745; color: white; }
        tr:nth-child(even) { background-color: #e6ffe6; }
        h2 { text-align: center; }
        a.back {
            display: block;
            width: 200px;
            margin: 30px auto;
            text-align: center;
            text-decoration: none;
            color: white;
            background: #28a745;
            padding: 10px;
            border-radius: 5px;
        }
        a.back:hover {
            background: #1e7e34;
        }
    </style>
</head>
<body>

<h2>Student Count by Department</h2>

<table>
    <tr>
        <th>Department</th>
        <th>Number of Students</th>
    </tr>

    <?php
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                    <td>{$row['Department']}</td>
                    <td>{$row['StudentCount']}</td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='2'>No records found</td></tr>";
    }
    ?>

</table>

<a class="back" href="../queries.php">← Back to Queries</a>

</body>
</html>
