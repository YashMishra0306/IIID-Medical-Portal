<?php
include 'db_connection.php';

header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=Doctors_List.xls");

echo "ID\tName\tPhone\tEmail\tSpecialization\tStudents Visited\n";

$sql = "SELECT D.*, COUNT(V.StudentID) AS VisitCount 
        FROM Doctor D 
        LEFT JOIN VisitedBy V ON D.ID = V.DoctorID 
        GROUP BY D.ID";
$result = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_assoc($result)) {
    echo "{$row['ID']}\t{$row['Name']}\t{$row['PhoneNo']}\t{$row['Email']}\t{$row['Specialization']}\t{$row['VisitCount']}\n";
}
?>
