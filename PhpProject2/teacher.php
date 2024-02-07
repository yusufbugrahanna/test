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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Virtual University - Teacher Panel</title>
    <style>
        body {
            background-color: #f1f1f1;
            font-family: Arial, Helvetica, sans-serif;
            margin: 0;
            padding: 0;
        }
        .header {
            background-color: #333;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
        }
        .header h1 {
            margin: 0;
        }
        .header a {
            color: white;
            text-decoration: none;
            padding: 5px;
        }
        .header a:hover {
            background-color: #555;
        }
        .container {
            margin: 50px auto;
            max-width: 800px;
            background-color: white;
            border-radius: 5px;
            padding: 20px;
            box-shadow: 0px 0px 5px 0px rgba(0,0,0,0.75);
        }
        .button-container {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }
        .button-container a {
            background-color: #333;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            margin: 0 10px;
            font-weight: bold;
        }
        .button-container a:hover {
            background-color: #555;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Virtual University</h1>
    </div>
    <div class="container">
        <h2>Teacher Panel</h2>
        <div class="button-container">
            <a href="add_student.php">Add Student and Grades</a>
            <a href="change_student.php">Change Existing Student Grades</a>
        </div>
    </div>
</body>
</html>
