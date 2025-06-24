<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit();
}
include '../db_connection.php';

$sql = "SELECT MC.Student_ID, S.Name, COUNT(T.ExamID) AS MissedExams
        FROM MedicalCertificate MC
        JOIN Tracks T ON MC.CertificateID = T.CertificateID
        JOIN Student S ON MC.Student_ID = S.StudentID
        GROUP BY MC.Student_ID
        HAVING COUNT(T.ExamID) > 2";

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Query 6 - Students Who Missed > 2 Exams</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; background: #f9f9f9; }
        h2 { text-align: center; color: #2c3e50; }
        table { border-collapse: collapse; width: 90%; margin: 30px auto; }
        th, td { border: 1px solid #ccc; padding: 10px; text-align: center; }
        th { background-color: #28a745; color: white; }
        tr:nth-child(even) { background-color: #eaffea; }
        a.back {
            display: block;
            width: 200px;
            margin: 20px auto;
            text-align: center;
            background: #28a745;
            color: white;
            padding: 10px;
            border-radius: 6px;
            text-decoration: none;
        }
        a.back:hover {
            background-color: #1e7e34;
        }
    </style>
</head>
<body>

<h2>Students Who Missed More Than 2 Exams Due to Medical Reasons</h2>

<table>
    <tr>
        <th>Student ID</th>
        <th>Name</th>
        <th>Missed Exams</th>
    </tr>

    <?php
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                    <td>{$row['Student_ID']}</td>
                    <td>{$row['Name']}</td>
                    <td>{$row['MissedExams']}</td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='3'>No students found.</td></tr>";
    }
    ?>

</table>

<a class="back" href="../queries.php">← Back to Queries</a>

</body>
</html>
