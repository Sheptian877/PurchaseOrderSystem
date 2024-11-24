<?php
require 'includes/db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Ambil semua PO
$sql = "SELECT * FROM purchase_orders ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<h1>Purchase Orders List</h1>
<table border="1">
    <thead>
        <tr>
            <th>Order Number</th>
            <th>Order Date</th>
            <th>Supplier Name</th>
            <th>Product Name</th>
            <th>Quantity</th>
            <th>Total Price</th>
            <th>Created At</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo htmlspecialchars($row['order_number']); ?></td>
            <td><?php echo htmlspecialchars($row['order_date']); ?></td>
            <td><?php echo htmlspecialchars($row['supplier_name']); ?></td>
            <td><?php echo htmlspecialchars($row['product_name']); ?></td>
            <td><?php echo htmlspecialchars($row['quantity']); ?></td>
            <td><?php echo htmlspecialchars($row['total_price']); ?></td>
            <td><?php echo htmlspecialchars($row['created_at']); ?></td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<a href="index.php">Back to Create PO</a>
