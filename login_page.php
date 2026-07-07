<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
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

<body class="text-center">
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
            <h1>"<p class="fw-bolder">Admin Login</p></h1>
                <p class="lead">You will need to enter your details to gain access</p>
        </div>
    </header>
    <div style="color: green; height: 50px">
        <h4>
            <?php echo '<p>Enter the password to access admin</p>'; ?><br>
        </h4>
    </div>
    <form action="verify.php" method="post">
        <h4>
            <?php echo '<p>Username</p>'; ?><br>
        </h4>
        <input type="text" name="adminname" required>
        <h4>
            <?php echo '<p>Password</p>'; ?><br>
        </h4>
        <input type="password" name="password" required>
        <br><br>
        <input type="submit" value="Enter" class="btn btn-lg btn-light border border-primary" >
        <br><br>
    </form>
    <footer class="py-5 bg-dark">
            <div class="container px-4"><p class="m-0 text-center text-white">Copyright &copy; Mi-Wifi 2026</p></div>
        </footer>
</body>

</html>