<?php

session_start();

if (!isset($_SESSION['password'])) {
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
    <input type="checkbox" name="byChoice" value="1" <?php echo ($row['ByChoice'] == 1) ? 'checked' : ''; ?>
>

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