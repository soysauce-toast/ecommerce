<?php
session_start();
include "service/db_connection.php";
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Profile</title>
    <link rel="icon" type="image/x-icon" href="assets/img/logo.png">
    <link rel="stylesheet" href="view/style.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
    <style>
        body {
            margin-top: 150px;
        }
        .my-order{
          margin-bottom: 300px;
        }
        .order-detail{
          border: 2px solid #ddd;
          border-radius: 10px;
          padding: 5px;
        }
    </style>

</head>
  <body>
    <?php include "view/navbar.html" ?>

    <!--Modal SignUp-->
    <div class="modal fade" id="modal-signup" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Sign Up</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body mb-3"> 
              <form action="sign_up.php" method="post">
                <div class="d-grid gap-1">
                  <label for="">Create account to be our member to earn points, get free vouchers, and hear our news earlier.</label>
                  <br>

                  <input class="form-control mb-2" type="text" name="full-name" id="full-name" placeholder="Your Full Name">
                  <input class="form-control mb-2" type="email" name="email" id="your-email" placeholder="Your Email">
                  <input class="form-control mb-2" type="password" name="password" id="your-password" placeholder="Password">
                  <br>
                  <input class="btn btn btn-dark" type="submit" value="Create New Account">
                </div>
              </form>
            </div>
          </div>
        </div>
    </div>

    <!--Modal Login-->
    <div class="modal fade" id="modal-login" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Login</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body mb-3"> 
              <form action="login.php" method="post">
                <div class="d-grid gap-2">
                  <input class="form-control mb-2" type="email" name="email" id="full-name" placeholder="Your Email">
                  <input class="form-control mb-2" type="password" name="password" id="your-email" placeholder="Password">
                  <input class="btn btn btn-dark" type="submit" value="Login">
                </div>
              </form>
            </div>
          </div>
        </div>
    </div>

    <!--Profile-->
    <div class="container">
      <?php
        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) { ?>
          <?php $user_id = $_SESSION['user_id']; 
          $session_id = session_id();
          $stmt = $pdo->prepare("SELECT * FROM orders WHERE session_id = ? AND user_id = '$user_id'");
          $stmt->execute([$session_id]);
          $orders = $stmt->fetchAll();
          ?>

          <div class="nama-profile">
            <svg width="64" height="64" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M32 64C49.6731 64 64 49.6731 64 32C64 14.3269 49.6731 0 32 0C14.3269 0 0 14.3269 0 32C0 49.6731 14.3269 64 32 64Z" fill="url(#paint0_linear)"/>
                <mask id="mask0" mask-type="alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="64" height="64">
                <path d="M32 64C49.6731 64 64 49.6731 64 32C64 14.3269 49.6731 0 32 0C14.3269 0 0 14.3269 0 32C0 49.6731 14.3269 64 32 64Z" fill="white"/>
                </mask>
                <g mask="url(#mask0)">
                <path d="M26.2976 44.5764C28.1456 41.5031 32.3882 35.6118 42.4911 27.3336C57.7361 14.8417 43.3451 3.41901 27.8872 9.50519C26.2336 10.1563 21.6508 7.55087 17.4063 10.2968C14.6682 12.0681 15.7341 13.456 14.668 14.8439C13.6019 16.2319 9.49133 16.1507 8.59135 19.7553C8.05822 21.8905 9.53429 24.1269 9.33727 25.7338C9.14024 27.3408 7.58223 28.7897 7.50814 30.9112C7.37645 34.6825 10.3224 37.8464 14.0882 37.9779C14.1088 41.6455 17.0101 44.6815 20.6973 44.8103C21.874 44.8513 22.9915 44.5915 23.9759 44.0997C24.9844 45.0289 25.85 45.3209 26.2976 44.5764Z" fill="url(#paint1_linear)"/>
                <path fill-rule="evenodd" clip-rule="evenodd" d="M26.6666 41.3867C26.6666 39.4667 26.6013 29.9964 26.6045 29.8363C21.3333 30.6133 21.44 20.5867 26.7733 23.04C27.9466 23.7867 31.2533 23.04 30.9333 16.8533C36.6933 23.04 43.3806 15.8242 43.9541 21.7041C44.7371 29.733 43.9495 38.1353 38.9597 38.1358C38.4822 38.1359 37.9401 38.0817 37.3333 37.9733C37.3333 39.1822 37.3333 40.6044 37.3333 41.3867C37.3333 43.52 41.1733 44.5867 41.1733 44.5867C41.1733 44.5867 34.5405 50.8364 31.7866 50.8028C29.0328 50.7692 22.8266 44.5867 22.8266 44.5867C22.8266 44.5867 26.6666 43.52 26.6666 41.3867Z" fill="url(#paint2_linear)"/>
                <mask id="mask1" mask-type="alpha" maskUnits="userSpaceOnUse" x="22" y="16" width="23" height="35">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M26.6666 41.3867C26.6666 39.4667 26.6013 29.9964 26.6045 29.8363C21.3333 30.6133 21.44 20.5867 26.7733 23.04C27.9466 23.7867 31.2533 23.04 30.9333 16.8533C36.6933 23.04 43.3806 15.8242 43.9541 21.7041C44.7371 29.733 43.9495 38.1353 38.9597 38.1358C38.4822 38.1359 37.9401 38.0817 37.3333 37.9733C37.3333 39.1822 37.3333 40.6044 37.3333 41.3867C37.3333 43.52 41.1733 44.5867 41.1733 44.5867C41.1733 44.5867 34.5405 50.8364 31.7866 50.8028C29.0328 50.7692 22.8266 44.5867 22.8266 44.5867C22.8266 44.5867 26.6666 43.52 26.6666 41.3867Z" fill="white"/>
                </mask>
                <g mask="url(#mask1)">
                <g style="mix-blend-mode:multiply" opacity="0.7">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M37.3333 37.9733C32.9976 37.0335 29.9448 34.7519 29.9448 34.7519C29.9448 34.7519 31.7867 39.2533 37.3268 40.1067L37.3333 37.9733Z" fill="url(#paint3_linear)"/>
                </g>
                </g>
                <path fill-rule="evenodd" clip-rule="evenodd" d="M51.6266 50.9867C53.1744 54.4261 53.9733 64.8534 53.9733 64.8534H10.0266C10.0266 64.8534 10.8255 54.4261 12.3733 50.9867C13.7292 47.9738 22.6642 44.5144 25.2827 43.52C26.7952 45.2113 28.9613 46.2934 32 46.2934C35.0386 46.2934 37.2048 45.2113 38.7172 43.52C41.3358 44.5144 50.2708 47.9738 51.6266 50.9867Z" fill="url(#paint4_linear)"/>
                <mask id="mask2" mask-type="alpha" maskUnits="userSpaceOnUse" x="10" y="43" width="44" height="22">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M51.6266 50.9867C53.1744 54.4261 53.9733 64.8534 53.9733 64.8534H10.0266C10.0266 64.8534 10.8255 54.4261 12.3733 50.9867C13.7292 47.9738 22.6642 44.5144 25.2827 43.52C26.7952 45.2113 28.9613 46.2934 32 46.2934C35.0386 46.2934 37.2048 45.2113 38.7172 43.52C41.3358 44.5144 50.2708 47.9738 51.6266 50.9867Z" fill="white"/>
                </mask>
                <g mask="url(#mask2)">
                </g>
                <path fill-rule="evenodd" clip-rule="evenodd" d="M11.9627 51.0562C13.1235 48.8486 16.9446 46.5319 20.4778 44.9705C22.2399 44.1919 27.52 66.56 27.52 66.56H9.83106C9.83106 66.56 9.6179 55.515 11.9627 51.0562Z" fill="url(#paint5_linear)"/>
                </g>
                <defs>
                <linearGradient id="paint0_linear" x1="0" y1="0" x2="0" y2="64" gradientUnits="userSpaceOnUse">
                <stop stop-color="#806A6A"/>
                <stop offset="1" stop-color="#665654"/>
                </linearGradient>
                <linearGradient id="paint1_linear" x1="49.2842" y1="8.25616" x2="47.9739" y2="45.78" gradientUnits="userSpaceOnUse">
                <stop stop-color="#1D0024"/>
                <stop offset="1" stop-color="#100014"/>
                </linearGradient>
                <linearGradient id="paint2_linear" x1="22.7115" y1="16.8533" x2="22.7115" y2="50.803" gradientUnits="userSpaceOnUse">
                <stop stop-color="#E6864E"/>
                <stop offset="1" stop-color="#EB965E"/>
                </linearGradient>
                <linearGradient id="paint3_linear" x1="34.7804" y1="34.9964" x2="35.8855" y2="39.9759" gradientUnits="userSpaceOnUse">
                <stop stop-color="#E68349"/>
                <stop offset="1" stop-color="#F09960"/>
                </linearGradient>
                <linearGradient id="paint4_linear" x1="53.9733" y1="64.8534" x2="53.9733" y2="43.52" gradientUnits="userSpaceOnUse">
                <stop stop-color="#FFC9B3"/>
                <stop offset="1" stop-color="#FFD2C2"/>
                </linearGradient>
                <linearGradient id="paint5_linear" x1="27.52" y1="66.56" x2="27.52" y2="44.9443" gradientUnits="userSpaceOnUse">
                <stop stop-color="#FCF2EB"/>
                <stop offset="1" stop-color="#FFF9F5"/>
                </linearGradient>
                </defs>
                </svg>
            <h5 class="mt-3"><?php echo $_SESSION['full_name'] ?></h5>
          </div>

          <!--Order-->
          <div class="my-order d-flex justify-content-center mt-5">
            <ul class="nav nav-underline">
              <li class="nav-item">
                <a class="nav-link active text-center" aria-current="page" href="#">My Order</a>
                <div class="container">
                  <?php foreach ($orders as $order): ?>
                    <div class="order-detail mb-2">
                        <h6>Order Id : <?php echo $order['id']; ?> - Total : Rp <?php echo number_format($order['total'], 0, ',', '.'); ?> - <a href="">Details</a></h6>
                    </div>
                  <?php endforeach; ?>
                </div>
              </li>
            </ul>
          </div>

          <script>
              const settings = document.getElementById("settings");
              const profile = document.getElementById("profile");
              const cart = document.getElementById("cart");

              settings.classList.remove("d-none");
              profile.classList.add("d-none");
              cart.style.visibility = "visible";
          </script>
      <?php } else { ?>
              <script>
                const profile = document.getElementById("profile");
                const cart = document.getElementById("cart");

                profile.classList.add("d-none");
                cart.style.visibility = "hidden";
              </script>
              <!--Benefit-->
              <div class="benefit">
                <p><b>Get VIP service with our 1-step login:</b></p>
                <p>★ Be the first to get special discounts.</p>
                <p>★ Never lose any of your orders.</p>
              </div>

              <!--Button Login-->
              <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                <button class="btn btn-outline-dark col-2" type="button" data-bs-toggle="modal" data-bs-target="#modal-signup">Sign Up</button>
                <button class="btn btn-dark col-2" type="button" data-bs-toggle="modal" data-bs-target="#modal-login">Login</button>
              </div>

              <!--Order-->
              <div class="my-order d-flex justify-content-center mt-5">
                <ul class="nav nav-underline">
                  <li class="nav-item">
                    <a class="nav-link active text-center" aria-current="page" href="#">My Order</a>
                  </li>
                </ul>
              </div>
              
      <?php } ?>

      
    </div>

    <?php include "view/footer.html" ?>

  </body>
  <script src="script.js"></script>
  <script src="https://kit.fontawesome.com/30efd65033.js" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</html>
