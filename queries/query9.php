<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit();
}
include '../db_connection.php';

$sql = "SELECT S.StudentID, S.Name, MR.Conditions
        FROM MedicalRecord MR
        JOIN Student S ON MR.StudentID = S.StudentID
        WHERE MR.MedicationPrescribed = 'Paracetamol'";

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Query 9 - Students Prescribed Paracetamol</title>
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

<h2>Students Prescribed Paracetamol</h2>

<table>
    <tr>
        <th>Student ID</th>
        <th>Name</th>
        <th>Conditions</th>
    </tr>

    <?php
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                    <td>{$row['StudentID']}</td>
                    <td>{$row['Name']}</td>
                    <td>{$row['Conditions']}</td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='3'>No records found.</td></tr>";
    }
    ?>

</table>

<a class="back" href="../queries.php">← Back to Queries</a>

</body>
</html>
