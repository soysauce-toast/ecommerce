<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings</title>
    <link rel="icon" type="image/x-icon" href="assets/img/logo.png">
    <link rel="stylesheet" href="view/style.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
    <style>
        .container{
            margin-top: 200px;
            margin-bottom: 200px;
            display: flex;
            justify-content: center;
        }
        .my-settings{
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 5px;
            width: 250px;
        }
        .settings-detail{
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 5px;
            width: 500px;
        }
    </style>
</head>
<body>

    <?php include "view/navbar.html" ?>

    <!--Modal Logout-->
    <div class="modal fade" id="modalLogout" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
            <div class="modal-body">
                <h5 class="modal-title fs-5" id="exampleModalLabel">Are you sure want to logout?</h5>
                <div class="text-end mt-5">
                    <input type="button" class="btn btn-light" data-bs-dismiss="modal" value="Close"></button>
                    <a href="logout.php"><input class="btn btn-dark" type="button" value="Logout"></a>
                </div>
            </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col">
                <div class="my-settings">
                    <h5>My Settings</h5>
                    <div class="row">
                        <div class="d-grid gap-2">
                            <button class="btn btn-light" type="button">My Profile Info</button>
                            <button class="btn btn-light" type="button">Delivery Information</button>
                            <button class="btn btn-light" type="button" data-bs-toggle="modal" data-bs-target="#modalLogout">Logout</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="settings-detail">
                    <div class="row">
                        <h5>My Account Info</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include "view/footer.html" ?>
</body>
</html>