<?php
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Retrieve the student ID from the URL query string
    $student_id = $_GET['student_id'];

    // Connect to the database
    $servername = "localhost";
    $username = "root";
    $password = "1234";
    $dbname = "student_database";

    try {
        $conn = new PDO("mysql:host=$servername;port=3307;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Prepare and execute the query to retrieve student's grades
        $stmt = $conn->prepare("SELECT * FROM students WHERE student_id = :student_id");
        $stmt->bindParam(':student_id', $student_id);
        $stmt->execute();

        $students = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($students) {
            // Display the student's grades
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
                    table {
                        width: 100%;
                        margin-top: 20px;
                        border-collapse: collapse;
                    }
                    table th, table td {
                        padding: 10px;
                        text-align: left;
                    }
                    table th {
                        background-color: #3366cc;
                        color: #ffffff;
                    }
                </style>
            </head>
            <body>
                <div class="container">
                    <h1>Student Grades</h1>
                    <?php foreach ($students as $student) { ?>
                    <h2><?php echo "{$student['name']} {$student['surname']} (ID: {$student['student_id']})"; ?></h2>
                    <table>
                        <tr><th>Class</th><th>Grade</th></tr>
                        <tr><td>Math</td><td><?php echo $student['math_grade']; ?></td></tr>
                        <tr><td>History</td><td><?php echo $student['history_grade']; ?></td></tr>
                        <tr><td>Biology</td><td><?php echo $student['biology_grade']; ?></td></tr>
                        <tr><td>Music</td><td><?php echo $student['music_grade']; ?></td></tr>
                        <tr><td>Geography</td><td><?php echo $student['geography_grade']; ?></td></tr>
                    </table>
                    <?php } ?>
                </div>
            </body>
            </html>
            <?php
        } else {
            echo "No student found with the given ID.";
        }
    } catch (PDOException $e) {
        echo "Database connection failed: " . $e->getMessage();
    }
}
?>
