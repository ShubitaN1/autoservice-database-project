<?php
include 'db.php';
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Employees</title>
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

<h2>Employees</h2>

<table>
<tr>
    <th>ID</th>
    <th>First Name</th>
    <th>Last Name</th>
    <th>Position</th>
    <th>Phone</th>
    <th>Salary</th>
</tr>

<?php

$result = $conn->query("SELECT * FROM employees");

while($row = $result->fetch_assoc())
{
    echo "<tr>";
    echo "<td>".$row['employee_id']."</td>";
    echo "<td>".$row['first_name']."</td>";
    echo "<td>".$row['last_name']."</td>";
    echo "<td>".$row['position']."</td>";
    echo "<td>".$row['phone']."</td>";
    echo "<td>".$row['salary']."</td>";
    echo "</tr>";
}

?>

</table>

</body>
</html>