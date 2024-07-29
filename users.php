<?php
session_start();
if (!isset($_SESSION['username']) || !$_SESSION['is_admin']) {
    header('Location: login.php');
    exit();
}

include('db.php');

$sql = "SELECT * FROM users";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users</title>
</head>
<body>
    <h1>Manage Users</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Is Admin</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['username']; ?></td>
            <td><?php echo $row['is_admin'] ? 'Yes' : 'No'; ?></td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
