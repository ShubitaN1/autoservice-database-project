<?php
include 'db.php';
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Payments</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<h1>Nika's Auto Service Management System</h1>

<nav>
    <a href="index.php">Dashboard</a>
    <a href="customers.php">Customers</a>
    <a href="vehicles.php">Vehicles</a>
    <a href="employees.php">Employees</a>
    <a href="services.php">Services</a>
    <a href="work_orders.php">Work Orders</a>
    <a href="payments.php">Payments</a>
    <a href="reports.php">Reports</a>
</nav>

<h2>Payments</h2>

<table>
<tr>
    <th>Payment ID</th>
    <th>Customer</th>
    <th>Vehicle</th>
    <th>Order ID</th>
    <th>Total Cost</th>
    <th>Paid</th>
    <th>Remaining</th>
    <th>Method</th>
</tr>

<?php

$result = $conn->query("SELECT * FROM vw_payment_report");

while($row = $result->fetch_assoc())
{
    echo "<tr>";
    echo "<td>".$row['payment_id']."</td>";
    echo "<td>".$row['first_name']." ".$row['last_name']."</td>";
    echo "<td>".$row['brand']." ".$row['model']."</td>";
    echo "<td>".$row['order_id']."</td>";
    echo "<td>".$row['total_cost']." ₾</td>";
    echo "<td>".$row['paid_amount']." ₾</td>";
    echo "<td>".$row['remaining_amount']." ₾</td>";
    echo "<td>".$row['payment_method']."</td>";
    echo "</tr>";
}

?>

</table>

</body>
</html>