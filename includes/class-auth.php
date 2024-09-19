<?php
    class Auth{
        public $database;

        // Run this code when the object is created
        function __construct(){
            $this->database = connectToDB();
        }

        public function login(){
            // Storing the details the user has entered in the login page
            $email = $_POST["email"];
            $password = $_POST["password"];

            // Check if the user has filled all fields
            if(empty($email) || empty($password)){
                setError("Please ensure all fields are filled!", "/login" );
            // Carry out login process if the above check has passed
            } else {
                // Check if the email entered is in the database
                // SQL Command (Recipe)
                $sql = "SELECT * FROM users WHERE email = :email";
                // Prepare SQL query (Prepare Ingredients)
                $query = $this->database->prepare($sql);
                // Execute SQL query (Cook)
                $query->execute([
                    'email' => $email
                ]);
                // Fetch results (Eat)
                $user = $query->fetch();
                
                // Check if the user exists in the database
                if ($user) {
                    // Check if the password is correct
                    if (password_verify($password, $user["password"])){
                        // Login the user if the above check has passed
                        $_SESSION['user'] = $user;
                        // Redirect the user back to home.php after the process
                        header("Location: /home");
                        exit;
                    // If the password is wrong
                    } else {
                        setError("The password is incorrect, try again!", "/login" ); 
                    }
                // If the email is not in the database
                } else {
                    setError("Email does not exist, try again!", "/login" ); 
                }
            }
        }   

        public function signup(){
            // Storing the details the user has entered in the sign-up page
            $name = $_POST["name"];
            $email = $_POST["email"];
            $password = $_POST["password"];
            $confirm_password = $_POST["confirm_password"];

            // Check if the user has filled all fields
            if(empty($name) || empty($email) || empty($password) || empty($confirm_password)){
                setError("Please ensure all the fields are filled up!", "/signup");
            // Check if the user's password matches the confirm password
            } else if($password !== $confirm_password){
                setError("Your password does not match the confirmation, try again!", "/signup");
            // Check if the password is at least 8 characters long or more
            } else if(strlen($password) < 8){
                setError("Please ensure your password is 8 characters or more!", "/signup");
            // Update the database with the new user and their details if all above checks have passed
            } else {
                // SQL Command (Recipe)
                $sql = "INSERT INTO users (`name`, `email`, `password`) VALUES (:name, :email, :password)";
                // Prepare SQL query (Prepare Ingredients)
                $query = $this->database->prepare($sql);
                // Execute SQL query (Cook)
                $query->execute([
                    'name' => $name,
                    'email' => $email,
                    'password' => password_hash($password, PASSWORD_DEFAULT)
                ]);
                // Redirect user back to login.php
                header("Location: /login");
                exit;
            }
        }

        public function logout()
        {
            // Remove the user from the session
            unset( $_SESSION['user'] );
            // Redirect the user back to home.php
            header("Location: /");
            exit;
        }
    }
?>
