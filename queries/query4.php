<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit();
}
include '../db_connection.php';

$sql = "SELECT Student_ID, COUNT(*) AS CertificateCount
        FROM MedicalCertificate
        GROUP BY Student_ID
        HAVING COUNT(*) > 1";

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Query 4 - Students with Multiple Medical Certificates</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; background: #f7f7f7; }
        h2 { text-align: center; color: #333; }
        table { border-collapse: collapse; width: 80%; margin: 30px auto; }
        th, td { border: 1px solid #ccc; padding: 10px; text-align: center; }
        th { background-color: #28a745; color: white; }
        tr:nth-child(even) { background-color: #eafbea; }
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

<h2>Students with More Than One Medical Certificate</h2>

<table>
    <tr>
        <th>Student ID</th>
        <th>Number of Certificates</th>
    </tr>

    <?php
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                    <td>{$row['Student_ID']}</td>
                    <td>{$row['CertificateCount']}</td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='2'>No students found with more than one certificate.</td></tr>";
    }
    ?>

</table>

<a class="back" href="../queries.php">← Back to Queries</a>

</body>
</html>
