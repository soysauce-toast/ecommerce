<?php
    session_start();
    include "service/db_connection.php";

    $id = isset($_GET['product_id']) ? intval($_GET['product_id']) : 0;

    if ($id > 0) {
        $sql = "SELECT * FROM products WHERE product_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            $product = $result->fetch_assoc();
        } else {
            echo "Product not found.";
            exit;
        }
    } else {
        echo "Invalid product ID.";
        exit;
    }
    
    $conn->close();
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BLENDYS - <?php echo htmlspecialchars($product['product_name']); ?></title>
    <link rel="icon" type="image/x-icon" href="assets/img/logo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <style>
        .product {
            max-width: 1000px;
            margin: 0 auto;
            margin-top: 150px;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .main-section img {
            max-width: 100%;
            height: auto;
        }
        .main-section{
            max-width: 1200px;
            margin: 0 auto;
            margin-top: 100px;
            padding: 20px;
        }
        .product-quantity{
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 5px;
        }
        #img-cart{
            width: 100px;
            height: 100px;
        }
    </style>
</head>
<body>
    <?php include "view/navbar.html"?>

    <!-- Modal -->
    <div class="modal fade" id="modalSize" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Add to Cart</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col col-3">
                        <img id="img-cart" src="<?php echo htmlspecialchars($product['product_image']); ?>" alt="<?php echo htmlspecialchars($product['product_name']); ?>">
                    </div>
                    <div class="col mt-4">
                        <h6><?php echo htmlspecialchars($product['product_name']); ?></h6>
                        <p>Rp <?php echo number_format($product['product_price'], 0, ',', '.') ?></p>
                    </div>
                </div>
                <div class="row">
                    <p>Size: </p>
                </div>
                <div class="row">
                    <div class="d-grid gap-2 d-md-block">
                        <input class="btn btn-outline-secondary col-2" role="button" data-bs-toggle="button" type="button" value="M">
                        <input class="btn btn-outline-secondary col-2" type="button" role="button" data-bs-toggle="button" value="L">
                        <input class="btn btn-outline-secondary col-2" type="button" role="button" data-bs-toggle="button" value="XL">
                    </div>
                </div>
                <hr>
                <div class="row mb-3">
                    
                </div>
                <div class="row">
                    <form action="add_to_cart.php" method="post">
                        <div class="d-grid gap-2">
                            <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">
                            <input type="hidden" name="quantity" id="quantity" min="1" value="1">
                            <input class="btn btn btn-dark" type="submit" value="Add to Cart">
                        </div>
                    </form>
                </div>
            </div>
            </div>
        </div>
    </div>

    <div class="main-section container-fluid">
        <div class="row">
            <div class="col">
                <img src="<?php echo htmlspecialchars($product['product_image']); ?>" alt="<?php echo htmlspecialchars($product['product_name']); ?>">
            </div>
            <div class="col">
                <h3><?php echo htmlspecialchars($product['product_name']); ?></h3>
                <p>Rp <?php echo number_format($product['product_price'], 0, ',', '.') ?></p>

                <div class="product-quantity mb-3">
                    <div class="row">
                        <p>Quantity Information:</p>
                    </div>
                    <div class="row">
                        <div class="col col-11">
                            <p>Maximum Quantity</p>
                        </div>
                        <div class="col">
                            
                        </div>
                    </div>
                </div>

                <div class="size">
                    <div class="row">
                        <p>Size: </p>
                        <div class="row">
                            <div class="col col-10">
                                <p>M</p>
                                <p>Rp <?php echo number_format($product['product_price'], 0, ',', '.') ?></p> 
                            </div>
                            <div class="col">
                                <button class="btn btn-outline-dark ms-3" type="button" data-bs-toggle="modal" data-bs-target="#modalSize">Buy</button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col col-10">
                                <p>L</p>
                                <p>Rp <?php echo number_format($product['product_price'], 0, ',', '.') ?></p> 
                            </div>
                            <div class="col">
                            <button class="btn btn-outline-dark ms-3" type="button" data-bs-toggle="modal" data-bs-target="#modalSize">Buy</button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col col-10">
                                <p>XL</p>
                                <p>Rp <?php echo number_format($product['product_price'], 0, ',', '.') ?></p> 
                            </div>
                            <div class="col">
                                <button class="btn btn-outline-dark ms-3" type="button" data-bs-toggle="modal" data-bs-target="#modalSize">Buy</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="add-to-cart mb-5">
                    <button class="btn btn-outline-dark col-12" type="button" data-bs-toggle="modal" data-bs-target="#modalSize">Add to Cart</button>
                </div>

                <div class="description">
                    <p><?php echo nl2br(htmlspecialchars($product['description'])); ?></p>
                </div>

            </div>
        </div>
    </div>

    <?php include "view/footer.html" ?>
    <script src="https://kit.fontawesome.com/30efd65033.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>