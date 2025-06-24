<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit();
}
include '../db_connection.php';

$sql = "SELECT S.StudentID, S.Name, S.Department, I.Name AS IIIT_Name, I.Location
        FROM Student S
        JOIN IIITD I ON S.Department = I.Branch";

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Query 1 - Students and IIIT</title>
    <style>
        body { font-family: Arial; padding: 20px; background: #f9f9f9; }
        table { border-collapse: collapse; width: 100%; margin-top: 20px; }
        th, td { border: 1px solid #ccc; padding: 10px; text-align: left; }
        th { background-color: #007bff; color: white; }
        tr:nth-child(even) { background-color: #f2f2f2; }
        h2 { text-align: center; }
        a.back {
            display: inline-block;
            margin-top: 20px;
            text-decoration: none;
            color: white;
            background: #007bff;
            padding: 10px 15px;
            border-radius: 5px;
        }
        a.back:hover {
            background: #0056b3;
        }
        .back-button {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 15px;
            background-color: #28a745;
            color: white;
            border-radius: 5px;
            text-decoration: none;
        }
        .back-button:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>

<h2>Students with their IIIT</h2>

<table>
    <tr>
        <th>Student ID</th>
        <th>Name</th>
        <th>Department</th>
        <th>IIIT Name</th>
        <th>Location</th>
    </tr>

    <?php
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                    <td>{$row['StudentID']}</td>
                    <td>{$row['Name']}</td>
                    <td>{$row['Department']}</td>
                    <td>{$row['IIIT_Name']}</td>
                    <td>{$row['Location']}</td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='5'>No records found</td></tr>";
    }
    ?>

</table>

<!-- Back to previous page button -->
<a href="javascript:history.back()" class="back-button">← Back</a>

<a class="back" href="../queries.php">← Back to Queries</a>

</body>
</html>
