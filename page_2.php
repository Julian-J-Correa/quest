<?php
session_start();
$_SESSION['username'] = $_POST['name'] ?? '';
$_SESSION['reason'] = $_POST['reason'] ?? 'unknown';
$_SESSION['favNumber'] = $_POST['favNumber'] ?? '0';
$_SESSION['will'] = intval(isset($_POST['freeWill']));

?>

<!DOCTYPE html>
<html>

<head>
    <title>PHP Test (2 of 2)</title>
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
                            href="https://youtu.be/5YvzStBaays?si=AaYK-ST-fjV59d7B">Users</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <header class="bg-primary bg-gradient">
        <div class="container px-4 text-center" style="color: green">
            <h1>"<p class="fw-bolder">The PHP Questionaire - Page 2</p></h1>
                <p class="lead">Please answer all the questions as honestly as possible</p>
        </div>
    </header>
    <form action="page_3.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="name" value="<?php echo htmlspecialchars($name); ?>">
        <h2>
            Which side of the earth are you on?
        </h2>
        <input type="radio" id="north" name="direction" value="North">
        <label for="north">North</label><br>
        <input type="radio" id="south" name="direction" value="South">
        <label for="south">South</label><br>
        <input type="radio" id="east" name="direction" value="East">
        <label for="east">East</label><br>
        <input type="radio" id="west" name="direction" value="West">
        <label for="west">West</label><br>
        <h2>
            What is your favourite colour?
        </h2>
        <input type="color" name="favColour" id="favcolour"><br>
        <h2>
            On which date do you think this questionaire was created
        </h2>
        <input type="date" name="dateGuess" max="2026-07-31" max="2026-06-01"><br>
        <h2>
            Give a pdf of your recent taxes
        </h2>
        <input type="file" id="taxFile" name="taxFile" required accept=".pdf"  ><br>
        <input type="submit" value="Submit">
        <input type="reset" value="Reset">
    </form>
    <footer class="py-5 bg-dark">
            <div class="container px-4"><p class="m-0 text-center text-white">Copyright &copy; Mi-Wifi 2026</p></div>
        </footer>
</body>

</html>