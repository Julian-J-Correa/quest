<?php
session_start();

if (!isset($_SESSION['password'])) {
    header("Location: login_page.php");
    exit;
}

$conn = new mysqli("localhost", "root", "", "quest_test");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = intval($_GET['id']);

$stmt = $conn->prepare("DELETE FROM results WHERE UserID = ?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    header("Location: admin_page.php");
    exit;
} else {
    echo "Delete failed";
}

$stmt->close();
$conn->close();
?>