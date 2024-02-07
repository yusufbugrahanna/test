<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $studentID = $_POST['student_id'];
    $password = $_POST['password'];

    // TODO: Validate and sanitize the input data

    // Create a PDO instance and establish a database connection
    $dsn = "mysql:host=localhost;port=3307;dbname=student_database;charset=utf8mb4";
    $username = "root";
    $dbPassword = "1234";
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ];

    try {
        $conn = new PDO($dsn, $username, $dbPassword, $options);

        // Prepare the SQL statement
        $sql = "SELECT * FROM students WHERE student_id = :student_id";
        $stmt = $conn->prepare($sql);

        // Bind the parameter
        $stmt->bindParam(':student_id', $studentID);

        // Execute the statement
        $stmt->execute();

        // Fetch the student record
        $student = $stmt->fetch();

        // Verify the password
        if ($student) {
    $hashedPassword = $student['password'];

    if ($password === $hashedPassword) {
        // Passwords match, proceed with login

        // Redirect to the grades page with the student's ID
        header("Location: grades.php?student_id=" . $student['student_id']);
        exit();
    } else {
        // Invalid password
        $error = "Invalid password.";
    }
} else {
    // Student record not found
    $error = "Invalid student ID.";
}

        // Close the database connection
        $conn = null;
    } catch (PDOException $e) {
        // Display error message
        echo "Error: " . $e->getMessage();
    }
}

// Check if the registration form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register'])) {
    // Retrieve form data
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $studentID = $_POST['student_id'];
    $password = $_POST['password'];

    // TODO: Validate and sanitize the input data

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Create a PDO instance and establish a database connection
    $dsn = "mysql:host=localhost;port=3307;dbname=student_database;charset=utf8mb4";
    $username = "root";
    $dbPassword = "2245245789a";
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ];

    try {
        $conn = new PDO($dsn, $username, $dbPassword, $options);

        // Prepare the SQL statement
        $sql = "INSERT INTO students (name, surname, student_id, password) VALUES (:name, :surname, :student_id, :password)";
        $stmt = $conn->prepare($sql);

        // Bind the parameters
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':surname', $surname);
               // Bind the parameters
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':surname', $surname);
        $stmt->bindParam(':student_id', $studentID);
        $stmt->bindParam(':password', $hashedPassword);

        // Execute the statement
        $stmt->execute();

        // Redirect to the grades page with the student's ID
header("Location: grades.php?student_id=" . $student['student_id']);
exit();

        // Close the database connection
        $conn = null;
    } catch (PDOException $e) {
        // Display error message
        echo "Error: " . $e->getMessage();
    }
}


?>
<!DOCTYPE html>
<html>

<head>
    <title>Student Grades</title>
   <style>
        body {
            background-color: #f2f2f2;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #ffffff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
            text-align: center;
        }

        h1 {
            color: #333333;
        }

        .logo {
            max-width: 200px;
            margin-bottom: 20px;
        }

        .login-form {
            text-align: center;
        }

        .login-form label {
            display: block;
            margin-bottom: 10px;
            color: #555555;
            font-weight: bold;
        }

        .login-form input[type="text"] {
            width: 200px;
            padding: 5px;
            font-size: 16px;
            border-radius: 3px;
            border: 1px solid #cccccc;
        }

        .login-form input[type="submit"] {
            padding: 10px 20px;
            font-size: 16px;
            background-color: #3366cc;
            color: #ffffff;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        .teacher-link {
            margin-top: 20px;
        }

        .teacher-link a {
            color: #3366cc;
            text-decoration: none;
        }

        .teacher-link a:hover {
            text-decoration: underline;
        }

        .error-message {
            color: red;
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <div class="container">
        <img src="https://upload.wikimedia.org/wikipedia/commons/4/4e/VU_Logo.png" alt="Logo" class="logo">
        <h1>Student Grades</h1>
        <?php if (isset($error)) : ?>
            <div class="error-message"><?php echo $error; ?></div>
        <?php endif; ?>
        <form class="login-form" action="index.php" method="POST">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required><br><br>

            <label for="surname">Surname:</label>
            <input type="text" id="surname" name="surname" required><br><br>

            <label for="student_id">Student ID:</label>
            <input type="text" id="student_id" name="student_id" required><br><br>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required><br><br>

            <input type="submit" value="Login">
        </form>

        <div class="teacher-link">
            <a href="teacher.php">Teacher Site</a>
        </div>
    </div>
</body>

</html>
