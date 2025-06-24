<?php
include 'session_check.php';
include 'db_connection.php';

if (strtolower($_SESSION['role']) !== 'admin') {
    header("Location: login.php");
    exit();
}

// Filtering
$specialization_filter = $_GET['specialization'] ?? '';

$spec_sql = "SELECT DISTINCT Specialization FROM Doctor";
$spec_result = mysqli_query($conn, $spec_sql);

$filter_sql = "SELECT D.*, COUNT(V.StudentID) AS VisitCount 
               FROM Doctor D 
               LEFT JOIN VisitedBy V ON D.ID = V.DoctorID ";

if (!empty($specialization_filter)) {
    $filter_sql .= "WHERE D.Specialization = '" . mysqli_real_escape_string($conn, $specialization_filter) . "' ";
}

$filter_sql .= "GROUP BY D.ID ORDER BY D.ID";

$doctors = mysqli_query($conn, $filter_sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Doctors List</title>
    <style>
        body { font-family: Arial; background: #eef3f9; padding: 20px; }
        .container { background: white; padding: 20px; border-radius: 8px; max-width: 1000px; margin: auto; box-shadow: 0 4px 10px rgba(0,0,0,0.1); }
        h2 { text-align: center; color: #2c3e50; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 12px; border: 1px solid #ddd; }
        th { background: #3498db; color: white; }
        tr:nth-child(even) { background: #f9f9f9; }
        .actions a { margin-right: 10px; text-decoration: none; color: #2980b9; }
        .actions a:hover { text-decoration: underline; }
        .filter-box { margin-bottom: 15px; }
        .filter-box select, .filter-box button { padding: 8px; font-size: 14px; }
        .export-btn { margin-top: 10px; background: #2ecc71; color: white; border: none; padding: 10px 15px; cursor: pointer; border-radius: 5px; }
        .back-link { display: inline-block; margin-top: 20px; text-decoration: none; color: #555; }
    </style>
</head>
<body>
<div class="container">
    <h2>All Registered Doctors</h2>

    <div class="filter-box">
        <form method="get">
            <label for="specialization">Filter by Specialization:</label>
            <select name="specialization" id="specialization" onchange="this.form.submit()">
                <option value="">-- All --</option>
                <?php
                while ($spec = mysqli_fetch_assoc($spec_result)) {
                    $sel = ($specialization_filter == $spec['Specialization']) ? 'selected' : '';
                    echo "<option value='{$spec['Specialization']}' $sel>{$spec['Specialization']}</option>";
                }
                ?>
            </select>
        </form>
    </div>

    <table>
        <tr>
            <th>ID</th><th>Name</th><th>Phone</th><th>Email</th><th>Specialization</th><th>Students Visited</th><th>Actions</th>
        </tr>
        <?php
        if ($doctors && mysqli_num_rows($doctors) > 0) {
            while ($row = mysqli_fetch_assoc($doctors)) {
                echo "<tr>
                    <td>{$row['ID']}</td>
                    <td>{$row['Name']}</td>
                    <td>{$row['PhoneNo']}</td>
                    <td>{$row['Email']}</td>
                    <td>{$row['Specialization']}</td>
                    <td>{$row['VisitCount']}</td>
                    <td class='actions'>
                        <a href='edit_doctor.php?id={$row['ID']}'>Edit</a>
                        <a href='delete_doctor.php?id={$row['ID']}' onclick='return confirm(\"Delete this doctor?\")'>Delete</a>
                    </td>
                </tr>";
            }
        } else {
            echo "<tr><td colspan='7'>No doctors found.</td></tr>";
        }
        ?>
    </table>

    <form method="post" action="export_doctors_excel.php">
        <button class="export-btn">Export to Excel</button>
    </form>

    <a href="admin_dashboard.php" class="back-link">← Back to Dashboard</a>
</div>
</body>
</html>
