<?php
$studentID = $_SESSION['student_id']; // Assuming login session stores this
$sql = "SELECT * FROM MedicalCertificate WHERE Student_ID = ? AND Status = 'Approved'";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $studentID);
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {
    echo "Reason: " . $row['Reason'] . " | Issued on: " . $row['IssueDate'] . "<br>";
}
?>
