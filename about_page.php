<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>About This Site</title>
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

<body id="page-top">
    <!-- Navigation-->
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
    <!-- Header-->
    <header class="bg-primary bg-gradient">
        <div class="container px-4 text-center" style="color: green">
            <h1>"<p class="fw-bolder">About this site</p></h1>
                <p class="lead">This provides all the information you need to know about this site</p>
            <div class="column">
                <a class="btn btn-lg btn-light" href="#about">Why?</a>
                <a class="btn btn-lg btn-light" href="#offers">Services</a>
                <a class="btn btn-lg btn-light" href="#contact">Communication</a>
            </div>
        </div>
    </header>
    <!-- About section-->
    <section id="about">
        <div class="container px-4">
            <div class="row gx-4 justify-content-center">
                <div class="col-lg-8">
                    <h2>Why this was made</h2>
                    <p class="lead">When joining Mi-Wifi on June 2026, Julian Correa, the creator of this site, was unsure on how to
                        use PHP, which is the program used by most of the staff. So he was given the task to create a site with the following 
                        properties:
                    </p>
                    <ul>
                        <li>A questionaire that stores various types of data into an SQL database</li>
                        <li>The questionaire should be made up of 3 pages. 2 to recieve questions and 1 to store questions and 
                            state the completion of the questionaire
                        </li>
                        <li>The questionaire should use html forms and css designs</li>
                        <li>An end-user system that allows the admin of the site to view all the questionaire data in a table</li>
                        <li>The site must use Bootstrap and php</li>
                        <li>The login system should not allow users to simply pathfind their way into the admins' site and must
                            use sessions
                        </li>
                        <li>The admin table should have CRUD applied (Create, Read, Update, Delete)
                        </li>
                    </ul>
                    <p class="lead">While most of these requirements have been applied, some still need to be implemented as of June 22.
                        However, this challenge has helped Julian understand how to use PHP, as well as things to think about when creating
                        a site.
                    </p>
                </div>
            </div>
        </div>
    </section>
    <!-- Services section-->
    <section class="bg-light" id="offers">
        <div class="container px-4">
            <div class="row gx-4 justify-content-center">
                <div class="col-lg-8">
                    <h2>Services this offers</h2>
                    <p class="lead">While this site may not have many ways to provide users with something, This site does allow you to do
                        the questionaire as well as view the table if you are one of the admins.
                    </p>
                </div>
            </div>
        </div>
    </section>
    <!-- Contact section-->
    <section id="contact">
        <div class="container px-4">
            <div class="row gx-4 justify-content-center">
                <div class="col-lg-8">
                    <h2>Contact us</h2>
                    <p class="lead">
                        <div class="col border border-primary text-center bg-primary link-primary" style="colour: red"">
                <a href="https://mi-wifi.com/" class="link-primary h4">Mi-Wifi Website</a>
            </div>
            <div class="col border border-primary text-center bg-primary link-primary" style="colour: red"">
                <a href="info@mi-wifi.com" class="link-primary h4">Mi-Wifi COntact</a>
            </div>
                    </p>
                </div>
            </div>
        </div>
    </section>
    <!-- Footer-->
    <footer class="py-5 bg-dark">
        <div class="container px-4">
            <p class="m-0 text-center text-white">Copyright &copy; Mi-Wifi 2026</p>
        </div>
    </footer>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
</body>

</html>