<?php
include('../config/db.php'); 

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $user_id = $_GET['id'];

    $user_id = mysqli_real_escape_string($conn, $user_id);

    $sql = "DELETE FROM admin WHERE id = '$user_id'";

    if (mysqli_query($conn, $sql)) {
        echo "تم حذف المستخدم بنجاح.";
        header("location:../users.php");
    } else {
        echo "خطأ في الحذف: " . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>
