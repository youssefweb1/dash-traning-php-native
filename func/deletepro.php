<?php
include '../config/db.php'; 

    $product_id = $_GET['id'];

    $delete_query = "DELETE FROM products WHERE product_id = $product_id";

    if (mysqli_query($conn, $delete_query)) {
        header("Location: ../products.php"); 
        exit();
    } else {
        echo "Error deleting product: " . mysqli_error($conn);
    }

    mysqli_close($conn);

?>
