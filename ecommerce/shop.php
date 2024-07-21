<?php
    session_start();
    include "service/db_connection.php";

    $sql = "SELECT * FROM products";
    $result = $conn->query($sql);

    if(isset($_POST['btn-search'])){
    
      $search_product = $_POST['search-product'];
  
      $sql = "SELECT * FROM products WHERE product_name LIKE '%$search_product%'";
      $result = $conn->query($sql);
    }

    if(isset($_POST['btn-all-product'])){

      $sql = "SELECT * FROM products";
      $result = $conn->query($sql);
    }

    if(isset($_POST['btn-category-hoodie'])){

      $sql = "SELECT * FROM products WHERE product_category = 'hoodie'";
      $result = $conn->query($sql);
    }

    if(isset($_POST['btn-category-tee'])){

      $sql = "SELECT * FROM products WHERE product_category = 'tee'";
      $result = $conn->query($sql);
    }

    if(isset($_POST['btn-category-special'])){

      $sql = "SELECT * FROM products WHERE product_category = 'special'";
      $result = $conn->query($sql);
    }
    
    if(isset($_POST['btn-lowest-price'])){
      $sql = "SELECT * FROM products ORDER BY product_price ASC";
      $result = $conn->query($sql);
    }

    if(isset($_POST['btn-highest-price'])){
      $sql = "SELECT * FROM products ORDER BY product_price DESC";
      $result = $conn->query($sql);
    }

    if(isset($_POST['btn-price-apply'])){
      $priceRange = $_POST['priceRange'];

      $sql = "SELECT * FROM products WHERE product_price >= $priceRange";

      $result = $conn->query($sql);
    }

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Products</title>
    <link rel="icon" type="image/x-icon" href="assets/img/logo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
      body{
        margin-top: 150px;
      }

      .main-section{
        width: 80%;
      }
      .cutom-button {
          color: black;
          background-color: transparent;
          border-radius: 10px;
          border: 1px solid white;
          font-size: 1rem;
          font-weight: 400;
          text-align: left;
      }
      .btn-group-custom {
          position: relative;
          display: contents;
          vertical-align: center;
      }
      .form-outline{
        margin-left: 20px;
      }
      .btn-search{
        margin-left: -60px;
        margin-bottom: 7px;
      }
      hr{
        width: 100%;
        border-top: 1px solid black;
        opacity: .3;
      }
      .filter{
        border: 1px solid #ddd;
        border-radius: 10px;
        padding: 10px;
        width: 250px;
      }
      .sort-product{
        display: flex;
        align-items: center;
      }
      .search-magnifier{
        margin-left: 5px;
      }
      .product-name{
        font-size: 20px;
      }
    </style>
  
  </head>
  <body>
      <?php include "view/navbar.html"?>

      <!--Offcanvas Search-->
      <div class="offcanvas offcanvas-top" tabindex="-1" id="offcanvasSearch" aria-labelledby="offcanvasExampleLabel">
        <div class="offcanvas-header">
          <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body container">
          <form action="" method="post">
            <div class="form-outline mt-3">
                <input type="text" class="form-control-lg col-10" name="search-product" placeholder="Search Our Products.."/>
                <button type="submit" class="btn btn-search" name="btn-search">
                  <img src="https://img.icons8.com/000000/search" width="27.5" alt="">
                </button>
            </div>
          </form>
        </div>
      </div>

      <!--Modal Sort Product-->
      <div class="modal fade" id="modal-sort-product" tabindex="-1" aria-labelledby="modal-sort-product" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Sort product by</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="row mb-4">
              <div class="d-grid gap-2 d-md-block">
                <button class="btn btn-outline-dark" type="button">All</button>
                <button class="btn btn-outline-dark" type="button">Available</button>
              </div>
              </div>
              <div class="row">
              <div class="d-grid gap-2">
                <button class="btn btn-light" type="button">Featured</button>
                <button class="btn btn-light" type="button">Recent</button>
                <button class="btn btn-light" type="button">Oldest</button>
                <button class="btn btn-light" type="button">Lowest Price</button>
                <button class="btn btn-light" type="button">Highest Price</button>
              </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!--Main Section-->
        <div class="main-section container-fluid mt-5 mb-5">
          <div class="row">
            <div class="col-3 pt-4">
              <div class="filter">
                <!--Search-->
                <div class="filter-search mb-3">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="search-magnifier" viewBox="0 0 16 16">
                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                  </svg>
                  <input type="button" class="btn col-10 text-start" data-bs-toggle="offcanvas" data-bs-target="#offcanvasSearch" aria-controls="offcanvasSearch" value="Search">
                  <form action="" method="post">
                    <input type="submit" class="btn col-12 text-start" name="btn-all-product" value="All Product">
                  </form>
                  <hr>
                </div>

                <!--Categories-->
                <div class="filter-category">
                  <button type="button" class="btn col-12 text-start" data-bs-toggle="collapse" data-bs-target="#collapseCategory" aria-expanded="false" aria-controls="collapseCategory">Categories</button>
                  <div class="expand" id="collapseCategory">
                    <div class="card card-body">
                      <form action="" method="post">
                        <input type="submit" class="btn col-12 text-start" name="btn-category-hoodie" value="HOODIE">
                        <input type="submit" class="btn col-12 text-start" name="btn-category-tee" value="TEE">
                        <input type="submit" class="btn col-12 text-start" name="btn-category-special" value="Special">
                      </form>
                    </div>
                  </div>
                  <hr>
                </div>

                <!--Price-->
                <div class="filter-price">
                  <button type="button" class="btn col-12 text-start" data-bs-toggle="collapse" data-bs-target="#collapsePrice" aria-expanded="false" aria-controls="collapsePrice">Price</button>
                  <div class="expand" id="collapsePrice">
                    <div class="card card-body">
                      <form action="" method="post">
                        <input type="range" class="form-range" name="priceRange" min="0" max="1000000" step="10000" oninput="updatePriceDisplay(this.value)">
                        <span id="priceDisplay">Minimum Rp 0</span><br>
                        <input type="submit" class="btn col-12 text-start mt-3 mb-3" name="btn-lowest-price" value="Lowest Price">
                        <input type="submit" class="btn col-12 text-start mb-4" name="btn-highest-price" value="Highest Price">
                        <input type="submit" class="btn btn-dark col-12 mb-2" name="btn-price-apply" value="Apply">
                      </form>
                    </div>
                  </div>
                </div>

              </div>
            </div>

            <div class="col">

              <!--Sort Product-->
              <div class="sort-product justify-content-end text-end mb-3">
                <p class="mb-1 p-2">Sort Product by</p>
                <button class="btn btn-outline-secondary col-1" type="button" data-bs-toggle="modal" data-bs-target="#modal-sort-product">All</button>
              </div>

              <!--Catalog-->
              <div class="row row-cols-3 g-4">
                  <?php while($show = $result->fetch_assoc()): ?>
                  <div class="col">
                    <div class="card">
                      <a href="product.php?product_id=<?php echo $show['product_id']; ?>"><img src="<?php echo $show['product_image']?>" class="card-img-top" alt="..."></a>
                      <div class="card-body">
                        <p class="card-title product-name"><?php echo $show['product_name']?></p>
                        <h6 class="card-title">Rp <?php echo number_format($show['product_price'], 0, ',', '.') ?></h6>
                        <div class="star">
                          <i class="fa-solid fa-star"></i>
                          <i class="fa-solid fa-star"></i>
                          <i class="fa-solid fa-star"></i>
                          <i class="fa-solid fa-star"></i>
                          <i class="fa-regular fa-star"></i>
                        </div>
                      </div>
                    </div>
                  </div>
                  <?php endwhile; ?>
                </div>
              </div>

            </div>

          </div>
        </div>
      
      <?php include "view/footer.html"?>

    <script src="view/script.js"></script>
    <script src="https://kit.fontawesome.com/30efd65033.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>