<?php
include('../db_connection.php');

// SQL query to get students with their medical certificates and issuing doctor’s name
$query = "SELECT S.StudentID, S.Name AS StudentName, MC.CertificateID, D.Name AS DoctorName, MC.Reason, MC.IssueDate
          FROM MedicalCertificate MC
          JOIN Student S ON MC.Student_ID = S.StudentID
          JOIN Doctor D ON MC.Doctor_ID = D.ID";

$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Students with Medical Certificates</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

<h1>Students with Medical Certificates</h1>

<?php
if (mysqli_num_rows($result) > 0) {
    echo "<table border='1'>
            <tr>
                <th>Student ID</th>
                <th>Student Name</th>
                <th>Certificate ID</th>
                <th>Doctor Name</th>
                <th>Reason</th>
                <th>Issue Date</th>
            </tr>";
    
    // Loop through and display data
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>
                <td>" . $row['StudentID'] . "</td>
                <td>" . $row['StudentName'] . "</td>
                <td>" . $row['CertificateID'] . "</td>
                <td>" . $row['DoctorName'] . "</td>
                <td>" . $row['Reason'] . "</td>
                <td>" . $row['IssueDate'] . "</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "No records found.";
}

mysqli_close($conn); // Close connection
?>

</body>
</html>
