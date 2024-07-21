<?php
include "service/db_connection.php";

function findEmail($email){
    $sql = "SELECT * FROM users WHERE email = '$email'";

    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result)>0){

    }
}
?>