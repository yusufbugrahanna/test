<div class="navbar" style="background-color: #f1f1f1; padding: 10px; text-align: center;">
    <span class="datetime" style="font-size: 18px; font-weight: bold;"><?php echo date('F j, Y - H:i'); ?></span>
    <div class="menu">
        <a href="index.php" style="display: inline-block; padding: 10px; margin: 0 5px; text-decoration: none; color: #333; font-weight: bold;">Home</a>
        <a href="change_student.php" style="display: inline-block; padding: 10px; margin: 0 5px; text-decoration: none; color: #333; font-weight: bold;">Change Student Grades</a>
        <a href="add_student.php" style="display: inline-block; padding: 10px; margin: 0 5px; text-decoration: none; color: #333; font-weight: bold;">Add Student and Grades</a>
    </div>
</div>

    

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $studentID = $_POST['student_id'];
    $mathGrade = $_POST['math_grade'];
    $historyGrade = $_POST['history_grade'];
    $biologyGrade = $_POST['biology_grade'];
    $musicGrade = $_POST['music_grade'];
    $geographyGrade = $_POST['geography_grade'];

    // TODO: Validate and sanitize the input data

    // Create a PDO instance and establish a database connection
    $dsn = "mysql:host=localhost;port=3307;dbname=student_database;charset=utf8mb4";
    $username = "root";
    $password = "1234";
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ];

    try {
        $conn = new PDO($dsn, $username, $password, $options);

        // Prepare the SQL statement
        $sql = "INSERT INTO students (name, surname, student_id, math_grade, history_grade, biology_grade, music_grade, geography_grade) 
                VALUES (:name, :surname, :student_id, :math_grade, :history_grade, :biology_grade, :music_grade, :geography_grade)";
        $stmt = $conn->prepare($sql);

        // Bind the parameters
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':surname', $surname);
        $stmt->bindParam(':student_id', $studentID);
        $stmt->bindParam(':math_grade', $mathGrade);
        $stmt->bindParam(':history_grade', $historyGrade);
        $stmt->bindParam(':biology_grade', $biologyGrade);
        $stmt->bindParam(':music_grade', $musicGrade);
        $stmt->bindParam(':geography_grade', $geographyGrade);

        // Execute the statement to insert the student and grades
        $stmt->execute();

        // Close the database connection
        $conn = null;

        // Set success message
        $success = true;
    } catch (PDOException $e) {
        // Display error message
        echo "Error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Add Student and Grades</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 500px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            background-color: #f9f9f9;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        input[type="text"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .btn {
            display: inline-block;
            padding: 8px 16px;
            font-size: 14px;
            font-weight: bold;
            text-align: center;
            text-decoration: none;
            cursor: pointer;
            color: #fff;
            background-color: #007bff;
            border: none;
            border-radius: 4px;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        .success-message {
            margin-top: 20px;
            padding: 10px;
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
            border-radius: 4px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Add Student and Grades</h1>

        <?php if (isset($success) && $success) : ?>
            <div class="success-message">Student and grades added successfully.</div>
        <?php endif; ?>

        <form method="POST" action="add_student.php">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" name="name" required>
            </div>

            <div class="form-group">
                <label for="surname">Surname:</label>
                <input type="text" name="surname" required>
            </div>

            <div class="form-group">
                <label for="student_id">Student ID:</label>
                <input type="text" name="student_id" required>
            </div>

            <div class="form-group">
                <label for="math_grade">Math Grade:</label>
                <input type="text" name="math_grade" required>
            </div>

            <div class="form-group">
                <label for="history_grade">History Grade:</label>
                <input type="text" name="history_grade" required>
            </div>

            <div class="form-group">
                <label for="biology_grade">Biology Grade:</label>
                <input type="text" name="biology_grade" required>
            </div>

            <div class="form-group">
                <label for="music_grade">Music Grade:</label>
                <input type="text" name="music_grade" required>
            </div>

            <div class="form-group">
                <label for="geography_grade">Geography Grade:</label>
                <input type="text" name="geography_grade" required>
            </div>

            <div class="form-group">
                <button type="submit" class="btn">Add Student and Grades</button>
            </div>
        </form>
    </div>
</body>

</html>
