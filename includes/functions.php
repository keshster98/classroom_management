<?php
    // Function to connect to database
    function connectToDB() {
        // Setup database credential
        $host = 'localhost'; // For Windows user
        $database_name = "classroom_management"; // Connecting to a specific database 
        $database_user = "root"; // MySQL Username
        $database_password = "123"; // MySQL Password
        // Connect to database (PDO - PHP database object)
        $database = new PDO(
            "mysql:host=$host;dbname=$database_name",
            $database_user, 
            $database_password 
        );
        return $database;
    }
    // Function to add error messages
    function setError($message, $path){
        $_SESSION["error"] = $message;
        // Redirect user to a specific page
        header("Location: ".$path);
        exit;
    }
    // Function to add success messages
    function setSuccess($message, $path){
        $_SESSION["success"] = $message;
        // Redirect user to a specific page
        header("Location: ".$path);
        exit;
    }
?>