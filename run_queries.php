<?php
include 'session_check.php';
include 'db_connection.php';

if ($_SESSION['role'] !== 'Admin') {
    header("Location: login.php");
    exit();
}

$result = null;
$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $query = trim($_POST['query']);

    if (stripos($query, 'select') === 0) {
        $result = mysqli_query($conn, $query);
        if (!$result) {
            $error = "❌ Error: " . mysqli_error($conn);
        }
    } else {
        $error = "⚠️ Only SELECT queries are allowed.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Run Queries</title>
    <style>
        body { font-family: Arial; background: #eef2f7; }
        .container { width: 80%; margin: auto; margin-top: 50px; background: #fff; padding: 30px; border-radius: 10px; box-shadow: 0 0 12px rgba(0,0,0,0.1); }
        textarea { width: 100%; height: 100px; padding: 10px; margin-top: 10px; font-size: 16px; }
        button { margin-top: 15px; padding: 10px 20px; background: #3498db; color: white; border: none; border-radius: 6px; cursor: pointer; }
        button:hover { background: #2980b9; }
        table { width: 100%; margin-top: 20px; border-collapse: collapse; }
        th, td { padding: 10px; border: 1px solid #ccc; }
        th { background-color: #2980b9; color: white; }
        .error { color: red; margin-top: 10px; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Run SELECT Queries</h2>
        <form method="POST">
            <textarea name="query" placeholder="Enter SELECT query here..."><?= isset($_POST['query']) ? htmlspecialchars($_POST['query']) : '' ?></textarea>
            <br>
            <button type="submit">Execute</button>
        </form>

        <?php if ($error): ?>
            <div class="error"><?= $error ?></div>
        <?php endif; ?>

        <?php if ($result && mysqli_num_rows($result) > 0): ?>
            <table>
                <tr>
                    <?php while ($field = mysqli_fetch_field($result)) { echo "<th>{$field->name}</th>"; } ?>
                </tr>
                <?php while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    foreach ($row as $cell) {
                        echo "<td>" . htmlspecialchars($cell) . "</td>";
                    }
                    echo "</tr>";
                } ?>
            </table>
        <?php elseif ($result): ?>
            <p>No results found.</p>
        <?php endif; ?>

        <br>
        <a href="admin_dashboard.php">← Back to Dashboard</a>
    </div>
</body>
</html>
