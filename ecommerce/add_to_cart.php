<?php
session_start();
include "service/db_connection.php";

$user_id = $_SESSION['user_id'];

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $product_id = $_POST['product_id'];
        $quantity = $_POST['quantity'];
        $session_id = session_id();
    
        // Check if the product is already in the cart
        $stmt = $pdo->prepare("SELECT * FROM cart WHERE product_id = ? AND session_id = ?");
        $stmt->execute([$product_id, $session_id]);
        $item = $stmt->fetch();
    
        if ($item) {
            // Update quantity if product is already in the cart
            $stmt = $pdo->prepare("UPDATE cart SET quantity = quantity + ? WHERE product_id = ? AND session_id = ?");
            $stmt->execute([$quantity, $product_id, $session_id]);
        } else {
            // Insert new item into cart
            $stmt = $pdo->prepare("INSERT INTO cart (user_id, product_id, quantity, session_id) VALUES (?, ?, ?, ?)");
            $stmt->execute([$user_id, $product_id, $quantity, $session_id]);
        }
    }
    
    $conn->close();
    header('Location: cart.php');
}else{
    header("location:cart.php");
}
exit;
?>