<?php

session_start();

if (!isset($_SESSION['adminpassword']) || !isset($_SESSION['adminname'])) {
    header("Location: login_page.php");
    exit;
}

$conn = new mysqli("localhost", "root", "", "quest_test");

$id = intval($_GET['id']);

$selectStmt = $conn->prepare(
    "SELECT * FROM results WHERE UserID = ?"
);

$selectStmt->bind_param("i", $id);
$selectStmt->execute();

$result = $selectStmt->get_result();
$row = $result->fetch_assoc();

$updateStmt = $conn->prepare(
    "UPDATE results
         SET Name = ?, Reason = ?, FavNum = ?, ByChoice = ?, EarthDir = ?, FavColour = ?, DateGuess = ?, TaxName = ?
         WHERE UserID = ?"
);

if (isset($_POST['update'])) {

    $id = intval($_POST['id']);
    $name = $_POST['name'];
    $reason = $_POST['reason'];
    $favNumber = $_POST['favNum'];
    $choice = isset($_POST['byChoice']) ? 1 : 0;
    $earth = $_POST['earthDir'];
    $colour = $_POST['favColour'];
    $date = $_POST['dateGuess'];
    $tax = $_POST['taxName'];

    $updateStmt->bind_param(
        "ssiissssi",
        $name,
        $reason,
        $favNumber,
        $choice,
        $earth,
        $colour,
        $date,
        $tax,
        $id
    );

    if ($updateStmt->execute()) {
        header("Location: admin_page.php");
        exit;
    } else {
        echo "Update failed";
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
            <h1>"<p class="fw-bolder">Welcome to The PHP Questionaire</p>
            </h1>
            <p class="lead">This site is for you to answer the questionaire and view what other users have answered too
            </p>
        </div>
    </header>

    <form method="post">

        <input type="hidden" name="id" value="<?php echo $row['UserID']; ?>">

        <h4 style="color: green">Name</h4>
        <input type="text" name="name" value="<?php echo htmlspecialchars($row['Name']); ?>">

        <br><br>

        <h4 style="color: green">Reason</h4>
        <input type="text" name="reason" value="<?php echo htmlspecialchars($row['Reason']); ?>">

        <br><br>

        <h4 style="color: green">Favourite Number</h4>
        <input type="text" name="favNum" value="<?php echo htmlspecialchars($row['FavNum']); ?>">

        <br><br>

        <h4 style="color: green">Answering By Choice</h4>
        <input type="checkbox" name="byChoice" value="1" <?php echo ($row['ByChoice'] == 1) ? 'checked' : ''; ?>>

        <br><br>

        <h4 style="color: green">Part Of Earth</h4>
        <input type="text" name="earthDir" value="<?php echo htmlspecialchars($row['EarthDir']); ?>">

        <br><br>

        <h4 style="color: green">Favourite Colour</h4>
        <input type="text" name="favColour" value="<?php echo htmlspecialchars($row['FavColour']); ?>">

        <br><br>

        <h4 style="color: green">Guessed Date</h4>
        <input type="date" name="dateGuess" value="<?php echo htmlspecialchars($row['DateGuess']); ?>">

        <br><br>

        <h4 style="color: green">Tax PDF</h4>
        <input type="text" name="taxName" value="<?php echo htmlspecialchars($row['TaxName']); ?>">

        <br><br>

        <input type="submit" name="update" value="Update">

    </form>
        <footer class="py-5 bg-dark">
            <div class="container px-4"><p class="m-0 text-center text-white">Copyright &copy; Mi-Wifi 2026</p></div>
        </footer>
</body>
