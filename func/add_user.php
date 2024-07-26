<?php
include('../config/db.php'); 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $role_id = $_POST['role']; 

    $username = mysqli_real_escape_string($conn, $username);
    $password = mysqli_real_escape_string($conn, $password);
    $email = mysqli_real_escape_string($conn, $email);

    $sql = "INSERT INTO admin (username, password, email, role_id) VALUES ('$username', '$password', '$email', '$role_id')";

    if (mysqli_query($conn, $sql)) {
        echo "تم إضافة المستخدم بنجاح.";
        header("location:../users.php");
    } else {
        echo "خطأ في الإضافة: " . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>
