<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit();
}
include '../db_connection.php';

$sql = "SELECT DISTINCT S.StudentID, S.Name
        FROM VisitedBy V
        JOIN Student S ON V.StudentID = S.StudentID";

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Query 7 - Students Who Visited a Doctor</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; background-color: #f4f4f4; }
        h2 { text-align: center; color: #2c3e50; }
        table { width: 80%; margin: 30px auto; border-collapse: collapse; }
        th, td { padding: 12px; border: 1px solid #ccc; text-align: center; }
        th { background-color: #007bff; color: white; }
        tr:nth-child(even) { background-color: #e6f0ff; }
        a.back {
            display: block;
            width: 200px;
            margin: 20px auto;
            text-align: center;
            background: #007bff;
            color: white;
            padding: 10px;
            border-radius: 6px;
            text-decoration: none;
        }
        a.back:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<h2>Students Who Have Visited a Doctor</h2>

<table>
    <tr>
        <th>Student ID</th>
        <th>Name</th>
    </tr>

    <?php
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                    <td>{$row['StudentID']}</td>
                    <td>{$row['Name']}</td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='2'>No records found.</td></tr>";
    }
    ?>

</table>

<a class="back" href="../queries.php">← Back to Queries</a>

</body>
</html>
