<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "quest_test";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Failed connection: " . $conn->connect_error);
}

if (!empty($_POST)) {
    if (isset($_POST['password']) && isset($_POST['adminname'])) {
        $_SESSION['adminpassword'] = $_POST['password'];
        $_SESSION['adminname'] = $_POST['adminname'];
        $sql = "SELECT * FROM users WHERE Username=? AND Password=? LIMIT 1";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $_SESSION['adminname'], $_SESSION['adminpassword']);
        $stmt->execute();
        $valueExists = $stmt->get_result();
        if ($valueExists == true) {
            echo whichPage();
        } else {
            header("Location: login_page.php");
        }
    } else {
        header("Location: login_page.php");
    }
}

function whichPage()
{
    switch ($_SESSION["goto"]) {
        case "admin":
            header("Location: admin_page.php");
            break;
        case "users":
            header("Location: users_page.php");
            break;
        default:
            header("Location: login_page.php");
    }
}
?>