<?php
session_start();
include "../config/db.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_SESSION['username'])) {
        header("Location: login.php");
        exit;
    }

    

    // استخراج البيانات من POST
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // تحضير الاستعلام للتحديث
    $sql = "UPDATE admin SET username='$username', email='$email', password='$password' ";

    if ($conn->query($sql) === TRUE) {
        echo "تم تحديث المعلومات بنجاح";
    } else {
        echo "خطأ في التحديث: " . $conn->error;
    }

    $conn->close();
}
