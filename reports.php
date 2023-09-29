<?php
//if ((!isset($_SESSION)) || (!isset($_SESSION['admin']))) 
//{
  //header("Location: login.php");
//}
?>

<?php require('conn.php'); ?>

<?php
//Sales Data
$sqlSales = "SELECT * FROM sales";
$resultSales = mysqli_query($conn, $sqlSales);
$salesData = mysqli_fetch_all($resultSales, MYSQLI_ASSOC);

//Expenses Data
$sqlExpenses = "SELECT * FROM expenses";
$resultExpenses = mysqli_query($conn, $sqlExpenses);
$expensesData = mysqli_fetch_all($resultExpenses, MYSQLI_ASSOC);



//Total Milk and Sale Amount
$sql = "SELECT SUM(milk_quantity) AS total_milk_sold, SUM(total_sale_amount) AS total_sale_amount FROM sales";
$result = mysqli_query($conn, $sql);

$row = mysqli_fetch_assoc($result);
$totalMilkSold = $row['total_milk_sold'];
$totalSaleAmount = $row['total_sale_amount'];
//**********************************************************************************//

//Total Expenses
$sql1 = "SELECT SUM(expense_amount) AS total_expenses FROM expenses";
$result1 = mysqli_query($conn, $sql1);

$row1 = mysqli_fetch_assoc($result1);
$totalExpenses = $row1['total_expenses'];
//***********************************************************************************//


//Profit
$sql2 = "SELECT (SUM(total_sale_amount) - SUM(expense_amount)) AS profitability FROM sales, expenses";
$result2 = mysqli_query($conn, $sql2);

$row2 = mysqli_fetch_assoc($result2);
$profitability = $row2['profitability'];
//**************************************************************************************//

//Cost Per Liter 
$sql3 = "SELECT SUM(expense_amount) / SUM(milk_quantity) AS cost_per_liter FROM expenses, sales";
$result3 = mysqli_query($conn, $sql3);

$row3 = mysqli_fetch_assoc($result3);
$costPerLiter = $row3['cost_per_liter'];
//**************************************************************************//

// Revenue Per Animal
$sql4 = "SELECT (SUM(total_sale_amount) /(SELECT COUNT(*) AS row_count FROM animal)
) AS revenue_per_cow FROM sales animal";
$result4 = mysqli_query($conn, $sql4);

$row4 = mysqli_fetch_assoc($result4);
$revenuePerCow = $row4['revenue_per_cow'];

?>

<!DOCTYPE html>
<html>
    <head>
      <title>Reports-Our Dairy</title>
      <link rel="stylesheet" href="dashboardstyle.css">
      <link rel="stylesheet" href="addanimalstyle.css">
    
      <style>
        table {
            border-collapse: collapse;
            margin-left:20%
        }
        table, th, td{
            border: 1px solid black;
            padding: 5px;
            margin-left:20%
        }
        h3,h2{
            margin-left:20%;
        }
        </style>

    </head>
    <body>
      <?php require('navbar.php'); ?>
      <br>
      <?php require('vnavbar.php'); ?>
      <br>
      <h1 class="headings">Reports</h1>
      <br>
      <h2>Financial Report</h2><br>
    <h3>Sales</h3><br>
    <table>
        <tr>
            <th>Date</th>
            <th>Milk Quantity (Liters)</th>
            <th>Milk Price per Liter</th>
            <th>Total Sale Amount</th>
        </tr>
        <?php foreach ($salesData as $sale) { ?>
            <tr>
                <td><?php echo $sale['date']; ?></td>
                <td><?php echo $sale['milk_quantity']; ?></td>
                <td><?php echo $sale['milk_price_per_liter']; ?></td>
                <td><?php echo $sale['total_sale_amount']; ?></td>
            </tr>
        <?php } ?>
    </table>
<br><br>
    <h2>Expenses</h2>
    <br>
    <table>
        <tr>
            <th>Date</th>
            <th>Expense Description</th>
            <th>Expense Amount</th>
        </tr>
        <?php foreach ($expensesData as $expense) { ?>
            <tr>
                <td><?php echo $expense['date']; ?></td>            
                <td><?php echo $expense['expense_description']; ?></td>
                <td><?php echo $expense['expense_amount']; ?></td>
            </tr>
        <?php } ?>
    </table>
<br><br>
    <h2>Summary</h2>
    <table>
        <tr>
            <th>Total Milk Sold (Liters)</th>
            <td><?php echo $totalMilkSold; ?></td>
        </tr>
        <tr>
            <th>Total Sale Amount</th>
            <td><?php echo $totalSaleAmount; ?></td>
        </tr>
        <tr>
            <th>Total Expenses</th>
            <td><?php echo $totalExpenses; ?></td>
        </tr>
        <tr>
            <th>Profitability</th>
            <td><?php echo $profitability; ?></td>
        </tr>
        <tr>
            <th>Cost per Liter of Milk Produced</th>
            <td><?php echo $costPerLiter; ?></td>
        </tr>
        <tr>
            <th>Revenue per Cow</th>
            <td><?php echo $revenuePerCow; ?></td>
        </tr>
    </table>
      
      <br>


    </body>
</html>