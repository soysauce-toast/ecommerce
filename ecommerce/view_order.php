<?php
session_start();
include "service/db_connection.php";

$session_id = session_id();
$stmt = $pdo->prepare("SELECT * FROM orders WHERE session_id = ?");
$stmt->execute([$session_id]);
$orders = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Orders</title>
</head>
<body>
    <h1>Your Orders</h1>
    <?php foreach ($orders as $order): ?>
        <h2>Order #<?php echo $order['id']; ?> - Total: Rp <?php echo $order['total']; ?> - Date: <?php echo $order['created_at']; ?></h2>
        <table>
            <tr>
                <th>Product</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
            </tr>
            <?php
            $stmt = $pdo->prepare("SELECT p.product_name, oi.price, oi.quantity FROM order_items oi JOIN products p ON oi.product_id = p.product_id WHERE oi.order_id = ?");
            $stmt->execute([$order['id']]);
            $order_items = $stmt->fetchAll();
            ?>
            <?php foreach ($order_items as $item): ?>
                <tr>
                    <td><?php echo htmlspecialchars($item['product_name']); ?></td>
                    <td><?php echo htmlspecialchars($item['price']); ?></td>
                    <td><?php echo htmlspecialchars($item['quantity']); ?></td>
                    <td><?php echo htmlspecialchars($item['price'] * $item['quantity']); ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endforeach; ?>
</body>
</html>
