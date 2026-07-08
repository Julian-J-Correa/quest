<?php
session_start();
include("query_builder.php");
$target_path = null;
$_SESSION['tax_name'] = null;

$_SESSION['earth'] = $_POST['direction'] ?? 'unknown';
$_SESSION['colour'] = $_POST['favColour'] ?? 'unknown';
$_SESSION['guess'] = $_POST['dateGuess'] ?? '0';
$_SESSION['dateCreated'] = date("Y-m-d") . "";

if (
    isset($_FILES['taxFile']) &&
    $_FILES['taxFile']['error'] === UPLOAD_ERR_OK
) {
    $_SESSION['tax_name'] = $_FILES['taxFile']['name'];
    $_SESSION['file_tmp'] = $_FILES['taxFile']['tmp_name'];
    $_SESSION['file_ext'] = strtolower(pathinfo($_SESSION['tax_name'], PATHINFO_EXTENSION));

    $upload_dir = 'uploads/';

    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0755, true);
    }

    $unique_name = uniqid() . '_' . basename($_SESSION['tax_name']);
    $target_path = $upload_dir . $unique_name;
}


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "quest_test";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Failed connection: " . $conn->connect_error);
}

$data = [
    "Name"        => $_SESSION['username'],
    "Reason"      => $_SESSION['reason'],
    "FavNum"      => $_SESSION['favNumber'],
    "ByChoice"    => $_SESSION['will'],
    "EarthDir"    => $_SESSION['earth'],
    "FavColour"    => $_SESSION['colour'],
    "DateGuess"   => $_SESSION['guess'],
    "TaxName"     => $_SESSION['tax_name'],
    "TaxPath"     => $target_path,
    "DateCreated" => $_SESSION['dateCreated']
];

$duplicate = db_insert($conn, "results", $data);
db_delete_row($conn, "results", 'UserID', $duplicate);
if ($target_path !== null) {
    move_uploaded_file($_SESSION['file_tmp'], $target_path);
}

$conn->close();
?>

<!DOCTYPE html>
<html>

<head>
    <title>PHP Test (Completed)</title>
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
                    <li class="nav-item"><a class="nav-link"
                            href="users_page.php">Users</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <header class="bg-primary bg-gradient">
        <div class="container px-4 text-center" style="color: green">
            <h1>"<p class="fw-bolder">CONGRADULATIONS!!!</p>
            </h1>
            <p class="lead">You have completed the questionaire! You have the option to do this questionaire
                again, or view your answers in the database.
            </p>
            <div class="column">
                <a class="btn btn-lg btn-light" href="page_1.php">Redo</a>
                <a class="btn btn-lg btn-light" href="login_page.php">View Results</a>
            </div>
        </div>
    </header>
    <footer class="py-5 bg-dark">
        <div class="container px-4">
            <p class="m-0 text-center text-white">Copyright &copy; Mi-Wifi 2026</p>
        </div>
    </footer>
</body>

</html>