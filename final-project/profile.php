<?php

include("session.php");


$userid = $_SESSION['userid'];


$userData = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM users WHERE user_id = '$userid'"));
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="exp-tracker-logo.png" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Gabarito:wght@400..900&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <title>Pennywise</title>
</head>
<body>
    <style>
/* General Styles */
/* General Styles */
body {
    font-family: 'Gabarito', sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f4f7fc;
    color: #333;
    line-height: 1.6;
}

h1, h3 {
    color: #00804C;
    font-weight: bold;
    text-align: center;
}

a {
    text-decoration: none;
    color: inherit;
}

/* Navbar Styles */
.navbar {
    background-color: #00804C;
    padding: 15px 30px;
    position: sticky;
    top: 0;
    z-index: 1000;
}

.navbar-container {
    max-width: 1200px;
    margin: 0 auto;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.logo {
    font-size: 24px;
    font-weight: bold;
    color: white;
}

.nav-links {
    list-style: none;
    display: flex;
    gap: 20px;
}

.nav-links li {
    position: relative;
}

.nav-links a {
    color: #F6F7ED;
    font-size: 16px;
    padding: 10px 15px;
    border-radius: 5px;
    transition: all 0.3s ease;
}

.nav-links a:hover {
    background-color: #DBE64C;
    color: #001F3F;
}

.logout-btn {
    background-color: #1E488F;
    color: white;
    padding: 10px 15px;
    border-radius: 5px;
    transition: all 0.3s ease;
}

.logout-btn:hover {
    background-color: #ff3b3b;
}

/* Profile Page Styles */
.container-fluid {
    padding: 20px;
}

.col-md-6 {
    max-width: 600px;
    margin: 0 auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
}

h1 {
    margin-bottom: 20px;
}

/* Form Styles */
.form {
    width: 100%;
    padding: 20px;
    background-color: #f9f9f9;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
}

.form-group {
    margin-bottom: 15px;
}

.form-group label {
    font-size: 16px;
    font-weight: 500;
    margin-bottom: 8px;
}

.form-group p {
    font-size: 16px;
    color: #555;
    margin-top: 5px;
}

button[type="submit"] {
    background-color: #00804C;
    color: white;
    padding: 12px 25px;
    border-radius: 5px;
    font-size: 16px;
    border: none;
    cursor: pointer;
    width: 100%;
    transition: background-color 0.3s;
}

button[type="submit"]:hover {
    background-color: #006d38;
}

/* Responsive Design */
@media (max-width: 768px) {
    .navbar-container {
        flex-direction: column;
        align-items: flex-start;
    }

    .nav-links {
        display: none;
        flex-direction: column;
        gap: 15px;
        width: 100%;
        margin-top: 10px;
    }

    .nav-links.active {
        display: flex;
    }

    .burger-menu {
        display: block;
        font-size: 30px;
        cursor: pointer;
    }

    .col-md-6 {
        width: 90%;
    }

    .form {
        padding: 15px;
    }
}



    </style>

    <nav class="navbar">
        <div class="navbar-container">
            <a href="/" class="logo">PennyWise</a>
            <ul class="nav-links">
                <li><a href="/">Home</a></li>
                <li><a href="expenses.php">Expenses</a></li>
                <li><a href="profile.php">Profile</a></li>
                <li><a href="login.php" class="logout-btn">Logout</a></li>
            </ul>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h1 class="mt-4 text-center" text-align="center">Profile</h1>
                <hr>
                <!-- Update Profie Information Form -->
                <form class="form" action="" method="post" id="registrationForm" autocomplete="off">
    <div class="row">
        <div class="col">
            <div class="form-group">
                <label for="firstname">First name</label>
                <p><?php echo $firstname; ?></p>
            </div>
        </div>
        <div class="col">
            <div class="form-group">
                <label for="lastname">Last name</label>
                <p><?php echo $lastname; ?></p>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <p><?php echo $useremail; ?></p>
    </div>
</form>

            </div>
        </div>
    </div>

</div>
</body>

</html>