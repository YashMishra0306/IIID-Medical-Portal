<?php
include 'session_check.php';
include 'db_connection.php';

if (strtolower($_SESSION['role']) !== 'admin') {
    header("Location: login.php");
    exit();
}

// Handle approval or rejection
if (isset($_GET['id']) && isset($_GET['action'])) {
    $id = intval($_GET['id']);
    $action = $_GET['action'] === 'approve' ? 'Approved' : 'Rejected';

    $sql = "UPDATE MedicalCertificate SET Status = '$action' WHERE CertificateID = $id";
    if (mysqli_query($conn, $sql)) {
        header("Location: approve_certificate.php?msg=updated");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

// Fetch all pending certificates
$query = "SELECT MC.*, S.Name AS StudentName, D.Name AS DoctorName
          FROM MedicalCertificate MC
          JOIN Student S ON MC.Student_ID = S.StudentID
          JOIN Doctor D ON MC.Doctor_ID = D.ID
          ORDER BY IssueDate DESC";

$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Approve Certificates</title>
    <style>
        body { font-family: Arial; background: #f0f2f5; }
        .container { max-width: 1000px; margin: auto; background: white; padding: 20px; border-radius: 10px; margin-top: 30px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); }
        h2 { text-align: center; color: #2c3e50; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 10px; border: 1px solid #ccc; }
        th { background: #3498db; color: white; }
        .actions a { margin-right: 10px; text-decoration: none; font-weight: bold; }
        .approve { color: green; }
        .reject { color: red; }
        .status { font-weight: bold; }
        .back { margin-top: 20px; display: inline-block; text-decoration: none; color: #333; }
    </style>
</head>
<body>
<div class="container">
    <h2>Medical Certificates</h2>

    <table>
        <tr>
            <th>ID</th>
            <th>Student</th>
            <th>Doctor</th>
            <th>Reason</th>
            <th>Date</th>
            <th>Time</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>

        <?php
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>
                    <td>{$row['CertificateID']}</td>
                    <td>{$row['StudentName']}</td>
                    <td>{$row['DoctorName']}</td>
                    <td>{$row['Reason']}</td>
                    <td>{$row['IssueDate']}</td>
                    <td>{$row['IssueTime']}</td>
                    <td class='status'>{$row['Status']}</td>
                    <td>";

                if ($row['Status'] === 'Pending') {
                    echo "<a class='approve' href='approve_certificate.php?id={$row['CertificateID']}&action=approve'>Approve</a>
                          <a class='reject' href='approve_certificate.php?id={$row['CertificateID']}&action=reject'>Reject</a>";
                } else {
                    echo "-";
                }

                echo "</td></tr>";
            }
        } else {
            echo "<tr><td colspan='8'>No certificates found.</td></tr>";
        }
        ?>
    </table>

    <a class="back" href="admin_dashboard.php">← Back to Dashboard</a>
</div>
</body>
</html>
