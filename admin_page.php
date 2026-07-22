<?php
session_start();
if ($_SESSION['adminpassword'] && $_SESSION['adminname']) {
    // bibbity bobbity boo
} else {
    $_SESSION['goto'] = 'admin';
    header("Location: login_page.php");
    exit;
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "quest_test";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Failed connection: " . $conn->connect_error);
}

$result = $conn->query("SELECT * FROM results");
if (!$result) {
    echo "Query error: " . $conn->error;
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Admin Dashboard</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.8/css/dataTables.dataTables.css">
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
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

        .page-circle {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #02862a;
            /* Bootstrap primary */
            color: white;
            text-decoration: none;
            display: flex;
            justify-content: center;
            align-items: center;
            font-weight: bold;
            margin: 5px;
        }

        .page-circle:hover {
            background: #028ac0;
            color: white;
        }

        .wrap {
            word-break: break-word;
            overflow-wrap: break-word;
            white-space: normal;
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
                    <li class="nav-item"><a class="nav-link" href="login_page.php">Admin</a></li>
                    <li class="nav-item"><a class="nav-link" href="about_page.php">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="users_page.php">Users</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <header class="bg-primary bg-gradient">
        <div class="container px-4 text-center" style="color: green">
            <h1>"<p class="fw-bolder">The PHP Questionaire Table</p>
            </h1>
            <p class="lead">This table contains all the information stored in the database from the questionaires</p>
        </div>
    </header>
    <div class="row top-buffer">
        <div class="col-md-12">
            <table id="myTable" class="table table-striped top-buffer">
                <thead>
                    <tr>
                        <th>
                            UserID
                        </th>
                        <th>
                            Name
                        </th>
                        <th>
                            Reason
                        </th>
                        <th>
                            Favourite Number
                        </th>
                        <th>
                            Answering By Choice?
                        </th>
                        <th>
                            Part of Earth
                        </th>
                        <th>
                            Favourite Colour
                        </th>
                        <th>
                            Guessed Date of Establishment
                        </th>
                        <th>
                            Tax PDF
                        </th>
                        <th>
                            Link to PDF
                        </th>
                        <th>
                            Date of Creation
                        </th>
                        <th>
                            Actions
                        </th>
                    </tr>
                </thead>

                <tbody>
                    <?php while ($row = $result->fetch_object()) { ?>
                        <tr>
                            <td>
                                <?php echo $row->UserID ?>
                            </td>
                            <td>
                                <?php echo $row->Name ?>
                            </td>
                            <td class="wrap">
                                <?php echo $row->Reason ?>
                            </td>
                            <td>
                                <?php echo $row->FavNum ?>
                            </td>
                            <td>
                                <?php
                                if ($row->ByChoice == 1) {
                                    echo "Yes";
                                } else {
                                    echo "No";
                                } ?>
                            </td>
                            <td>
                                <?php echo $row->EarthDir ?>
                            </td>
                            <td>
                                <?php echo $row->FavColour ?>
                            </td>
                            <td>
                                <?php echo $row->DateGuess ?>
                            </td>
                            <td>
                                <?php echo $row->TaxName ?>
                            </td>
                            <td>
                                <a href="<?php echo htmlspecialchars($row->TaxPath); ?>" target="_blank">
                                    <?php echo htmlspecialchars($row->TaxName); ?>
                                </a>
                            </td>
                            <td>
                                <?php echo $row->DateCreated ?>
                            </td>
                            <td>
                                <a href="delete.php?id=<?php echo $row->UserID; ?>" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Are you sure you want to delete this record?');">
                                    Delete
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/2.3.8/js/dataTables.min.js"></script>
    <script>
        console.log(typeof DataTable);
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            console.log("DataTables starting");
            var table = new DataTable("#myTable", {
                pageLength: 5,
                lengthMenu: [5, 10, 25, 50],
                searching: true,
                ordering: true,
                info: true,
                columnDefs: [{ width: '20%', targets: 2 }]
            });
        });
    </script>
</body>
<footer class="py-5 bg-dark">
    <div class="container px-4">
        <p class="m-0 text-center text-white">Copyright &copy; Mi-Wifi 2026</p>
    </div>
</footer>

</html>

<?php

$result->close();
$conn->close();

?>