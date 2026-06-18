-- ============================================================
-- Autoservice Relational Database Project
-- Student: Nikoloz Shubitidze
-- Database: nikas_autoservice_db
-- DBMS: MySQL
-- ============================================================

-- 1. DATABASE CREATION
CREATE DATABASE IF NOT EXISTS nikas_autoservice_db;
USE nikas_autoservice_db;

-- 2. CLEAN OLD OBJECTS
DROP TRIGGER IF EXISTS trg_update_order_status_after_payment;
DROP PROCEDURE IF EXISTS GetCustomerServiceHistory;

DROP VIEW IF EXISTS vw_payment_report;
DROP VIEW IF EXISTS vw_service_report;

DROP TABLE IF EXISTS payments;
DROP TABLE IF EXISTS spare_parts;
DROP TABLE IF EXISTS work_orders;
DROP TABLE IF EXISTS services;
DROP TABLE IF EXISTS employees;
DROP TABLE IF EXISTS vehicles;
DROP TABLE IF EXISTS customers;

-- 3. TABLE CREATION

CREATE TABLE customers (
    customer_id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    phone VARCHAR(20) NOT NULL UNIQUE,
    email VARCHAR(100) UNIQUE,
    address VARCHAR(150),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE vehicles (
    vehicle_id INT AUTO_INCREMENT PRIMARY KEY,
    customer_id INT NOT NULL,
    brand VARCHAR(50) NOT NULL,
    model VARCHAR(50) NOT NULL,
    production_year INT,
    plate_number VARCHAR(20) UNIQUE,
    vin VARCHAR(50) UNIQUE,

    FOREIGN KEY (customer_id)
        REFERENCES customers(customer_id)
);

CREATE TABLE employees (
    employee_id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    position VARCHAR(50) NOT NULL,
    phone VARCHAR(20) UNIQUE,
    hire_date DATE,
    salary DECIMAL(10,2)
);

CREATE TABLE services (
    service_id INT AUTO_INCREMENT PRIMARY KEY,
    service_name VARCHAR(100) NOT NULL,
    description TEXT,
    price DECIMAL(10,2) NOT NULL
);

CREATE TABLE work_orders (
    order_id INT AUTO_INCREMENT PRIMARY KEY,
    vehicle_id INT NOT NULL,
    employee_id INT NOT NULL,
    order_date DATE NOT NULL,
    status VARCHAR(30) DEFAULT 'Pending',
    total_cost DECIMAL(10,2) DEFAULT 0,

    FOREIGN KEY (vehicle_id)
        REFERENCES vehicles(vehicle_id),

    FOREIGN KEY (employee_id)
        REFERENCES employees(employee_id)
);

CREATE TABLE spare_parts (
    part_id INT AUTO_INCREMENT PRIMARY KEY,
    part_name VARCHAR(100) NOT NULL,
    stock_quantity INT NOT NULL,
    unit_price DECIMAL(10,2) NOT NULL
);

CREATE TABLE payments (
    payment_id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT NOT NULL,
    payment_date DATE NOT NULL,
    amount DECIMAL(10,2) NOT NULL,
    payment_method VARCHAR(30) NOT NULL,

    FOREIGN KEY (order_id)
        REFERENCES work_orders(order_id)
);

-- 4. TEST DATA INSERTION

INSERT INTO customers
(first_name, last_name, phone, email, address)
VALUES
('Nikoloz', 'Shubitidze', '555249446', 'nikoloz150@gmail.com', 'Tbilisi'),
('Giorgi', 'Beridze', '593278565', 'giorgib54@gmail.com', 'Batumi'),
('Nika', 'Kapanadze', '568135863', 'nika25@gmail.com', 'Kutaisi'),
('Levan', 'Mchedlidze', '577824615', 'levan.m@gmail.com', 'Rustavi'),
('Irakli', 'Janelidze', '595123874', 'irakli.j@gmail.com', 'Gori'),
('Dato', 'Khachidze', '599314728', 'dato.kh@gmail.com', 'Tbilisi'),
('Tornike', 'Gelashvili', '574826315', 'tornike.g@gmail.com', 'Zugdidi'),
('Saba', 'Lomidze', '591437826', 'saba.l@gmail.com', 'Kutaisi'),
('Lasha', 'Maisuradze', '598721364', 'lasha.m@gmail.com', 'Batumi'),
('Giga', 'Tsertsvadze', '592615483', 'giga.t@gmail.com', 'Tbilisi');

INSERT INTO vehicles
(customer_id, brand, model, production_year, plate_number, vin)
VALUES
(1, 'BMW', '330i', 2017, 'JJ-330-NS', 'WBA8B9C35HK582471'),
(2, 'Hyundai', 'Elantra', 2017, 'TB-217-GK', 'KMHD84LF7HU426913'),
(3, 'Toyota', 'Camry', 2020, 'KT-420-NK', '4T1G11AK8LU314785'),
(4, 'Mercedes-Benz', 'C300', 2018, 'MM-801-LV', 'WDDWF8DB6JR219438'),
(5, 'Audi', 'A4', 2019, 'AA-919-IJ', 'WAUENAF45KN734812'),
(6, 'Volkswagen', 'Passat', 2016, 'PP-616-DK', 'WVWZZZ3CZGE268541'),
(7, 'Honda', 'Civic', 2021, 'HC-211-TG', '2HGFC2F63MH508274'),
(8, 'Kia', 'Sportage', 2022, 'KS-522-SL', 'KNDP63AC4N7159362'),
(9, 'Ford', 'Fusion', 2018, 'FF-318-LM', '3FA6P0HD5JR472609'),
(10, 'Lexus', 'RX350', 2021, 'LR-777-GT', '2T2ZZMCA5MC839617');

INSERT INTO employees
(first_name, last_name, position, phone, hire_date, salary)
VALUES
('Levan', 'Mchedlishvili', 'Senior Mechanic', '555444111', '2023-03-15', 2500.00),
('Giorgi', 'Kapanadze', 'Auto Electrician', '555444222', '2022-08-10', 2300.00),
('Irakli', 'Janelidze', 'Diagnostics Specialist', '555444333', '2024-01-20', 2700.00),
('Beka', 'Tkeshelashvili', 'Mechanic', '555444444', '2021-06-05', 2200.00),
('Lasha', 'Kvinikadze', 'Service Advisor', '555444555', '2022-11-18', 2100.00),
('Tornike', 'Maisuradze', 'Mechanic', '555444666', '2020-04-25', 2400.00),
('Sandro', 'Abashidze', 'Engine Specialist', '555444777', '2019-09-14', 2900.00),
('Nodar', 'Chelidze', 'Suspension Specialist', '555444888', '2023-07-01', 2600.00);

INSERT INTO services
(service_name, description, price)
VALUES
('Oil Change', 'Engine oil and filter replacement', 80.00),
('Brake Repair', 'Brake pads and brake system repair', 250.00),
('Engine Diagnostics', 'Computer diagnostics and fault detection', 100.00),
('Suspension Repair', 'Suspension system repair', 350.00),
('Tire Replacement', 'Replacement of tires and balancing', 120.00),
('Wheel Alignment', 'Wheel alignment service', 90.00),
('Battery Replacement', 'Battery replacement and testing', 180.00),
('Transmission Service', 'Transmission oil and inspection', 450.00),
('Air Conditioning Repair', 'AC diagnostics and repair', 220.00),
('Engine Tune-Up', 'Spark plugs and performance tuning', 300.00);

INSERT INTO work_orders
(vehicle_id, employee_id, order_date, status, total_cost)
VALUES
(1, 1, '2026-06-01', 'Completed', 80.00),
(2, 2, '2026-06-03', 'In Progress', 250.00),
(3, 3, '2026-06-05', 'Pending', 100.00),
(4, 4, '2026-06-07', 'Completed', 350.00),
(5, 5, '2026-06-08', 'In Progress', 180.00),
(6, 6, '2026-06-10', 'Completed', 450.00),
(7, 7, '2026-06-11', 'Pending', 220.00),
(8, 8, '2026-06-12', 'In Progress', 120.00),
(9, 1, '2026-06-14', 'Completed', 300.00),
(10, 3, '2026-06-16', 'Pending', 90.00);

INSERT INTO spare_parts
(part_name, stock_quantity, unit_price)
VALUES
('Engine Oil 5W30', 20, 35.00),
('Oil Filter', 15, 20.00),
('Brake Pads Set', 10, 120.00),
('Spark Plug', 30, 15.00),
('Air Filter', 25, 25.00),
('Cabin Filter', 18, 22.00),
('Brake Disc', 12, 140.00),
('Battery 70Ah', 8, 220.00),
('Timing Belt', 7, 180.00),
('Shock Absorber', 14, 160.00);

INSERT INTO payments
(order_id, payment_date, amount, payment_method)
VALUES
(1, '2026-06-01', 80.00, 'Cash'),
(2, '2026-06-03', 100.00, 'Card'),
(4, '2026-06-07', 350.00, 'Bank Transfer'),
(5, '2026-06-08', 100.00, 'Card'),
(6, '2026-06-10', 450.00, 'Cash'),
(8, '2026-06-12', 120.00, 'Card'),
(9, '2026-06-14', 300.00, 'Bank Transfer');

-- 5. VIEWS

CREATE VIEW vw_service_report AS
SELECT
    c.first_name,
    c.last_name,
    v.brand,
    v.model,
    v.plate_number,
    e.first_name AS mechanic_name,
    e.last_name AS mechanic_lastname,
    w.order_date,
    w.status,
    w.total_cost
FROM work_orders w
JOIN vehicles v
    ON w.vehicle_id = v.vehicle_id
JOIN customers c
    ON v.customer_id = c.customer_id
JOIN employees e
    ON w.employee_id = e.employee_id;

CREATE VIEW vw_payment_report AS
SELECT
    p.payment_id,
    c.first_name,
    c.last_name,
    v.brand,
    v.model,
    w.order_id,
    w.total_cost,
    p.amount AS paid_amount,
    (w.total_cost - p.amount) AS remaining_amount,
    p.payment_method,
    p.payment_date
FROM payments p
JOIN work_orders w
    ON p.order_id = w.order_id
JOIN vehicles v
    ON w.vehicle_id = v.vehicle_id
JOIN customers c
    ON v.customer_id = c.customer_id;

-- 6. STORED PROCEDURE

DELIMITER //

CREATE PROCEDURE GetCustomerServiceHistory(IN customerId INT)
BEGIN
    SELECT
        c.first_name,
        c.last_name,
        v.brand,
        v.model,
        v.plate_number,
        w.order_date,
        w.status,
        w.total_cost
    FROM customers c
    JOIN vehicles v
        ON c.customer_id = v.customer_id
    JOIN work_orders w
        ON v.vehicle_id = w.vehicle_id
    WHERE c.customer_id = customerId;
END //

DELIMITER ;

-- 7. TRIGGER

DELIMITER //

CREATE TRIGGER trg_update_order_status_after_payment
AFTER INSERT ON payments
FOR EACH ROW
BEGIN
    UPDATE work_orders
    SET status = 'Completed'
    WHERE order_id = NEW.order_id
      AND total_cost <= NEW.amount;
END //

DELIMITER ;

-- 8. INDEXES

CREATE INDEX idx_customer_phone
ON customers(phone);

CREATE INDEX idx_vehicle_plate
ON vehicles(plate_number);

CREATE INDEX idx_vehicle_vin
ON vehicles(vin);

CREATE INDEX idx_work_order_date
ON work_orders(order_date);

CREATE INDEX idx_payment_date
ON payments(payment_date);

-- 9. DEMO / TEST QUERIES

-- 9.1 Show all customers with their vehicles
SELECT
    c.customer_id,
    c.first_name,
    c.last_name,
    v.brand,
    v.model,
    v.plate_number,
    v.vin
FROM customers c
JOIN vehicles v
    ON c.customer_id = v.customer_id;

-- 9.2 Show completed work orders
SELECT *
FROM work_orders
WHERE status = 'Completed';

-- 9.3 Show full service report
SELECT *
FROM vw_service_report;

-- 9.4 Show payment report
SELECT *
FROM vw_payment_report;

-- 9.5 Show unpaid / remaining amounts
SELECT *
FROM vw_payment_report
WHERE remaining_amount > 0;

-- 9.6 Show customer service history
CALL GetCustomerServiceHistory(1);

-- 9.7 Show most expensive service
SELECT *
FROM services
ORDER BY price DESC
LIMIT 1;

-- 9.8 Test trigger: after this insert, order_id = 3 becomes Completed
INSERT INTO payments
(order_id, payment_date, amount, payment_method)
VALUES
(3, '2026-06-18', 100.00, 'Cash');

SELECT *
FROM work_orders;

-- 9.9 Show indexes
SHOW INDEX FROM vehicles;
SHOW INDEX FROM work_orders;


INSERT INTO customers
(first_name, last_name, phone, email, address)
VALUES
('Vazha', 'Papitashvili', '555509865', 'vazha10@gmail.com', 'Tbilisi');

SELECT * FROM customers;

DELETE FROM customers
WHERE customer_id = 11;
