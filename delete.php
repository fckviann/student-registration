
<?php

include("config/database.php");

// Check whether the request uses POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die("Invalid request!");
}

// Get student ID
if (!isset($_POST['id']) || !ctype_digit($_POST['id'])) {
    die("Invalid student ID!");
}

$studentId = (int) $_POST['id'];

// Delete student
$sql = "DELETE FROM students WHERE id = ?";
$stmt = mysqli_prepare($conn, $sql);

mysqli_stmt_bind_param($stmt, "i", $studentId);

if (mysqli_stmt_execute($stmt)) {

    header("Location: students.php");
    exit();

} else {

    echo "Delete failed: " . mysqli_stmt_error($stmt);

}

mysqli_stmt_close($stmt);

?>
