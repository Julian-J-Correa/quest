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
    $date = date("Y-m-d") . "";

    $addStmt = $conn->prepare(
        "INSERT INTO users (Username, Email, Password, DateCreated)
         VALUES (?, ?, ?, ?)"
    );

    $addStmt->bind_param("ssss", $username, $email, $password, $date);

    $mail = new PHPMailer(true);

    $mail->isSMTP();
    $mail->Host = 'smtp.office365.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'dev@mi-wifi.com';
    $mail->Password = 'H(862835755789ab';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    $mail->setFrom('dev@mi-wifi.com', 'Quest Test');
    $mail->addAddress($email, $username);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Invalid email address");
    }

    $mail->isHTML(true);
    $mail->Subject = 'PHP Questionaire - You have been validated!';
    $mail->Body = "
<h2>You ($username) have been accepted as a valid user for the PHP Questionaire website</h2>
<p>You are now able to:</p>
<br><br>
<p>- View Questionaire answers</p>
<p>- Add, edit, and delete other valid users</p>
<p>- View the code? (i think)</p>
<br><br>
<p>Your password is <strong>($password)</strong>.</p>
<p>Enjoy the website :]</p>";

    $mail->SMTPDebug = 2; // or SMTP::DEBUG_SERVER
    $mail->Debugoutput = 'html';

    $mail->send();


    if ($addStmt->execute()) {
        header("Location: users_page.php");
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