
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/style.css">
    <title>Student Registration Form</title>
</head>
<body>

    <h1>Student Registration Form</h1>

    <form action="process.php" method="POST">

        <label>Full Name</label><br>
        <input type="text" name="name" required>
        <br><br>

        <label>Address</label><br>
        <textarea name="address" required></textarea>
        <br><br>

        <label>Gender</label><br>
        <input type="radio" name="gender" value="Male" required>
        Male

        <input type="radio" name="gender" value="Female">
        Female
        <br><br>

        <label>Religion</label><br>
        <select name="religion" required>
            <option value="">-- Select Religion --</option>
            <option value="Islam">Islam</option>
            <option value="Christianity">Christianity</option>
            <option value="Catholicism">Catholicism</option>
            <option value="Hinduism">Hinduism</option>
            <option value="Buddhism">Buddhism</option>
            <option value="Confucianism">Confucianism</option>
        </select>
        <br><br>

        <label>Previous School</label><br>
        <input type="text" name="previous_school" required>
        <br><br>

        <button type="submit" name="register">
            Register
        </button>

    </form>

    <br>

    <a href="index.php">Back to Homepage</a>

</body>
</html>
