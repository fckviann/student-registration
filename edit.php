
<?php
include("config/database.php");

// Get student ID
if (!isset($_GET['id']) || !ctype_digit($_GET['id'])) {
    die("Invalid student ID!");
}

$studentId = (int) $_GET['id'];

// Retrieve student data
$sql = "SELECT * FROM students WHERE id = ?";
$stmt = mysqli_prepare($conn, $sql);

mysqli_stmt_bind_param($stmt, "i", $studentId);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);
$student = mysqli_fetch_assoc($result);

if (!$student) {
    die("Student not found!");
}

// Process update form
if (isset($_POST['update'])) {

    $name = trim($_POST['name']);
    $address = trim($_POST['address']);
    $gender = $_POST['gender'];
    $religion = $_POST['religion'];
    $previousSchool = trim($_POST['previous_school']);

    if (
        $name === "" ||
        $address === "" ||
        !in_array($gender, ["Male", "Female"], true) ||
        !in_array($religion, [
            "Islam", "Christianity", "Catholicism",
            "Hinduism", "Buddhism", "Confucianism"
        ], true) ||
        $previousSchool === ""
    ) {
        die("Please enter valid data in all fields!");
    }

    $sql = "UPDATE students SET
            name = ?,
            address = ?,
            gender = ?,
            religion = ?,
            previous_school = ?
            WHERE id = ?";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param(
        $stmt,
        "sssssi",
        $name,
        $address,
        $gender,
        $religion,
        $previousSchool,
        $studentId
    );

    if (mysqli_stmt_execute($stmt)) {
        header("Location: students.php");
        exit();
    } else {
        echo "Update failed: " . mysqli_stmt_error($stmt);
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="assets/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student</title>
</head>
<body>

    <h1>Edit Student Data</h1>

    <form method="POST">

        <label>Full Name</label><br>
        <input type="text" name="name"
               value="<?php echo htmlspecialchars($student['name']); ?>"
               required>
        <br><br>

        <label>Address</label><br>
        <textarea name="address" required><?php
            echo htmlspecialchars($student['address']);
        ?></textarea>
        <br><br>

        <label>Gender</label><br>

        <input type="radio" name="gender" value="Male"
            <?php echo ($student['gender'] == 'Male') ? 'checked' : ''; ?>
            required>
        Male

        <input type="radio" name="gender" value="Female"
            <?php echo ($student['gender'] == 'Female') ? 'checked' : ''; ?>>
        Female

        <br><br>

        <label>Religion</label><br>

        <select name="religion" required>
            <?php
            $religions = [
                "Islam", "Christianity", "Catholicism",
                "Hinduism", "Buddhism", "Confucianism"
            ];

            foreach ($religions as $religionOption) {
                $selected = ($student['religion'] == $religionOption)
                    ? 'selected'
                    : '';

                echo "<option value='" . htmlspecialchars($religionOption)
                    . "' $selected>"
                    . htmlspecialchars($religionOption)
                    . "</option>";
            }
            ?>
        </select>

        <br><br>

        <label>Previous School</label><br>
        <input type="text" name="previous_school"
               value="<?php echo htmlspecialchars($student['previous_school']); ?>"
               required>
        <br><br>

        <button type="submit" name="update">Update Student</button>

    </form>

    <br>
    <a href="students.php">Back to Student List</a>

</body>
</html>
