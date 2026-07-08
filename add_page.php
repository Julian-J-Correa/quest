<?php
session_start();

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

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

    $mail = new PHPMailer(true);

    $mail->isSMTP();
    $mail->Host = 'smtp.office365.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'dev@mi-wifi.com';
    $mail->Password = '456852';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    $mail->setFrom('dev@miwifi.com', 'Quest Test');
    $mail->addAddress($email, $username);

    $mail->isHTML(true);
    $mail->Subject = 'Welcome!';
    $mail->Body = "
<h2>Welcome, $username!</h2>
<p>Your account has been created successfully.</p>
<p>You can now log in using <strong>$email</strong>.</p>";

    $mail->send();


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