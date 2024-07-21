<?php
include "service/db_connection.php";
session_start();

$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];

$products = [];
if ($cart) {
    $ids = implode(',', array_keys($cart));
    $stmt = $pdo->query("SELECT * FROM product WHERE product_id IN ($ids)");
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Cart</title>
    <link rel="icon" type="image/x-icon" href="assets/img/logo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .container-fluid{
            margin-top: 90px;
            width: 80%;
            height: auto;
        }
        .checkout-summary{
            border: 1px solid #ddd;
            border-radius: 10px;
            height: 250px;
        }
        .cart-item{
            border: 2px solid #ddd;
            border-radius: 10px;
            padding: 5px;
        }
        .cart-item img{
            width:100px;
        }
        .item{
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 5px;
        }
        .navbar{
            height: 90px;
        }
        .check-b{
            margin-top: 40px;
            margin-left: 10px;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand bg-body-tertiary">
        <div class="container">
            <a href="shop.php" class="navbar-brand" href="#"><i class="fa-solid fa-arrow-left"></i></a>
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active mt-2" aria-current="page" href="#"><h3>Cart</h3></a>
                </li>
            </ul>
        </div>
    </nav>
    <?php
        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) { 
            $user_id = $_SESSION['user_id'];
            // Fetch cart items from database
            $sql = "SELECT cart.id as cart_id, products.product_name, products.product_price, products.product_image, cart.quantity 
            FROM cart 
            JOIN products ON cart.product_id = products.product_id WHERE user_id = '$user_id'";
            $result = $conn->query($sql);
            ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <h3>My Cart</h3>
                <div class="cart-item">
                    <div class="items">
                        <?php
                        $total_price = 0;
                        while($row = $result->fetch_assoc()):
                            $total = $row['product_price'] * $row['quantity'];
                            $total_price += $total;
                        ?>
                            <div class="item mb-2">
                                <div class="row">
                                    <div class="col col-1">
                                        <div class="check-b">
                                            <input class="form-check-input" type="checkbox" id="checkboxNoLabel" value="" aria-label="..." checked> 
                                        </div>
                                    </div>
                                    <div class="col col-2">
                                        <img src="<?php echo $row['product_image']; ?>">
                                    </div>
                                    <div class="col col-3 mt-4">
                                        <div class="row">
                                            <p><?php echo $row['product_name']; ?></p>
                                        </div>
                                        <div class="row">
                                            <p>Rp <?php echo number_format($row['product_price'], 0, ',', '.') ?></p>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <form action="update_cart.php" method="post" style="display:inline;">
                                            <input type="hidden" name="cart_id" value="<?php echo $row['cart_id']; ?>">
                                            <input class="" type="number" name="quantity" value="<?php echo $row['quantity']; ?>" min="1">
                                            <input type="submit" value="Update">
                                        </form>

                                        <form action="remove_from_cart.php" method="post" style="display:inline;">
                                            <input type="hidden" name="cart_id" value="<?php echo $row['cart_id']; ?>">
                                            <input type="submit" value="Remove">
                                        </form>
                                    </div>
                                </div>
                            </div>

                        <?php endwhile; ?>
                    </div>
                </div>
            </div>

            <div class="checkout-summary col col-4">
                <div class="row">
                    <h6>Checkout Summary</h6>
                </div>
                <div class="row h-50">
                    
                </div>
                <div class="row">
                    <div class="d-flex">
                        <h6>Total Price</h6>
                        <div class="price ms-auto">
                            <p>Rp <?php echo number_format($total_price, 0, ',', '.')?></p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="d-grid gap-2">
                        <a href="checkout_page.php"><input class="btn btn btn-dark col-12" type="submit" value="Checkout"></a>
                    </div>
                </div>
            </div>
        </div>
        <?php } else { ?>
                <div class="container text-center justify-content-center">
                    <h5>Please Login to see your cart</h5>
                </div>
        <?php } ?>
    </div>
    <script src="https://kit.fontawesome.com/30efd65033.js" crossorigin="anonymous"></script>
</body>
</html>