<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
include '../config/db.php';
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role']; 

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO admin (username, email, password, role_id) VALUES ('$name', '$email', '$hashed_password', '$role')";
    if ($conn->query($sql) === TRUE) {
        header('Location: login.php');
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
