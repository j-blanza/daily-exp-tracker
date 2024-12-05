<?php
require('config.php');
if (isset($_REQUEST['firstname'])) {
  if ($_REQUEST['password'] == $_REQUEST['confirm_password']) {
    $firstname = stripslashes($_REQUEST['firstname']);
    $firstname = mysqli_real_escape_string($con, $firstname);
    $lastname = stripslashes($_REQUEST['lastname']);
    $lastname = mysqli_real_escape_string($con, $lastname);

    $email = stripslashes($_REQUEST['email']);
    $email = mysqli_real_escape_string($con, $email);


    $password = stripslashes($_REQUEST['password']);
    $password = mysqli_real_escape_string($con, $password);


    $trn_date = date("Y-m-d H:i:s");

    $query = "INSERT into `users` (firstname, lastname, password, email, trn_date) VALUES ('$firstname','$lastname', '" . md5($password) . "', '$email', '$trn_date')";
    $result = mysqli_query($con, $query);
    if ($result) {
      header("Location: login.php");
    }
  } else {
    echo ("ERROR: Please Check Your Password & Confirmation password");
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="shortcut icon" href="exp-tracker-logo.png" type=""image/x-icon">
  <link href="https://fonts.googleapis.com/css2?family=Gabarito:wght@400..900&display=swap" rel="stylesheet">
  <title>Register</title>

  <!-- Bootstrap core CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <style>
    html,body {
      color: #000;
      background: #fff;
      font-family: Gabarito;
      background-color: #f4f7fc;
      display: flex;
      justify-content: center;
      align-items: center;
    }


    .form-control:focus {
      border-color: #5cb85c;
    }

    .form-control {
      width: 93%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 5px;
      margin-bottom: 10px;
    }

    .btn {
      border-radius: 3px;
    }

    .signup-form {
      width: 450px;
      margin: 0 auto;
      padding: 30px 0;
      font-size: 15px;
      display: flex;
      flex-direction: column;
      align-items: center; 
      justify-content: center;
    }

    .signup-form h2 {
      color: #f4f7fc;
      margin: 0 0 15px;
      position: relative;
      text-align: center;
    }

    .signup-form h2:before,
    .signup-form h2:after {
      content: "";
      height: 2px;
      width: 30%;
      background: #d4d4d4;
      position: absolute;
      top: 50%;
      z-index: 2;
    }

    .signup-form h2:before {
      left: 0;
    }

    .signup-form h2:after {
      right: 0;
    }

    .signup-form .hint-text {
      color: #999;
      margin-bottom: 30px;
      text-align: center;
    }

    .signup-form form {
      color: #999;
      border-radius: 10px;
      margin-bottom: 15px;
      background: #fff;
      padding: 25px;
      border: 1px solid #ccc;
      background: #00804C;
      align-items: center;
    }

    .signup-form .form-group {
      margin-bottom: 5px;
    }

    .signup-form input[type="checkbox"] {
      margin-top: 3px;
    }

    .signup-form .btn {
      min-height: 38px;
      width: 50%; 
      padding: 10px;
      border: 1px solid #ccc;
      background-color: #EACDC2;
      transition: background-color 0.3s, color 0.3s;  
      margin-bottom: 10px;
      border-radius: 10px;
      font-weight: bold;
      text-align: center;
    }

    .btn:hover {
      background-color: #006F3A;
      color: white;
    }
    
    .signup-form .row div:first-child {
      padding-right: 5px;
    }

    .signup-form .row div:last-child {
      padding-left: 5px;
    }

    .signup-form a:hover {
      text-decoration: none;
    }

    .signup-form form a {
      color: #5cb85c;
      text-decoration: none;
    }

    .signup-form form a:hover {
      text-decoration: underline;
    }

    /* New style for equal-width inputs */
    .signup-form .form-group .col {
      display: flex;
      flex-direction: column;
    }

    .signup-form .form-group .col input {
      width: 90%;
    }

    .form-check-label {
        color: #f4f7fc;
    }
  </style>
</head>

<body>
  <div class="signup-form">
    <form action="" method="POST" autocomplete="off">
      <h2>Register</h2>
      <div class="form-group">
          <div class="col">
          <input type="text" class="form-control" name="firstname" placeholder="First Name" required="required">
          <input type="text" class="form-control" name="lastname" placeholder="Last Name" required="required">
        </div>
      </div>
      <div class="form-group">
        <input type="email" class="form-control" name="email" placeholder="Email" required="required">
      </div>
      <div class="form-group">
        <input type="password" class="form-control" name="password" placeholder="Password" required="required">
      </div>
      <div class="form-group">
        <input type="password" class="form-control" name="confirm_password" placeholder="Confirm Password" required="required">
      </div>
      <div class="form-group">
        <label class="form-check-label"><input type="checkbox" required="required"> I accept the <a href="#">Terms of Use</a> &amp; <a href="#">Privacy Policy</a></label>
      </div>
      <div class="form-group">
        <button type="submit" class="btn btn-danger btn-lg btn-block">Register</button>
      </div>
    </form>
    <div class="text-center">Already have an account? <a class="text-success" href="login.php">Login Here</a></div>
  </div>
</body>

<script src="js/jquery.slim.min.js"></script>
<script src="js/bootstrap.min.js"></script>

</html>
