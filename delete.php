<?php
session_start();

if (!isset($_SESSION['adminpassword']) && !isset($_SESSION['adminname'])) {
    header("Location: login_page.php");
    exit;
}

$conn = new mysqli("localhost", "root", "", "quest_test");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = intval($_GET['id']);

switch ($_SESSION["goto"]) {
        case "admin":
            $stmt = $conn->prepare("DELETE FROM results WHERE UserID = ?");
            break;
        case "users":
            $stmt = $conn->prepare("DELETE FROM users WHERE UserID = ?");
            break;
    }
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    switch ($_SESSION["goto"]) {
        case "admin":
            header("Location: admin_page.php");
            break;
        case "users":
            header("Location: users_page.php");
            break;
    }
} else {
    echo "Delete failed";
}

$stmt->close();
$conn->close();
?>