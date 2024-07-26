<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['username']) && isset($_POST['password'])) {
        include '../config/db.php';

        $username = $_POST['username'];
        $password = $_POST['password'];


        $query = "SELECT * FROM admin WHERE username='$username' AND password='$password'";
        $result = $conn->query($query);

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $_SESSION['username'] = $row['username'];
            $_SESSION['role'] = $row['role_id']; 

            header("Location: ../index.php");
            exit;
        } else {
            echo "خطأ: بيانات الدخول غير صحيحة";
        }

        $conn->close();
    } else {
        echo "يرجى إدخال كل من اسم المستخدم وكلمة المرور";
    }
}
?>
