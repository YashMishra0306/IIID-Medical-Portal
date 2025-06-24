<?php
include 'session_check.php';
include 'db_connection.php';

if ($_SESSION['role'] !== 'Student') {
    header("Location: login.php");
    exit();
}

$student_id = $_SESSION['user_id'];

$query = "
    SELECT E.ExamID, E.ExamName, E.CourseCode, T.Status
    FROM Tracks T
    JOIN Exam E ON T.ExamID = E.ExamID
    JOIN MedicalCertificate MC ON T.CertificateID = MC.CertificateID
    WHERE MC.Student_ID = '$student_id'
";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Missed Exams</title>
    <style>
        body { font-family: Arial; background-color: #f2f6fc; }
        .container { width: 80%; margin: auto; margin-top: 40px; background: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 0 12px rgba(0,0,0,0.1); }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ccc; padding: 10px; text-align: left; }
        th { background-color: #27ae60; color: white; }
        h2 { color: #2c3e50; }
        a { text-decoration: none; color: #2980b9; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Exams Missed Due to Medical Reasons</h2>
        <table>
            <tr>
                <th>Exam ID</th>
                <th>Exam Name</th>
                <th>Course Code</th>
                <th>Status</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?= $row['ExamID'] ?></td>
                    <td><?= $row['ExamName'] ?></td>
                    <td><?= $row['CourseCode'] ?></td>
                    <td><?= $row['Status'] ?></td>
                </tr>
            <?php } ?>
        </table>
        <br>
        <a href="student_dashboard.php">← Back to Dashboard</a>
    </div>
</body>
</html>
