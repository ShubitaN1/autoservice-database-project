<?php
include 'db.php';
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Work Orders</title>
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

<h2>Work Orders</h2>

<table>
<tr>
    <th>Order ID</th>
    <th>Customer</th>
    <th>Vehicle</th>
    <th>Employee</th>
    <th>Date</th>
    <th>Status</th>
    <th>Total Cost</th>
</tr>

<?php

$sql = "
SELECT
    w.order_id,
    CONCAT(c.first_name,' ',c.last_name) AS customer_name,
    CONCAT(v.brand,' ',v.model) AS vehicle_name,
    CONCAT(e.first_name,' ',e.last_name) AS employee_name,
    w.order_date,
    w.status,
    w.total_cost
FROM work_orders w
JOIN vehicles v ON w.vehicle_id = v.vehicle_id
JOIN customers c ON v.customer_id = c.customer_id
JOIN employees e ON w.employee_id = e.employee_id
";

$result = $conn->query($sql);

while($row = $result->fetch_assoc())
{
    echo "<tr>";
    echo "<td>".$row['order_id']."</td>";
    echo "<td>".$row['customer_name']."</td>";
    echo "<td>".$row['vehicle_name']."</td>";
    echo "<td>".$row['employee_name']."</td>";
    echo "<td>".$row['order_date']."</td>";
    echo "<td>".$row['status']."</td>";
    echo "<td>".$row['total_cost']." ₾</td>";
    echo "</tr>";
}
?>

</table>

</body>
</html>