<?php
include("session.php");
$exp_fetched = mysqli_query($con, "SELECT * FROM expenses WHERE user_id = '$userid'");

  // Fetch data for the chart
  $exp_categories = [];
  $exp_amounts = [];
  $total_expenses = 0;

  // Query to get the categories and sum of expenses
  $exp_category_query = mysqli_query($con, "SELECT expensecategory, SUM(expense) AS total FROM expenses WHERE user_id = '$userid' GROUP BY expensecategory");
  while ($row = mysqli_fetch_assoc($exp_category_query)) {
      $exp_categories[] = $row['expensecategory'];
      $exp_amounts[] = $row['total'];
      $total_expenses += $row['total'];  // Adding up the expenses for the total
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="exp-tracker-logo.png" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Gabarito:wght@400..900&display=swap" rel="stylesheet">
    <title>Pennywise</title>
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

        /* Table Styling */
        .container-fluid {
            margin-left: 100px;
            margin-right: 100px;
        }

        h3 {
            font-size: 24px;
            color: #001F3F;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #ffffff;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
        }

        th, td {
            padding: 15px;
            text-align: center;
            border: 1px solid #e0e0e0;
        }

        th {
            background-color: #00804C;
            color: white;
            font-weight: bold;
        }

        td {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        button {
            font-size: 18px;
            padding: 20px; 
            width:20%;
            text-decoration: none;
            transition: background-color 0.3s, color 0.3s;  
            background-color: #005d36;
            border-radius: 10px;

        }

        h2 {
            color:#F6F7ED;
        }

        button:hover {
            cursor: pointer;
            opacity: 0.9;
            background-color: #DBE64C;
            color: white;
            text-decoration: none;
        }

        h2:hover {
            color:#001F3F;
        }

        /* Responsive design */
        @media (max-width: 768px) {
            table {
                font-size: 14px;
            }

            th, td {
                padding: 10px;
            }

            h3 {
                font-size: 20px;
            }
        }

            .row-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin: 10px auto;
        max-width: 800px;
        width: 80%;
    }

.row-container .total {
    flex: 1;
    margin-right: 20px;
}

.row-container .btn {
    flex-shrink: 0;
    text-align: center;
}

.row-container .btn a {
    display: inline-block;
    background-color: #00804C;
    color: white;
    padding: 10px 20px;
    border-radius: 8px;
    text-decoration: none;
    font-size: 18px;
}

.row-container .btn a:hover {
    background-color: #005d36;
}


.total {
    background-color: #ffffff;
    border-radius: 8px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    padding: 5px;
    text-align: center;
    margin: 10px;
    border: none;
    width: 80%;
    max-width: 800px;
    margin-left: auto;
    margin-right: auto;
}

.total h3 {
    font-size: 24px;
    color: #001F3F;

}

.total h1 {
    font-size: 50px;
    color: #00804C;
    font-weight: bold;
}
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar">
        <div class="navbar-container">
            <a href="/" class="logo">PennyWise</a>
            <ul class="nav-links">
                <li><a href="/">Home</a></li>
                <li class="dropdown">
                    <a href="expenses.php" class="dropbtn">Expenses</a>
                </li>
                <li><a href="profile.php">Profile</a></li>
                <li><a href="login.php" class="logout-btn">Logout</a></li>
            </ul>
        </div>
    </nav>

    <div class="row-container">
    <div class="total">
        <h3>Total Expenses:</h3>
        <h1>₱<?php echo number_format($total_expenses, 2); ?></h1>
    </div>
    <button onclick="window.location.href='add-exp.php'">
        <h2>Add Expense</h2>
    </button>
</div>

    

    <div class="container-fluid">
        <h3 class="mt-4 text-center">Manage Expenses</h3>
        <hr>
        <div class="row justify-content-center">

            <div class="col-md-8">
                <table class="table table-hover table-bordered">
                    <thead>
                        <tr class="text-center">
                            <th>#</th>
                            <th>Date</th>
                            <th>Amount</th>
                            <th>Expense Category</th>
                            <th>Notes</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <?php $count=1; while ($row = mysqli_fetch_array($exp_fetched)) { ?>
                        <tr>
                            <td><?php echo $count;?></td>
                            <td><?php echo $row['expensedate']; ?></td>
                            <td><?php echo '$'.$row['expense']; ?></td>
                            <td><?php echo $row['expensecategory']; ?></td>
                            <td><?php echo $row['expensenotes']; ?></td>
                            <td class="text-center">
                            <a href="del-exp.php?delete=<?php echo $row['expense_id']; ?>" class="btn btn-danger btn-sm" style="border-radius:0%;">Delete</a>
                            </td>

                        </tr>
                    <?php $count++; } ?>
                </table>
            </div>

        </div>
    </div>

    <script src="js/jquery.slim.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/Chart.min.js"></script>
    <!-- Menu Toggle Script -->
    <script>
        $("#menu-toggle").click(function(e) {
            e.preventDefault();
            $("#wrapper").toggleClass("toggled");
        });
    </script>
    <script>
        feather.replace();
    </script>
    <script>

    </script>
    
</body>
</html>
