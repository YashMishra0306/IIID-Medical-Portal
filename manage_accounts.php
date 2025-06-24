<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'session_check.php';

if (strtolower($_SESSION['role']) !== 'admin') {
    header("Location: login.php");
    exit();
}

include 'db_connection.php';

// Fetch all users
$sql = "SELECT id, username, role FROM users";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Accounts</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f9fb;
            padding: 20px;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        table {
            width: 90%;
            margin: 0 auto;
            border-collapse: collapse;
            background: #fff;
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
        }

        th, td {
            padding: 12px 16px;
            border: 1px solid #ddd;
            text-align: center;
        }

        th {
            background-color: #2980b9;
            color: white;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        .delete-btn {
            background: #e74c3c;
            color: white;
            padding: 6px 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .delete-btn:hover {
            background: #c0392b;
        }
    </style>
</head>
<body>

    <h2>Manage User Accounts</h2>

    <table>
        <tr>
            <th>User ID</th>
            <th>Username</th>
            <th>Role</th>
            <th>Action</th>
        </tr>
        <?php if ($result && $result->num_rows > 0): ?>
            <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($row['id']) ?></td>
                    <td><?= htmlspecialchars($row['username']) ?></td>
                    <td><?= htmlspecialchars($row['role']) ?></td>
                    <td>
                        <form method="post" action="delete_user.php" onsubmit="return confirm('Are you sure you want to delete this user?');">
                            <input type="hidden" name="user_id" value="<?= $row['id'] ?>">
                            <button type="submit" class="delete-btn">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr><td colspan="4">No users found.</td></tr>
        <?php endif; ?>
    </table>

</body>
</html>
