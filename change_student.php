<!DOCTYPE html>
<div class="navbar" style="background-color: #f1f1f1; padding: 10px; text-align: center;">
    <span class="datetime" style="font-size: 18px; font-weight: bold;"><?php echo date('F j, Y - H:i'); ?></span>
    <div class="menu">
        <a href="index.php" style="display: inline-block; padding: 10px; margin: 0 5px; text-decoration: none; color: #333; font-weight: bold;">Home</a>
        <a href="change_student.php" style="display: inline-block; padding: 10px; margin: 0 5px; text-decoration: none; color: #333; font-weight: bold;">Change Student Grades</a>
        <a href="add_student.php" style="display: inline-block; padding: 10px; margin: 0 5px; text-decoration: none; color: #333; font-weight: bold;">Add Student and Grades</a>
    </div>
</div>

    

<html>
<head>
    <title>Change Student Grades</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }
        
        .container {
            max-width: 500px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
        }
        
        .container h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }
        
        .form-group input[type="text"],
        .form-group select {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        
        .form-group input[type="submit"] {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: none;
            background-color: #4caf50;
            color: #fff;
            cursor: pointer;
        }
        
        .success-message {
            background-color: #dff0d8;
            color: #3c763d;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <?php
    // Database configuration
    $host = 'localhost';
    $port = 3307;
    $dbname = 'student_database';
    $username = 'root';
    $password = '1234';

    try {
        // Create a new PDO instance
        $conn = new PDO("mysql:host=$host;port=$port;dbname=$dbname", $username, $password);

        // Set PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Retrieve student data from the database
        $query = "SELECT * FROM students";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $students = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        die();
    }

    // Handle form submission
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $studentId = $_POST['student'];
        $mathGrade = $_POST['math_grade'];
        $historyGrade = $_POST['history_grade'];
        $biologyGrade = $_POST['biology_grade'];
        $musicGrade = $_POST['music_grade'];
        $geographyGrade = $_POST['geography_grade'];

        try {
            // Update the grades for the selected student
            $query = "UPDATE students SET math_grade = :math_grade, history_grade = :history_grade, biology_grade = :biology_grade, music_grade = :music_grade, geography_grade = :geography_grade WHERE student_id = :student_id";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':math_grade', $mathGrade);
            $stmt->bindParam(':history_grade', $historyGrade);
            $stmt->bindParam(':biology_grade', $biologyGrade);
            $stmt->bindParam(':music_grade', $musicGrade);
            $stmt->bindParam(':geography_grade', $geographyGrade);
            $stmt->bindParam(':student_id', $studentId);
            $stmt->execute();

            // Set the success message
            $success = true;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            die();
        }
    }
    ?>

    <div class="container">
        <h1>Change Student Grades</h1>
        
        <?php if (isset($success) && $success) : ?>
            <div class="success-message">
                Grades updated successfully.
            </div>
        <?php endif; ?>
        
        <form method="POST">
            <div class="form-group">
                <label for="student">Select Student:</label>
                <select name="student" id="student">
                    <option value="">Select a student</option>
                    <?php foreach ($students as $student) : ?>
                        <option value="<?php echo $student['student_id']; ?>"><?php echo $student['name']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            
            <div class="form-group">
                <label for="math_grade">Math Grade:</label>
                <input type="text" name="math_grade" id="math_grade" required>
            </div>
            
            <div class="form-group">
                <label for="history_grade">History Grade:</label>
                <input type="text" name="history_grade" id="history_grade" required>
            </div>
            
            <div class="form-group">
                <label for="biology_grade">Biology Grade:</label>
                <input type="text" name="biology_grade" id="biology_grade" required>
            </div>
            
            <div class="form-group">
                <label for="music_grade">Music Grade:</label>
                <input type="text" name="music_grade" id="music_grade" required>
            </div>
            
            <div class="form-group">
                <label for="geography_grade">Geography Grade:</label>
                <input type="text" name="geography_grade" id="geography_grade" required>
            </div>
            
            <div class="form-group">
                <input type="submit" value="Update Grades">
            </div>
        </form>
    </div>
</body>
</html>
