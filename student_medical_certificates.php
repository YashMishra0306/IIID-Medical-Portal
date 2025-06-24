<?php
include 'session_check.php';
include 'db_connection.php';

if ($_SESSION['role'] !== 'Student') {
    header("Location: login.php");
    exit();
}

$student_id = $_SESSION['user_id'];

$query = "
    SELECT MC.CertificateID, MC.Reason, MC.IssueDate, D.Name AS DoctorName
    FROM MedicalCertificate MC
    JOIN Doctor D ON MC.Doctor_ID = D.ID
    WHERE MC.Student_ID = '$student_id'
";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Medical Certificates</title>
    <style>
        body { font-family: Arial; background-color: #eef2f5; }
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
        <h2>Your Medical Certificates</h2>
        <table>
            <tr>
                <th>Certificate ID</th>
                <th>Reason</th>
                <th>Issue Date</th>
                <th>Doctor</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?= $row['CertificateID'] ?></td>
                    <td><?= $row['Reason'] ?></td>
                    <td><?= $row['IssueDate'] ?></td>
                    <td><?= $row['DoctorName'] ?></td>
                </tr>
            <?php } ?>
        </table>
        <br>
        <a href="student_dashboard.php">← Back to Dashboard</a>
    </div>
</body>
</html>
