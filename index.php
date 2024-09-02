<?php
  // Collect database info
  $host = 'localhost'; // For Windows user
  $database_name = "classroom_management"; // Connecting to a specific database 
  $database_user = "root";
  $database_password = "123";

  // Connect to database (PDO - PHP database object)
  $database = new PDO(
    "mysql:host=$host;dbname=$database_name",
    $database_user, // Username
    $database_password // Password
  );

  // Get students data from the database

  // SQL Command (Recipe)
  $sql = "SELECT * FROM students";
  // Prepare SQL query (Prepare Ingredients)
  $query = $database->prepare($sql); // "->" = pointing at/using it
  // Execute SQL query (Cook)
  $query->execute();
  // Fetch results (Eat)
  $students = $query->fetchAll();
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Classroom Management</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css"
    />
    <style type="text/css">
      body {
        background: #f1f1f1;
      }
    </style>
  </head>
  <body>
    <div class="card rounded shadow-sm mx-auto my-4" style="max-width: 500px">
      <div class="card-body">
        <h3 class="card-title mb-3">My Classroom</h3>
        <!-- Add -->
        <form method="POST" action="add_student.php">
          <div class="mt-4 d-flex justify-content-between align-items-center">
            <input type="text" class="form-control" placeholder="Add new student" name="student_name"/>
            <button class="btn btn-primary rounded ms-2">Add</button>
          </div>
        </form>
      </div>
    </div>
    <div class="card rounded shadow-sm mx-auto my-4" style="max-width: 500px">
      <div class="card-body">
        <h3 class="card-title mb-3">Students</h3>
        <?php foreach ($students as $index => $student) : ?>
          <div class="d-flex justify-content-between align-items-center mt-3">
            <h5 class="me-1"><?= $index+1; ?>.</h5>
            <div class="d-flex flex-grow-1 gap-2 align-items-center">
              <!-- Update -->
              <form method="POST" action="update_student.php" class="d-flex flex-grow-1">
                <input type="text" class="form-control me-2" name="student_name" placeholder="<?= $student["name"]; ?>" />
                <input type="hidden" name="student_id" value="<?= $student["id"]; ?>" />
                <button class="btn btn-success">Update</button>
              </form>
              <!-- Delete -->
              <form method="POST" action="delete_student.php">
                <input type="hidden" name="student_id" value="<?= $student["id"]; ?>" />
                <button class="btn btn-danger">Delete</button>
              </form>  
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>