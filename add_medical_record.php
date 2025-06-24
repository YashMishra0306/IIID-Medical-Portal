<?php
session_start();
include('db_connection.php');

// Only Admin can access this page
if ($_SESSION['role'] != 'Admin') {
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $studentID = $_POST['studentID'];
    $conditions = $_POST['conditions'];
    $medication = $_POST['medication'];
    $doctorID = $_POST['doctorID'];

    if (empty($studentID) || empty($conditions) || empty($medication) || empty($doctorID)) {
        $error_message = "All fields are required!";
    } else {
        $sql = "INSERT INTO MedicalRecord (StudentID, Conditions, MedicationPrescribed, DoctorID) 
                VALUES ('$studentID', '$conditions', '$medication', '$doctorID')";
        if (mysqli_query($conn, $sql)) {
            echo "Medical record added successfully!";
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Medical Record</title>
    <script>
        // Basic JavaScript form validation
        function validateForm() {
            const studentID = document.getElementById('studentID').value;
            const conditions = document.getElementById('conditions').value;
            const medication = document.getElementById('medication').value;
            const doctorID = document.getElementById('doctorID').value;

            if (!studentID || !conditions || !medication || !doctorID) {
                alert("All fields are required!");
                return false;
            }
            return true;
        }
    </script>
</head>
<body>
    <h1>Add Medical Record</h1>

    <?php if (isset($error_message)) { echo "<p style='color:red;'>$error_message</p>"; } ?>

    <form action="add_medical_record.php" method="POST" onsubmit="return validateForm()">
        <label for="studentID">Student ID:</label>
        <input type="text" id="studentID" name="studentID" required><br>

        <label for="conditions">Conditions:</label>
        <textarea id="conditions" name="conditions" required></textarea><br>

        <label for="medication">Medication Prescribed:</label>
        <input type="text" id="medication" name="medication" required><br>

        <label for="doctorID">Doctor ID:</label>
        <input type="text" id="doctorID" name="doctorID" required><br>

        <input type="submit" value="Add Record">
    </form>
</body>
</html>
