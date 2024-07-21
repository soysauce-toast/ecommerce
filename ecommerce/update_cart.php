<?php
include "service/db_connection.php";

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cart_id = $_POST['cart_id'];
    $quantity = $_POST['quantity'];

    // Update the quantity of the product in the cart
    $sql = "UPDATE cart SET quantity = $quantity WHERE id = $cart_id";

    if ($conn->query($sql) === TRUE) {
        echo "Cart updated successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
header('Location: cart.php');
exit();
?>
