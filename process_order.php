<?php
// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "purchase_order_db";

// Buat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Ambil data dari form
$order_number = $_POST['order_number'];
$customer_name = $_POST['customer_name'];
$product_name = $_POST['product_name'];
$quantity = $_POST['quantity'];
$price = $_POST['price'];

// Hitung total
$total = $quantity * $price;

// Query untuk menyimpan data ke database
$sql = "INSERT INTO purchase_orders (order_number, customer_name, product_name, quantity, price, total) 
        VALUES ('$order_number', '$customer_name', '$product_name', $quantity, $price, $total)";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully<br>";
    echo "<a href='form_order.html'>Back to Order Form</a>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Tutup koneksi
$conn->close();
?>
