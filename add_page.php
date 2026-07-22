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
<!DOCTYPE html>
<html>

<head>
    <title>Main Menu</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
    <style>
        .bg-primary {
            background-color: #90ffff !important;
        }

        .border-primary {
            border-color: #1500ff;
        }

        .btn-primary:hover {
            background-color: #fa6e53;
            border-color: #fa6e53;
        }

        .link-primary a {
            color: #ffffff !important;
            text-decoration: none;
        }

        .link-primary a:hover {
            color: #008c02 !important;
        }
    </style>

</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
        <div class="container px-4">
            <a class="navbar-brand" href="main_menu.php">PHP Questionaire</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive"
                aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span
                    class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="page_1.php">Questionaire</a></li>
                    <li class="nav-item"><a class="nav-link" href="admin_page.php">Admin</a></li>
                    <li class="nav-item"><a class="nav-link" href="about_page.php">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="users_page.php">Users</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <header class="bg-primary bg-gradient">
        <div class="container px-4 text-center" style="color: green">
            <h1>"<p class="fw-bolder">Add a User</p>
            </h1>
            <p class="lead">Create a new user for this website. The user get an email with their password.</p>
            </p>
        </div>
    </header>
    <form method="post" style="padding-left: 20px;">
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
        <footer class="py-5 bg-dark">
            <div class="container px-4"><p class="m-0 text-center text-white">Copyright &copy; Mi-Wifi 2026</p></div>
        </footer>
</body>
