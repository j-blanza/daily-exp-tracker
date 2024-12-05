<?php
  include("session.php");

  $exp_categories = [];
  $exp_amounts = [];
  $total_expenses = 0;

  $exp_category_query = mysqli_query($con, "SELECT expensecategory, SUM(expense) AS total FROM expenses WHERE user_id = '$userid' GROUP BY expensecategory");
  while ($row = mysqli_fetch_assoc($exp_category_query)) {
      $exp_categories[] = $row['expensecategory'];
      $exp_amounts[] = $row['total'];
      $total_expenses += $row['total']; 
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

.boxes-section {
    display: flex;
    justify-content: space-between;
    margin: 20px 100px;
}

button.box {
    background-color: #ffffff;
    border-radius: 8px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    width: calc(33.333% - 20px);
    padding: 60px;
    text-align: center;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    margin: 10px;
    border: none;
    cursor: pointer;
}

button.box:hover {
    transform: translateY(-10px);
    box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
    color: #f4f7fc;
    background-color: #DBE64C;
}

button.box h2 {
    font-size: 20px;
    color: #001F3F;
    margin: 0;
}

button.box h2:hover{
    color: #f4f7fc; 
}

button.box a {
    text-decoration: none;
    color: #f4f7fc; 
    display: block; 
}

button.box a:hover {
    color: white;
}

.total {
    background-color: #ffffff;
    border-radius: 8px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    padding: 20px;
    text-align: center;
    margin: 10px;
    border: none;
    width: 100%;
    max-width: 500px;  /* Limit the width */
    margin-left: auto;
    margin-right: auto;  /* Center the box horizontally */
}

.total h3 {
    font-size: 24px;
    color: #001F3F;
    margin-bottom: 10px;
}

.total h1 {
    font-size: 60px;  /* Increase the font size */
    color: #00804C;
    font-weight: bold;
}

@media (max-width: 768px) {
    button.box {
        width: calc(50% - 20px);
    }

    .boxes-section {
        flex-direction: column;
    }

    .total {
        max-width: 100%;
    }
}

@media (max-width: 480px) {
    button.box {
        width: 100%;
    }
}

.row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin: 20px 100px;
}

.chart-container {
    flex: 1;
    margin-left: 20px;
}

canvas#expenseChart {
    width: 100%;
    height: 100%;
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

<!-- Total Expenses and Chart Section -->
<section class="row">
    <div class="total">
        <h3>Total Expenses:</h3>
        <h1>₱<?php echo number_format($total_expenses, 2); ?></h1>
    </div>
    <div class="chart-container">
        <canvas id="expenseChart"></canvas>
    </div>
</section>

<!-- Buttons Section -->
<section class="boxes-section">
    <button class="box add-exp">
        <a href="add-exp.php">
            <h2>Add Expense</h2>
        </a>
    </button>
    <button class="box manage-exp">
        <a href="expenses.php">
            <h2>Manage Expenses</h2>
        </a>
    </button>
    <button class="box user">
        <a href="profile.php">
            <h2>Profile</h2>
        </a>
    </button>
</section>

<script>
    // PHP data passed to JavaScript
    const categories = <?php echo json_encode($exp_categories); ?>;
    const amounts = <?php echo json_encode($exp_amounts); ?>;

    // Chart.js configuration
    const ctx = document.getElementById('expenseChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar', // Change to 'pie', 'line', etc., for different chart types
        data: {
            labels: categories,
            datasets: [{
                label: 'Expenses by Category',
                data: amounts,
                backgroundColor: [
                    '#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF'
                ],
                borderColor: '#ffffff',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: true,
                    position: 'top'
                },
                tooltip: {
                    enabled: true
                }
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>

</body>
</html>
