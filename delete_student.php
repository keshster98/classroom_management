<?php 
    $host = 'localhost';
    $database_name = "classroom_management";
    $database_user = "root";
    $database_password = "123";

    $database = new PDO(
        "mysql:host=$host;dbname=$database_name",
        $database_user,
        $database_password
    );

    // Storing the student id
    $student_id = $_POST["student_id"];

    // Delete student name from database

    // SQL Command (Recipe)
    $sql = "DELETE FROM students where id = :id"; //:name where : acts as a placeholder, haven't used the variable yet.

    // Prepare SQL query (Prepare Ingredients)
    $query = $database->prepare($sql);

    // Execute SQL query (Cook)
    $query->execute([
        'id' => $student_id
    ]);

    // Redirect user back to index.php after the process
    header("Location: index.php");
    exit;
?>



