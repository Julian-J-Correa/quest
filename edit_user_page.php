<?php

session_start();

if (!isset($_SESSION['adminpassword']) || !isset($_SESSION['adminname'])) {
    header("Location: login_page.php");
    exit;
}

$conn = new mysqli("localhost", "root", "", "quest_test");

$id = intval($_GET['id']);

$selectStmt = $conn->prepare(
    "SELECT * FROM users WHERE UserID = ?"
);

$selectStmt->bind_param("i", $id);
$selectStmt->execute();

$result = $selectStmt->get_result();
$row = $result->fetch_assoc();

$updateStmt = $conn->prepare(
        "UPDATE users
         SET Username = ?, Email = ?, Password = ?
         WHERE UserID = ?"
    );

if (isset($_POST['update'])) {

    $id = intval($_POST['id']);
    $username = $_POST['username'];
    $email = $_POST['email'];
    $userpassword = $_POST['userpassword'];

    $updateStmt->bind_param(
        "sssi",
        $username,
        $email,
        $userpassword,
        $id
    );

    if ($updateStmt->execute()) {
        header("Location: users_page.php");
        exit;
    } else {
        echo "Update failed";
    }
}

?>

<form method="post">

    <input type="hidden" name="id" value="<?php echo $row['UserID']; ?>">

    <h4 style="color: green">Username</h4>
    <input type="text" name="username" value="<?php echo htmlspecialchars($row['Username']); ?>">

    <br><br>

    <h4 style="color: green">email</h4>
    <input type="text" name="email" value="<?php echo htmlspecialchars($row['Email']); ?>">

    <br><br>

    <h4 style="color: green">Password</h4>
    <input type="text" name="userpassword" value="<?php echo htmlspecialchars($row['Password']); ?>">

    <br><br>

    <input type="submit" name="update" value="Update">

</form>