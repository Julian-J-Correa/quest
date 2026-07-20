<?php
session_start();
if ($_SESSION['adminpassword'] && $_SESSION['adminname']) {
    // bibbity bobbity boo
} else {
    $_SESSION['goto'] = 'users';
    header("Location: login_page.php");
    exit;
}
$dateMin = $_POST['dateMin'] ?? '';
$dateMax = $_POST['dateMax'] ?? '';
$nameSearch = $_POST['nameSearch'] ?? '';
$start = 0;
$page_rows = 10;
$page_selected = 0;

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "quest_test";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Failed connection: " . $conn->connect_error);
}

$record_count = $conn->query("SELECT * FROM users");
$num_of_rows = $record_count->num_rows;
$pages = ceil($num_of_rows / $page_rows);
if (isset($_GET['page-nr'])) {
    $page_selected = $_GET['page-nr'] - 1;
    $start = $page_selected * $page_rows;
    $page_id = $_GET['page-nr'];
} else {
    $page_id = 1;
    $page_selected = 1;
}

if (empty($nameSearch)) {
    if (!empty($dateMin) && !empty($dateMax)) {

        $stmt = $conn->prepare(
            "SELECT * FROM users
         WHERE DateCreated BETWEEN ? AND ?
         ORDER BY DateCreated
         LIMIT $start, $page_rows"
        );

        $stmt->bind_param("ss", $dateMin, $dateMax);

    } elseif (!empty($dateMin) && empty($dateMax)) {

        $stmt = $conn->prepare(
            "SELECT * FROM users
         WHERE DateCreated >= ?
         ORDER BY DateCreated
         LIMIT $start, $page_rows"
        );

        $stmt->bind_param("s", $dateMin);

    } elseif (!empty($dateMax) && empty($dateMin)) {

        $stmt = $conn->prepare(
            "SELECT * FROM users
         WHERE DateCreated <= ?
         ORDER BY DateCreated
         LIMIT $start, $page_rows"
        );

        $stmt->bind_param("s", $dateMax);

    } else {

        $stmt = $conn->prepare(
            "SELECT * FROM users
         ORDER BY DateCreated
         LIMIT $start, $page_rows"
        );

    }
} else {
    if (!empty($dateMin) && !empty($dateMax)) {

        $stmt = $conn->prepare(
            "SELECT * FROM users
         WHERE DateCreated BETWEEN ? AND ?
         AND Username LIKE CONCAT('%', ?, '%')
         ORDER BY DateCreated
         LIMIT $start, $page_rows"
        );

        $stmt->bind_param("sss", $dateMin, $dateMax, $nameSearch);

    } elseif (!empty($dateMin) && empty($dateMax)) {

        $stmt = $conn->prepare(
            "SELECT * FROM users
         WHERE DateCreated >= ? AND Username LIKE CONCAT('%', ?, '%')
         ORDER BY DateCreated
         LIMIT $start, $page_rows"
        );

        $stmt->bind_param("ss", $dateMin, $nameSearch);

    } elseif (!empty($dateMax) && empty($dateMin)) {

        $stmt = $conn->prepare(
            "SELECT * FROM users
         WHERE DateCreated <= ? AND Username LIKE CONCAT('%', ?, '%')
         ORDER BY DateCreated
         LIMIT $start, $page_rows"
        );

        $stmt->bind_param("ss", $dateMax, $nameSearch);

    } else {

        $stmt = $conn->prepare(
            "SELECT * FROM users
         WHERE Username LIKE CONCAT('%', ?, '%')
         ORDER BY DateCreated
         LIMIT $start, $page_rows"
        );

        $stmt->bind_param("s", $nameSearch);
    }
}

if ($stmt->execute()) {
    $usertable = $stmt->get_result();
} else {
    echo "Error code: " . $stmt->error;
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
            <h1>"<p class="fw-bolder">User Table</p>
            </h1>
            <p class="lead">This table contains all users who can access the questionaire data as well as this table</p>
        </div>
    </header>
    <div class="text-center" style="color: green">
        <a href="add_page.php" class="btn btn-success btn-lrg">
            Add User
        </a><br><br>
        <form action="users_page.php" method="post">
            <h4>
                <p style="color: green">Search for name</p>
            </h4>
            <input type="text" name="nameSearch">
            <h4>
                <p style="color: green">Max Date</p>
            </h4>
            <input type="date" name="dateMax" value="<?php echo htmlspecialchars($_POST['dateMax'] ?? ''); ?>"
                max="<?php echo date('Y-m-d'); ?>">
            <h4>
                <p style="color: green">Min Date</p>
            </h4>
            <input type="date" name="dateMin" value="<?php echo htmlspecialchars($_POST['dateMin'] ?? ''); ?>">
            <br><br>
            <input type="submit" value="Filter" class="btn btn-lg btn-light border border-primary">
            <br><br>
        </form>
    </div>
    <div class="row top-buffer">
        <div class="col-md-12">
            <table id="myTable" class="table table-striped top-buffer">
                <thead>
                    <tr>
                        <th>
                            UserID
                        </th>
                        <th>
                            Username
                        </th>
                        <th>
                            Email
                        </th>
                        <th>
                            Password
                        </th>
                        <th>
                            Date Created
                        </th>
                        <th>
                            Actions
                        </th>
                </thead>
                </tr>

                <tr>
                    <?php while ($row = $usertable->fetch_object()) { ?>
                        <tbody>
                            <td>
                                <?php echo $row->UserID ?>
                            </td>
                            <td>
                                <?php echo $row->Username ?>
                            </td>
                            <td>
                                <?php echo $row->Email ?>
                            </td>
                            <td>
                                <?php echo $row->Password ?>
                            </td>
                            <td>
                                <?php echo $row->DateCreated ?>
                            </td>
                            <td>
                                <a href="edit_user_page.php?id=<?php echo $row->UserID; ?>" class="btn btn-warning btn-sm">
                                    Edit
                                </a>
                                <a href="delete.php?id=<?php echo $row->UserID; ?>" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Are you sure you want to delete this record?');">
                                    Delete
                                </a>
                            </td>
                        </tbody>
                    <?php } ?>
                </tr>
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
            new DataTable("#myTable", {
                pageLength: 5,
                lengthMenu: [5, 10, 25, 50],
                searching: true,
                ordering: true,
                info: true
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

$stmt->close();
$conn->close();

?>