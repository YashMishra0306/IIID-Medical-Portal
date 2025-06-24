<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$role = $_SESSION['role'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Run Queries - IIIT Medical Portal</title>
    <style>
        body { font-family: Arial; background: #f2f2f2; padding: 20px; }
        h1 { text-align: center; }
        .grid {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
            margin-top: 40px;
        }
        .query-box {
            background: white;
            padding: 20px;
            border-radius: 10px;
            width: 300px;
            text-align: center;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        .query-box a {
            text-decoration: none;
            display: inline-block;
            margin-top: 10px;
            background: #007bff;
            color: white;
            padding: 10px 15px;
            border-radius: 5px;
        }
        .query-box a:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>

<h1>Query Dashboard</h1>
<div class="grid">
    <div class="query-box">
        <h3>Students with their IIIT</h3>
        <a href="queries/query1.php">Run Query</a>
    </div>
    <div class="query-box">
        <h3>Students per Department</h3>
        <a href="queries/query2.php">Run Query</a>
    </div>
    <div class="query-box">
        <h3>Medical Certs & Doctors</h3>
        <a href="queries/query3.php">Run Query</a>
    </div>
    <div class="query-box">
        <h3>Multiple Medical Certs</h3>
        <a href="queries/query4.php">Run Query</a>
    </div>
    <div class="query-box">
        <h3>Exams Missed</h3>
        <a href="queries/query5.php">Run Query</a>
    </div>
    <div class="query-box">
        <h3>Missed > 2 Exams</h3>
        <a href="queries/query6.php">Run Query</a>
    </div>
    <div class="query-box">
        <h3>Visited Doctor</h3>
        <a href="queries/query7.php">Run Query</a>
    </div>
    <div class="query-box">
        <h3>Medical Certs Count</h3>
        <a href="queries/query8.php">Run Query</a>
    </div>
    <div class="query-box">
        <h3>Prescribed Paracetamol</h3>
        <a href="queries/query9.php">Run Query</a>
    </div>
    <div class="query-box">
        <h3>Visited & Got Cert</h3>
        <a href="queries/query10.php">Run Query</a>
    </div>
</div>

</body>
</html>
