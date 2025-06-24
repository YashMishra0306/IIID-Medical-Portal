<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit();
}
include '../db_connection.php';

$sql = "SELECT E.ExamID, E.ExamName, E.CourseCode, T.Count, T.Status
        FROM Tracks T
        JOIN Exam E ON T.ExamID = E.ExamID";

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Query 5 - Tracked Exams due to Medical Certificates</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; background: #f4f4f4; }
        h2 { text-align: center; color: #333; }
        table { border-collapse: collapse; width: 90%; margin: 30px auto; }
        th, td { border: 1px solid #ccc; padding: 10px; text-align: center; }
        th { background-color: #007bff; color: white; }
        tr:nth-child(even) { background-color: #e9f2ff; }
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

<h2>Tracked Exams due to Medical Certificates</h2>

<table>
    <tr>
        <th>Exam ID</th>
        <th>Exam Name</th>
        <th>Course Code</th>
        <th>Count</th>
        <th>Status</th>
    </tr>

    <?php
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                    <td>{$row['ExamID']}</td>
                    <td>{$row['ExamName']}</td>
                    <td>{$row['CourseCode']}</td>
                    <td>{$row['Count']}</td>
                    <td>{$row['Status']}</td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='5'>No tracked exams found.</td></tr>";
    }
    ?>

</table>

<a class="back" href="../queries.php">← Back to Queries</a>

</body>
</html>
