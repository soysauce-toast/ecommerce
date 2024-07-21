<?php
session_start();
include "service/db_connection.php";

$session_id = session_id();
$user_id = $_SESSION['user_id'];

// Fetch cart items
$stmt = $pdo->prepare("SELECT p.product_id, p.product_name, p.product_price, c.quantity FROM cart c JOIN products p ON c.product_id = p.product_id WHERE c.session_id = ?");
$stmt->execute([$session_id]);
$cart_items = $stmt->fetchAll();

if (empty($cart_items)) {
    die("Your cart is empty!");
}

// Calculate total
$total = 0;
foreach ($cart_items as $item) {
    $total += $item['product_price'] * $item['quantity'];
}

// Create order
$stmt = $pdo->prepare("INSERT INTO orders (user_id, session_id, total) VALUES (?, ?, ?)");
$stmt->execute([$user_id, $session_id, $total]);
$order_id = $pdo->lastInsertId();

// Insert order items
$stmt = $pdo->prepare("INSERT INTO order_items (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)");
foreach ($cart_items as $item) {
    $stmt->execute([$order_id, $item['product_id'], $item['quantity'], $item['product_price']]);
}

// Clear cart
$stmt = $pdo->prepare("DELETE FROM cart WHERE user_id = '$user_id'");
$stmt->execute();

echo "Order placed successfully!";
header("location:profile.php");
?>
