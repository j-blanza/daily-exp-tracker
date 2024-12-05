<?php
require('config.php');
session_start();
$errormsg = "";
$emailErr = ""; // Define the variable to prevent undefined variable warning
$passwordErr = ""; // Define the variable for password error

if (isset($_POST['email'])) {
  $email = stripslashes($_REQUEST['email']);
  $email = mysqli_real_escape_string($con, $email);
  $password = stripslashes($_REQUEST['password']);
  $password = mysqli_real_escape_string($con, $password);
  $query = "SELECT * FROM `users` WHERE email='$email' AND password='" . md5($password) . "'";
  $result = mysqli_query($con, $query) or die(mysqli_error($con));
  $rows = mysqli_num_rows($result);

  if ($rows == 1) {
    $_SESSION['email'] = $email;
    header("Location: index.php");
  } else {
    $errormsg = "Wrong email or password.";
  }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="shortcut icon" href="exp-tracker-logo.png" type="image/x-icon">
  <link href="https://fonts.googleapis.com/css2?family=Gabarito:wght@400..900&display=swap" rel="stylesheet">
  <title>Login</title>

  <style>

    html, body {
      height: 100%;
      margin: 0;
      font-family: Gabarito;
      background-color: #f4f7fc;
      display: flex;
      justify-content: center;
      align-items: center;
    }

   
    .login-form {
      width: 350px;
      font-size: 15px;
      display: flex;
      flex-direction: column;
      align-items: center; 
      justify-content: center;
      
    }

    .login-form form {
      margin-bottom: 15px;
      background: #00804C;
      padding: 20px;
      border-radius: 10px;
      width: 100%;
    }


    .login-form h2 {
      color: #F6F7ED;
      margin: 0 0 15px;
      position: relative;
      text-align: center;
    }

    .login-form h2:before,
    .login-form h2:after {
      content: "";
      height: 2px;
      width: 30%;
      background: #d4d4d4;
      position: absolute;
      top: 50%;
      z-index: 2;
    }

    .login-form h2:before {
      left: 0;
    }

    .login-form h2:after {
      right: 0;
    }

    p.tag{
        color: #F6F7ED;
        text-align: center;
    }


    .login-form .hint-text {
      color: #999;
      margin-bottom: 30px;
      text-align: center;
    }

    .form-control {
      width: 93%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 5px;
      margin-bottom: 10px;
    }

    .btn {
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

    .error {
      color: red;
      font-size: 12px;
    }

    .clearfix {
        color: #F6F7ED;
    }
  </style>
</head>
<body>
  <div class="login-form">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" autocomplete="off">
      <h2 class="text-center">PennyWise</h2>
      <p class="tag">Start managing your expenses.</p>
      <span class="error"><?php echo $errormsg; ?></span>
      
      <div class="form-group">
      <input type="email" name="email" class="form-control" placeholder="Email" required="required" value="<?php echo isset($email) ? htmlspecialchars($email) : ''; ?>">
        <span class="error"><?php echo $emailErr; ?></span>
      </div>

      <div class="form-group">
        <input type="password" name="password" class="form-control" placeholder="Password" required="required">
        <span class="error"><?php echo $passwordErr; ?></span>
      </div>

      <div class="form-group">
        <button type="submit" class="btn btn-success btn-block">Login</button>
      </div>
      <div class="clearfix">
        <label class="float-left form-check-label"><input type="checkbox"> Remember me</label>
      </div>
    </form>
    <p class="text-center">Don't have an account? <a href="register.php" class="text-danger">Register Here</a></p>
  </div>
</body>
</html>