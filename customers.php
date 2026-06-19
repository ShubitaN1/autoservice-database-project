<?php
include 'db.php';
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Customers - Nika's Auto Service</title>
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

<h2>Customers</h2>

<table>
    <tr>
        <th>ID</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Phone</th>
        <th>Email</th>
        <th>Address</th>
    </tr>

<?php
$sql = "SELECT * FROM customers";
$result = $conn->query($sql);

while($row = $result->fetch_assoc())
{
    echo "<tr>";
    echo "<td>".$row['customer_id']."</td>";
    echo "<td>".$row['first_name']."</td>";
    echo "<td>".$row['last_name']."</td>";
    echo "<td>".$row['phone']."</td>";
    echo "<td>".$row['email']."</td>";
    echo "<td>".$row['address']."</td>";
    echo "</tr>";
}
?>

</table>

</body>
</html>