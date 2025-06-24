<?php
session_start();
include('db_connection.php');

// Only Admin can access this page
if ($_SESSION['role'] != 'Admin') {
    header('Location: login.php');
    exit;
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $conditions = $_POST['conditions'];
        $medication = $_POST['medication'];

        if (empty($conditions) || empty($medication)) {
            $error_message = "Conditions and Medication are required!";
        } else {
            $sql = "UPDATE MedicalRecord SET Conditions = '$conditions', MedicationPrescribed = '$medication' WHERE ID = '$id'";
            if (mysqli_query($conn, $sql)) {
                echo "Medical record updated successfully!";
            } else {
                echo "Error: " . mysqli_error($conn);
            }
        }
    }

    $sql = "SELECT * FROM MedicalRecord WHERE ID = '$id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
} else {
    echo "Invalid record ID!";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Medical Record</title>
    <script>
        // Basic JavaScript form validation
        function validateForm() {
            const conditions = document.getElementById('conditions').value;
            const medication = document.getElementById('medication').value;

            if (!conditions || !medication) {
                alert("Conditions and Medication are required!");
                return false;
            }
            return true;
        }
    </script>
</head>
<body>
    <h1>Update Medical Record</h1>

    <?php if (isset($error_message)) { echo "<p style='color:red;'>$error_message</p>"; } ?>

    <form action="update_medical_record.php?id=<?php echo $row['ID']; ?>" method="POST" onsubmit="return validateForm()">
        <label for="conditions">Conditions:</label>
        <textarea id="conditions" name="conditions" required><?php echo $row['Conditions']; ?></textarea><br>

        <label for="medication">Medication Prescribed:</label>
        <input type="text" id="medication" name="medication" value="<?php echo $row['MedicationPrescribed']; ?>" required><br>

        <input type="submit" value="Update Record">
    </form>
</body>
</html>
