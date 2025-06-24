<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit();
}
include '../db_connection.php';

$sql = "SELECT S.StudentID, S.Name AS StudentName, MC.CertificateID, D.Name AS DoctorName, MC.Reason, MC.IssueDate
        FROM MedicalCertificate MC
        JOIN Student S ON MC.Student_ID = S.StudentID
        JOIN Doctor D ON MC.Doctor_ID = D.ID";

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Query 3 - Students with Medical Certificates</title>
    <style>
        body { font-family: Arial; padding: 20px; background: #fefefe; }
        table { border-collapse: collapse; width: 90%; margin: auto; margin-top: 30px; }
        th, td { border: 1px solid #999; padding: 10px; text-align: center; }
        th { background-color: #007bff; color: white; }
        tr:nth-child(even) { background-color: #f0f8ff; }
        h2 { text-align: center; }
        a.back {
            display: block;
            width: 200px;
            margin: 30px auto;
            text-align: center;
            text-decoration: none;
            color: white;
            background: #007bff;
            padding: 10px;
            border-radius: 5px;
        }
        a.back:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>

<h2>Students Who Received Medical Certificates</h2>

<table>
    <tr>
        <th>Student ID</th>
        <th>Student Name</th>
        <th>Certificate ID</th>
        <th>Doctor Name</th>
        <th>Reason</th>
        <th>Issue Date</th>
    </tr>

    <?php
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                    <td>{$row['StudentID']}</td>
                    <td>{$row['StudentName']}</td>
                    <td>{$row['CertificateID']}</td>
                    <td>{$row['DoctorName']}</td>
                    <td>{$row['Reason']}</td>
                    <td>{$row['IssueDate']}</td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='6'>No records found</td></tr>";
    }
    ?>

</table>

<a class="back" href="../queries.php">← Back to Queries</a>

</body>
</html>
