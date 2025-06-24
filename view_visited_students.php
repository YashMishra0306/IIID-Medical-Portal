<?php
include 'session_check.php';
include 'db_connection.php';

if ($_SESSION['role'] !== 'Doctor') {
    header("Location: login.php");
    exit();
}

$doctor_id = $_SESSION['user_id'];

$query = "
    SELECT DISTINCT S.StudentID, S.Name, S.Department
    FROM VisitedBy V
    JOIN Student S ON V.StudentID = S.StudentID
    WHERE V.DoctorID = '$doctor_id'
";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Visited Students</title>
    <style>
        body { font-family: Arial; background-color: #f2f6fc; }
        .container { width: 80%; margin: auto; margin-top: 40px; background: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 0 12px rgba(0,0,0,0.1); }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ccc; padding: 10px; text-align: left; }
        th { background-color: #2980b9; color: white; }
        h2 { color: #2c3e50; }
        a { text-decoration: none; color: #2980b9; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Students Visited</h2>
        <table>
            <tr>
                <th>Student ID</th>
                <th>Name</th>
                <th>Department</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?= $row['StudentID'] ?></td>
                    <td><?= $row['Name'] ?></td>
                    <td><?= $row['Department'] ?></td>
                </tr>
            <?php } ?>
        </table>
        <br>
        <a href="doctor_dashboard.php">← Back to Dashboard</a>
    </div>
</body>
</html>
