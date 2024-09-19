<?php

  session_start();
  
  // Load the functions
  require 'includes/functions.php';
  // Load the class files
  require 'includes/class-auth.php';
  require 'includes/class-student.php';
  // Initialize the classes
  $auth = new Auth();
  $student = new Student();
  // Figure out the url the user is visiting
  $path = $_SERVER["REQUEST_URI"];
  // Remove all the query strings (remove ? from edit)
  $path = parse_url($path, PHP_URL_PATH);

  switch ($path) {
    // Pages
    case '/login':
      require 'pages/login.php';
      break;
    case '/signup':
      require 'pages/signup.php';
      break;
    case'/logout';
      $auth->logout();
      break;
    // Student
    case '/student/add':
      $student->add();
      break;
    case '/student/edit':
      $student->update();
      break;
    case '/student/delete':
      $student->delete();
      break;
    // Auth
    case '/auth/login':
      $auth->login();
      break;
    case '/auth/signup':
      $auth->signup();
      break;
    // Default
    default:
      require 'pages/home.php';
      break;
  }
?>