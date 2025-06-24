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

    // If user confirms, delete the record
    if (isset($_GET['confirm']) && $_GET['confirm'] == 'yes') {
        $sql = "DELETE FROM MedicalRecord WHERE ID = '$id'";

        if (mysqli_query($conn, $sql)) {
            echo "Record deleted successfully!";
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
} else {
    echo "Invalid record ID!";
}
?>

<!-- HTML for confirmation dialog -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Medical Record</title>
    <script>
        function confirmDeletion() {
            const result = confirm("Are you sure you want to delete this record?");
            if (result) {
                window.location.href = "delete_medical_record.php?id=<?php echo $_GET['id']; ?>&confirm=yes";
            } else {
                window.location.href = "view_medical_records.php";
            }
        }
    </script>
</head>
<body>
    <h1>Delete Medical Record</h1>
    <p>Are you sure you want to delete this medical record?</p>
    <button onclick="confirmDeletion()">Yes, delete</button>
    <button onclick="window.location.href = 'view_medical_records.php'">No, cancel</button>
</body>
</html>
