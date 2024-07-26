<?php
include('../config/db.php'); 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_POST['user_id'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $role_id = $_POST['role']; 

    if (!empty($user_id) && !empty($username) && !empty($password) && !empty($email) && !empty($role_id)) {
        // استخدام mysqli_real_escape_string للحماية من حقن SQL
        $username = mysqli_real_escape_string($conn, $username);
        $password = mysqli_real_escape_string($conn, $password);
        $email = mysqli_real_escape_string($conn, $email);
        
        $sql = "UPDATE admin SET username='$username', password='$password', email='$email', role_id='$role_id' WHERE id='$user_id'";

        if (mysqli_query($conn, $sql)) {
            echo "تم تحديث بيانات المستخدم بنجاح.";
            header("location:../users.php"); // توجيه المستخدم إلى صفحة الاستخدام بعد التحديث
        } else {
            echo "خطأ في التحديث: " . mysqli_error($conn);
        }
    } else {
        echo "يرجى ملء جميع الحقول لتحديث بيانات المستخدم.";
    }

    mysqli_close($conn);
}
?>
