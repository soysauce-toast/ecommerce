<?php
    session_start();
    include "service/db_connection.php";
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $fullname = $_POST['full-name'];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    
        $sql = "INSERT INTO users (full_name, email, password) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $fullname, $email, $password);
    
        if ($stmt->execute()) {
            echo "Registration successful!";
            header("location:profile.php");
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    
        $stmt->close();
        $conn->close();

    }
?>