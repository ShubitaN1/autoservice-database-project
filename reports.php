<?php
include 'db.php';
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Reports</title>
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

<h2>Service Report</h2>

<table>
<tr>
    <th>Customer</th>
    <th>Vehicle</th>
    <th>Mechanic</th>
    <th>Date</th>
    <th>Status</th>
    <th>Total Cost</th>
</tr>

<?php
$result = $conn->query("SELECT * FROM vw_service_report");

while($row = $result->fetch_assoc())
{
    echo "<tr>";
    echo "<td>".$row['first_name']." ".$row['last_name']."</td>";
    echo "<td>".$row['brand']." ".$row['model']."</td>";
    echo "<td>".$row['mechanic_name']."</td>";
    echo "<td>".$row['order_date']."</td>";
    echo "<td>".$row['status']."</td>";
    echo "<td>".$row['total_cost']." ₾</td>";
    echo "</tr>";
}
?>
</table>

<h2>Payment Report</h2>

<table>
<tr>
    <th>Customer</th>
    <th>Vehicle</th>
    <th>Total Cost</th>
    <th>Paid</th>
    <th>Remaining</th>
    <th>Method</th>
    <th>Date</th>
</tr>

<?php
$result = $conn->query("SELECT * FROM vw_payment_report");

while($row = $result->fetch_assoc())
{
    echo "<tr>";
    echo "<td>".$row['first_name']." ".$row['last_name']."</td>";
    echo "<td>".$row['brand']." ".$row['model']."</td>";
    echo "<td>".$row['total_cost']." ₾</td>";
    echo "<td>".$row['paid_amount']." ₾</td>";
    echo "<td>".$row['remaining_amount']." ₾</td>";
    echo "<td>".$row['payment_method']."</td>";
    echo "<td>".$row['payment_date']."</td>";
    echo "</tr>";
}
?>
</table>

</body>
</html>