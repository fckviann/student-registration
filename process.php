
<?php

include("config/database.php");

// Check whether the form was submitted
if (isset($_POST['register'])) {

    // Retrieve form data
    $name = trim($_POST['name']);
    $address = trim($_POST['address']);
    $gender = $_POST['gender'];
    $religion = $_POST['religion'];
    $previousSchool = trim($_POST['previous_school']);

    // Validate input
    if (
        $name === "" ||
        $address === "" ||
        $gender === "" ||
        $religion === "" ||
        $previousSchool === ""
    ) {
        die("All fields are required!");
    }

    // Prepare SQL statement
    $sql = "INSERT INTO students
            (name, address, gender, religion, previous_school)
            VALUES (?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param(
        $stmt,
        "sssss",
        $name,
        $address,
        $gender,
        $religion,
        $previousSchool
    );

    // Execute query
    if (mysqli_stmt_execute($stmt)) {

        header("Location: students.php");
        exit();

    } else {
        echo "Registration failed: " . mysqli_stmt_error($stmt);
    }

    mysqli_stmt_close($stmt);

} else {
    echo "Invalid request!";
}

?>
