<?php
    // Connecting to database
    $host = 'localhost';
    $database_name = "classroom_management";
    $database_user = "root";
    $database_password = "123";

    $database = new PDO(
        "mysql:host=$host;dbname=$database_name",
        $database_user,
        $database_password
    );

    // Storing the student name to be updated and their id
    $name = $_POST["student_name"];
    $id = $_POST["student_id"];

    // Check if the textbox to input an update for the student name is filled
    if (empty($name)) {
        echo '<script>alert("Please insert an updated name!");window.location.href="index.php";</script>';
    // Update the student name in the database if the above check has passed
    } else {
        // SQL Command (Recipe)
        $sql = "UPDATE students SET name = :name WHERE id = :id";
        // Prepare SQL query (Prepare Ingredients)
        $query = $database->prepare($sql);
        // Execute SQL query (Cook)
        $query->execute([
            'name' => $name,
            'id' => $id
        ]);        
        // Redirect user back to index.php after the process
        header("Location: index.php");
        exit;
    }
?>