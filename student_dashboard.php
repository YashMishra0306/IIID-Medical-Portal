<?php
include 'session_check.php';
include 'db_connection.php';

if ($_SESSION['role'] !== 'Student') {
    header("Location: login.php");
    exit();
}

$student_id = $_SESSION['user_id'];
$query = "SELECT * FROM Student WHERE StudentID = '$student_id'";
$result = mysqli_query($conn, $query);
$student = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f4f8;
        }
        .container {
            width: 80%;
            margin: auto;
            padding: 40px;
            background-color: white;
            margin-top: 50px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
        }
        h2 {
            color: #2c3e50;
        }
        .info {
            margin-bottom: 20px;
        }
        .btn {
            display: inline-block;
            margin: 10px 5px;
            padding: 10px 20px;
            background-color: #2980b9;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        .btn:hover {
            background-color: #1c5980;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Welcome, <?php echo $student['Name']; ?> (<?php echo $student['StudentID']; ?>)</h2>
        <div class="info">
            <p><strong>Department:</strong> <?php echo $student['Department']; ?></p>
        </div>

        <a class="btn" href="student_medical_certificates.php">View Medical Certificates</a>
        <a class="btn" href="student_exam_status.php">View Missed Exams</a>
        <a class="btn" href="logout.php">Logout</a>
    </div>
</body>
</html>
