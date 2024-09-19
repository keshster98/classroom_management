<?php
    class Student{
        public $database;

        // Run this code when the object is created
        function __construct(){
            $this->database = connectToDB();
        }

        public function add (){
            // Storing new student name
            $name = $_POST["student_name"];
            
            // Check if the user inserts a name
            if(empty($name)){
                // If there is no name, user gets an alert
                setError("Please insert a name!", "/home");
            }
            // Add student name to database if the above check has passed
            else{
                // SQL Command (Recipe)
                $sql = 'INSERT INTO students (`name`) VALUES (:name)';
                // Prepare SQL query (Prepare Ingredients)
                $query = $this->database->prepare($sql);
                // Execute SQL query (Cook)
                $query->execute([
                    'name' => $name
                ]);
                // Redirect user back to home.php after the process
                header("Location: /home");
                exit;
            }
        }

        public function delete(){
            // Storing the student id
            $student_id = $_POST["student_id"];

            // Delete student name from database
            // SQL Command (Recipe)
            $sql = "DELETE FROM students where id = :id";
            // Prepare SQL query (Prepare Ingredients)
            $query = $this->database->prepare($sql);
            // Execute SQL query (Cook)
            $query->execute([
                'id' => $student_id
            ]);
            // Redirect user back to home.php after the process
            header("Location: /home");
            exit;
        }

        public function update(){
            // Storing the student name to be updated and their id
            $name = $_POST["student_name"];
            $id = $_POST["student_id"];

            // Check if the textbox to input an update for the student name is filled
            if (empty($name)) {
                setError("Please insert an updated name!", "/home");
            // Update the student name in the database if the above check has passed
            } else {
                // SQL Command (Recipe)
                $sql = "UPDATE students SET name = :name WHERE id = :id";
                // Prepare SQL query (Prepare Ingredients)
                $query = $this->database->prepare($sql);
                // Execute SQL query (Cook)
                $query->execute([
                    'name' => $name,
                    'id' => $id
                ]);        
                // Redirect user back to index.php after the process
                header("Location: /home");
                exit;
            }
        }
    }
?>