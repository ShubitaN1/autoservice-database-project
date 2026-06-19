<?php
include 'db.php';

$customers = $conn->query("SELECT COUNT(*) AS total FROM customers")->fetch_assoc()['total'];
$vehicles = $conn->query("SELECT COUNT(*) AS total FROM vehicles")->fetch_assoc()['total'];
$employees = $conn->query("SELECT COUNT(*) AS total FROM employees")->fetch_assoc()['total'];
$orders = $conn->query("SELECT COUNT(*) AS total FROM work_orders")->fetch_assoc()['total'];
$services = $conn->query("SELECT COUNT(*) AS total FROM services")->fetch_assoc()['total'];
$payments = $conn->query("SELECT COUNT(*) AS total FROM payments")->fetch_assoc()['total'];
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Dashboard - Nika's Auto Service</title>
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

<h2>Dashboard</h2>

<div class="cards">
    <div class="card">
        <h3>Customers</h3>
        <p><?php echo $customers; ?></p>
    </div>

    <div class="card">
        <h3>Vehicles</h3>
        <p><?php echo $vehicles; ?></p>
    </div>

    <div class="card">
        <h3>Employees</h3>
        <p><?php echo $employees; ?></p>
    </div>

    <div class="card">
        <h3>Services</h3>
        <p><?php echo $services; ?></p>
    </div>

    <div class="card">
        <h3>Work Orders</h3>
        <p><?php echo $orders; ?></p>
    </div>

    <div class="card">
        <h3>Payments</h3>
        <p><?php echo $payments; ?></p>
    </div>
</div>

</body>
</html>