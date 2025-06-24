<?php
include 'session_check.php';
include 'db_connection.php';

if ($_SESSION['role'] !== 'Doctor') {
    header("Location: login.php");
    exit();
}

$doctor_id = $_SESSION['user_id'];
$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $student_id = mysqli_real_escape_string($conn, $_POST['student_id']);
    $reason = mysqli_real_escape_string($conn, $_POST['reason']);
    $date = date('Y-m-d');

    $insert = "INSERT INTO MedicalCertificate (Student_ID, Doctor_ID, Reason, IssueDate, Status)
               VALUES ('$student_id', '$doctor_id', '$reason', '$date', 'Pending')";
    
    if (mysqli_query($conn, $insert)) {
        $message = "✅ Certificate issued successfully!";
    } else {
        $message = "❌ Error issuing certificate: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Issue Medical Certificate</title>
    <style>
        body { font-family: Arial; background: #eef2f5; }
        .container { width: 60%; margin: auto; margin-top: 50px; background: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 0 12px rgba(0,0,0,0.1); }
        label { display: block; margin-top: 15px; }
        input, textarea { width: 100%; padding: 10px; margin-top: 5px; border: 1px solid #ccc; border-radius: 5px; }
        button { margin-top: 20px; padding: 10px 20px; background: #27ae60; color: white; border: none; border-radius: 6px; cursor: pointer; }
        button:hover { background: #219150; }
        .msg { margin-top: 15px; color: green; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Issue Medical Certificate</h2>
        <form method="post">
            <label for="student_id">Student ID:</label>
            <input type="text" name="student_id" required>

            <label for="reason">Reason:</label>
            <textarea name="reason" rows="4" required></textarea>

            <button type="submit">Issue Certificate</button>
        </form> 
        <div class="msg"><?= $message ?></div>
        <br>
        <a href="doctor_dashboard.php">← Back to Dashboard</a>
    </div>
</body>
</html>
