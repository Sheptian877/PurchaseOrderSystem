<?php
require 'includes/db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $order_date = $_POST['order_date'];
    $supplier_name = $_POST['supplier_name'];
    $product_name = $_POST['product_name'];
    $quantity = $_POST['quantity'];
    $total_price = $_POST['total_price'];
    $created_by = $_SESSION['user_id'];

    // Generate Order Number
    $current_date = date("Ymd", strtotime($order_date)); // Format: YYYYMMDD
    $sql = "SELECT COUNT(*) AS order_count FROM purchase_orders WHERE DATE(order_date) = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $order_date);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $order_count = $row['order_count'] + 1; // Nomor urut untuk hari tersebut

    $order_number = "PO-" . $current_date . "-" . str_pad($order_count, 3, '0', STR_PAD_LEFT);

    // Insert into Database
    $sql = "INSERT INTO purchase_orders (order_number, order_date, supplier_name, product_name, quantity, total_price, created_by) 
            VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sssidi', $order_number, $order_date, $supplier_name, $product_name, $quantity, $total_price, $created_by);

    if ($stmt->execute()) {
        echo "Purchase order created with Order Number: " . $order_number;
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

// link ke halaman cetak 
<a href="print_po.php">View All Purchase Orders</a>

<h1>Purchase Orders</h1>
<form method="POST">
    <label>Order Date:</label><br>
    <input type="date" name="order_date" required><br>
    <label>Supplier Name:</label><br>
    <input type="text" name="supplier_name" required><br>
    <label>Product Name:</label><br>
    <input type="text" name="product_name" required><br>
    <label>Quantity:</label><br>
    <input type="number" name="quantity" required><br>
    <label>Total Price:</label><br>
    <input type="number" step="0.01" name="total_price" required><br>
    <button type="submit">Create Order</button>
</form>
