<?php
  // Connecting to database   
  $database = connectToDB();

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
<?php require "parts/header.php"?>
  <div class="card rounded shadow-sm mx-auto my-4" style="max-width: 500px">
    <div class="card-body">
      <h3 class="card-title mb-3">My Classroom</h3>
      <!-- Show this section if user has logged in -->
      <?php if(isset($_SESSION['user'])) : ?>
        <h4>Welcome back, <?= $_SESSION['user']['name']; ?>!</h4>
        <a href="/logout">Logout</a>
        <form method="POST" action="/student/add">
          <div class="mt-4 d-flex justify-content-between align-items-center">
            <input type="text" class="form-control" placeholder="Add new student" name="student_name"/>
            <button class="btn btn-primary rounded ms-2">Add</button>
          </div>
        </form>
        <!-- Show this section if user not logged in -->
      <?php else : ?>
        <a href="/login">Login</a>
        <a href="/signup">Sign Up</a>
      <?php endif; ?>
    </div>
  </div>
  <!-- Show this section if user has logged in -->
  <?php if(isset($_SESSION['user'])) : ?>    
    <div class="card rounded shadow-sm mx-auto my-4" style="max-width: 500px">
      <div class="card-body">
        <h3 class="card-title mb-3">Students</h3>
        <?php require "parts/error_box.php"?>
        <?php foreach ($students as $index => $student) : ?>
          <div class="d-flex justify-content-between align-items-center mt-3">
            <h5 class="me-1"><?= $index+1; ?>.</h5>
            <div class="d-flex flex-grow-1 gap-2 align-items-center">
              <!-- Update -->
              <form method="POST" action="/student/edit" class="d-flex flex-grow-1">
                <input type="text" class="form-control me-2" name="student_name" placeholder="<?= $student["name"]; ?>" />
                <input type="hidden" name="student_id" value="<?= $student["id"]; ?>" />
                <button class="btn btn-success">Update</button>
              </form>
              <!-- Delete -->
              <form method="POST" action="/student/delete">
                <input type="hidden" name="student_id" value="<?= $student["id"]; ?>" />
                <button class="btn btn-danger">Delete</button>
              </form>  
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  <?php endif; ?>
<?php require "parts/footer.php"?>