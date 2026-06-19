<?php
include 'db.php';
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Vehicles - Nika's Auto Service</title>
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

<h2>Vehicles</h2>

<table>
    <tr>
        <th>ID</th>
        <th>Owner</th>
        <th>Brand</th>
        <th>Model</th>
        <th>Year</th>
        <th>Plate Number</th>
        <th>VIN</th>
    </tr>

<?php

$sql = "
SELECT
    v.vehicle_id,
    c.first_name,
    c.last_name,
    v.brand,
    v.model,
    v.production_year,
    v.plate_number,
    v.vin
FROM vehicles v
JOIN customers c
ON v.customer_id = c.customer_id
";

$result = $conn->query($sql);

while($row = $result->fetch_assoc())
{
    echo "<tr>";
    echo "<td>".$row['vehicle_id']."</td>";
    echo "<td>".$row['first_name']." ".$row['last_name']."</td>";
    echo "<td>".$row['brand']."</td>";
    echo "<td>".$row['model']."</td>";
    echo "<td>".$row['production_year']."</td>";
    echo "<td>".$row['plate_number']."</td>";
    echo "<td>".$row['vin']."</td>";
    echo "</tr>";
}

?>

</table>

</body>
</html>