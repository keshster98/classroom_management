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

    // Storing new student name
    $name = $_POST["student_name"];
    
    // Check if the user inserts a name
    if(empty($name)){
        // If there is no name, user gets an alert
        echo '<script>alert("Please insert a name!");history.go(-1);</script>';
    }
    else{
        // If there is a name, add student name to database

        // SQL Command (Recipe)
        $sql = 'INSERT INTO students (`name`) VALUES (:name)';

        // Prepare SQL query (Prepare Ingredients)
        $query = $database->prepare($sql);

        // Execute SQL query (Cook)
        $query->execute([
            'name' => $name
        ]);

        // Redirect user back to index.php after the process
        header("Location: index.php");
        exit;
    }
?>