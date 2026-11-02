
<?php
include("config/database.php");

// Retrieve all students
$sql = "SELECT * FROM students ORDER BY id DESC";
$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/style.css">
    <title>Registered Students</title>
</head>
<body>

    <h1>Registered Students</h1>

    <a href="registration.php">Register New Student</a>
    <br><br>

    <table border="1" cellpadding="10" cellspacing="0">

        <thead>
            <tr>
                <th>No.</th>
                <th>Name</th>
                <th>Address</th>
                <th>Gender</th>
                <th>Religion</th>
                <th>Previous School</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>

            <?php
            $number = 1;

            while ($student = mysqli_fetch_assoc($result)) {
            ?>

                <tr>
                    <td><?php echo $number++; ?></td>

                    <td>
                        <?php echo htmlspecialchars($student['name']); ?>
                    </td>

                    <td>
                        <?php echo htmlspecialchars($student['address']); ?>
                    </td>

                    <td>
                        <?php echo htmlspecialchars($student['gender']); ?>
                    </td>

                    <td>
                        <?php echo htmlspecialchars($student['religion']); ?>
                    </td>

                    <td>
                        <?php echo htmlspecialchars($student['previous_school']); ?>
                    </td>

                    <td>
                        <a href="edit.php?id=<?php echo $student['id']; ?>">
                            Edit
                        </a>

                        <form action="delete.php" method="POST"
                              style="display:inline;"
                              onsubmit="return confirm('Are you sure you want to delete this student?');">

                            <input type="hidden" name="id"
                                   value="<?php echo $student['id']; ?>">

                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>

            <?php
            }
            ?>

        </tbody>

    </table>

    <br>
    <a href="index.php">Back to Homepage</a>

</body>
</html>
