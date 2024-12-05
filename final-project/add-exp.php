<?php
include("session.php");
$expenseamount = "";
$expensedate = date("Y-m-d");
$expensecategory = "Entertainment";
$expensenotes = '';
if (isset($_POST['add'])) {
    $expenseamount = $_POST['expenseamount'];
    $expensedate = $_POST['expensedate'];
    $expensecategory = $_POST['expensecategory'];
    $expensenotes = $_POST['expensenotes'];

    $expenses = "INSERT INTO expenses (user_id, expense,expensedate,expensecategory,expensenotes) VALUES ('$userid', '$expenseamount','$expensedate','$expensecategory','$expensenotes')";
    $result = mysqli_query($con, $expenses) or die("Something Went Wrong!");
    header('location: expenses.php');
}

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
body {
    font-family: Gabarito;
    margin: 0;
    padding: 0;
    background-color: #f4f7fc;
}

.navbar {
    background-color: #00804C;
    padding: 10px 20px;
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
    text-decoration: none;
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
    text-decoration: none;
    font-size: 16px;
    padding: 10px 15px;
    display: block;
}

.nav-links a:hover {
    background-color: #DBE64C;
    border-radius: 5px;
    color: #001F3F;
}

.logout-btn {
    background-color: #1E488F;
    border-radius: 5px;
    padding: 10px 15px;
}

.logout-btn:hover {
    background-color: #ff3b3b;
}

@media (max-width: 768px) {
    .nav-links {
        flex-direction: column;
        display: none;
        width: 100%;
        background-color: #2d3b55;
        position: absolute;
        top: 60px;
        left: 0;
    }

    .nav-links.active {
        display: flex;
    }

    .nav-links li {
        text-align: center;
        width: 100%;
    }

    .navbar-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .logo {
        font-size: 20px;
    }

    .nav-links a {
        padding: 15px;
    }

    .burger-menu {
        display: block;
        background-color: #2d3b55;
        color: white;
        font-size: 30px;
        cursor: pointer;
    }
}

.add-form {
    width: 100%;
    font-size: 18px;
    margin: 0 auto;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}

.container form {
    margin: 0 auto;
    background: #00804C;
    padding: 40px 50px;
    border-radius: 10px;
    color:#F6F7ED;
}

h1 {
    text-align: center;
    font-size: 28px; 
}

.form-group {
    margin-bottom: 20px;
}

.form-control {
    font-size: 18px;
    padding: 15px; 
    width: 100%;
    box-sizing: border-box;
    border-radius: 10px;
}

button {
    font-size: 18px;
    padding: 15px 25px; 
    width: 100%;
    box-sizing: border-box;
    border-radius: 10px;
    transition: background-color 0.3s, color 0.3s; 
    
}

button:hover {
    cursor: pointer;
    opacity: 0.9;
    background-color: #006F3A;
    color: white;
}

fieldset {
    border: none;
    margin-top: 20px;
}

.form-check-input {
    width: 20px;
    height: 20px;
}

.form-check-label {
    font-size: 18px;
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

    <section class="add-form">
    <div class="container">
                <h1 class="mt-4 text-center">Add Your Daily Expenses</h1>
                <hr>
                <div class="row ">

                    <div class="col-md-3"></div>

                    <div class="col-md" style="margin:0 auto;">
                        <form action="" method="POST">
                            <div class="form-group row">
                                <label for="expenseamount" class="col-sm-6 col-form-label"><b>Enter Amount(₱)</b></label>
                                <div class="col-md-6">
                                    <input type="number" class="form-control col-sm-12" value="<?php echo $expenseamount; ?>" id="expenseamount" name="expenseamount" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="expensedate" class="col-sm-6 col-form-label"><b>Date</b></label>
                                <div class="col-md-6">
                                    <input type="date" class="form-control col-sm-12" value="<?php echo $expensedate; ?>" name="expensedate" id="expensedate" required>
                                </div>
                            </div>
                            <fieldset class="form-group">
                                <div class="row">
                                    <legend class="col-form-label col-sm-6 pt-0"><b>Category</b></legend>
                                    <div class="col-md">

                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="expensecategory" id="expensecategory4" value="Medicine" <?php echo ($expensecategory == 'Medicine') ? 'checked' : '' ?>>
                                            <label class="form-check-label" for="expensecategory4">
                                                Medicine
                                            </label>
                                        </div>

                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="expensecategory" id="expensecategory3" value="Food" <?php echo ($expensecategory == 'Food') ? 'checked' : '' ?>>
                                            <label class="form-check-label" for="expensecategory3">
                                                Food
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="expensecategory" id="expensecategory2" value="Bills & Recharges" <?php echo ($expensecategory == 'Bills & Recharges') ? 'checked' : '' ?>>
                                            <label class="form-check-label" for="expensecategory2">
                                                Bills and Recharges
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="expensecategory" id="expensecategory1" value="Entertainment" <?php echo ($expensecategory == 'Entertainment') ? 'checked' : '' ?>>
                                            <label class="form-check-label" for="expensecategory1">
                                                Entertainment
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="expensecategory" id="expensecategory7" value="Clothings" <?php echo ($expensecategory == 'Clothings') ? 'checked' : '' ?>>
                                            <label class="form-check-label" for="expensecategory7">
                                                Clothings
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="expensecategory" id="expensecategory6" value="Rent" <?php echo ($expensecategory == 'Rent') ? 'checked' : '' ?>>
                                            <label class="form-check-label" for="expensecategory6">
                                                Rent
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="expensecategory" id="expensecategory8" value="Household Items" <?php echo ($expensecategory == 'Household Items') ? 'checked' : '' ?>>
                                            <label class="form-check-label" for="expensecategory8">
                                                Household Items
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="expensecategory" id="expensecategory5" value="Others" <?php echo ($expensecategory == 'Others') ? 'checked' : '' ?>>
                                            <label class="form-check-label" for="expensecategory5">
                                                Others
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <label for="expensenotes" class="col-sm-6 col-form-label"><b>Add Notes</b></label>
                                            <div class="col-md-6">
                                            <input type="text" class="form-control col-sm-12" value="<?php echo $expensenotes; ?>" id="expensenotes" name="expensenotes">
                                            </div>
                                </div>
                                    </div>
                                </div>
                            </fieldset>
                            <button type="submit" name="add" class="btn btn-lg btn-block btn-success">Add Expense</button>
                        
                        </form>
                    </div>
                    </div>

</body>

</body>
</html>