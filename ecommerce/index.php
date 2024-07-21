<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>E Commerce</title>
    <link rel="icon" type="image/x-icon" href="assets/img/logo.png">
    <link rel="stylesheet" href="style.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
  </head>
  <style>
    .gambar{
      height: 500px;
      width: 1920px;
      object-fit: cover;
      object-position: 25% 50%;
    }
    
    .category img{
      width: 720px;
      width: 720px;
      object-fit: cover;
    }
  </style>
  <body>
    <!--Navbar-->
    <?php include "view/navbar.html" ?>

    <?php include "view/cart.html" ?>

    <!--Carousel-->
    <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-inner">
        <div class="carousel-item active" data-bs-interval="300">
          <img src="assets/img/caroussel-1.jpg" class="d-block w-100" alt="..." />
        </div>
        <div class="carousel-item">
          <img src="assets/img/caroussel-2.jpg" class="d-block w-100" alt="..." />
        </div>
        <div class="carousel-item">
          <img src="assets/img/caroussel-3.jpg" class="d-block w-100" alt="..." />
        </div>
      </div>
    </div>

    <!--Slide-->
    <div class="featured mb-5 mt-3">
      <img class="gambar img-fluid" src="assets/img/image.jpeg" alt=""/>
    </div>

    <!--Category-->
    <div class="category ms-4 mb-3">
      <div class="row">
        <div class="col ">
          <a href="shop.php"><img src="assets/img/hoodie.png" alt=""></a>
        </div>
        <div class="col">
        <a href="shop.php"><img src="assets/img/tshirt.png" alt=""></a>
        </div>
      </div>
    </div>

    <!--Footer-->
    <?php include "view/footer.html" ?>

  </body>
  <script src="script.js"></script>
  <script src="https://kit.fontawesome.com/30efd65033.js" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</html>
