<?php
session_start();

if (!isset($_SESSION['adminpassword']) || !isset($_SESSION['adminname'])) {
    $_SESSION['goto'] = 'users';
    header("Location: login_page.php");
    exit;
}

$conn = new mysqli("localhost", "root", "", "quest_test");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['addUser'])) {

    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $addStmt = $conn->prepare(
        "INSERT INTO users (Username, Email, Password)
         VALUES (?, ?, ?)"
    );

    $addStmt->bind_param("sss", $username, $email, $password);

    if ($addStmt->execute()) {
        header("Location: admin_page.php");
        exit;
    } else {
        echo "Insert failed: " . $conn->error;
    }
}
?>

<form method="post">
    <h4 style="color: green">Name</h4>
    <input type="text" name="username" required>

    <br><br>

    <h4 style="color: green">Email</h4>
    <input type="email" name="email" required>

    <br><br>

    <h4 style="color: green">Password</h4>
    <input type="password" name="password" required>

    <br><br>

    <input type="submit" name="addUser" value="Submit">
</form>