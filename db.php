<?php
$host = 'localhost';
$db = 'admin_db';
$user = 'root';
$pass = 'weblab@1';

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
