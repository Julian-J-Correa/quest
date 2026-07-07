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
                    <li class="nav-item"><a class="nav-link"
                            href="https://youtu.be/5YvzStBaays?si=AaYK-ST-fjV59d7B">Users</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <header class="bg-primary bg-gradient">
        <div class="container px-4 text-center" style="color: green">
            <h1>"<p class="fw-bolder">Welcome to The PHP Questionaire</p></h1>
                <p class="lead">This site is for you to answer the questionaire and view what other users have answered too</p>
        </div>
    </header>
    <div class="container">
        <div class="row">
            <div class="col border border-primary text-center bg-primary link-primary" style="colour: red">
                <a href="page_1.php" class="link-primary h4">Start questionnaire</a>
            </div>
            <div class="col border border-primary text-center bg-primary link-primary" style="colour: red"">
                <a href="login_page.php" class="link-primary h4">View Data</a>
            </div>
        </div>

        <div class="row">
            <div class="col border border-primary text-center bg-primary link-primary" style="colour: red"">
                <a href="about_page.php" class="link-primary h4">About</a>
            </div>
            <div class="col border border-primary text-center bg-primary link-primary" style="colour: red"">
                <a href="https://youtu.be/5YvzStBaays?si=AaYK-ST-fjV59d7B" class="link-primary h4">Users</a>
            </div>
        </div>
    </div>
</body>

</html>