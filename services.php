<?php
include 'db.php';
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Services</title>
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

<h2>Services</h2>

<table>
<tr>
    <th>ID</th>
    <th>Service Name</th>
    <th>Description</th>
    <th>Price</th>
</tr>

<?php

$result = $conn->query("SELECT * FROM services");

while($row = $result->fetch_assoc())
{
    echo "<tr>";
    echo "<td>".$row['service_id']."</td>";
    echo "<td>".$row['service_name']."</td>";
    echo "<td>".$row['description']."</td>";
    echo "<td>".$row['price']." ₾</td>";
    echo "</tr>";
}

?>

</table>

</body>
</html>