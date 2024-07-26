<?php
include '../config/db.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_GET['id'])) {
    $product_id = $_GET['id'];

    $product_name = $_POST['product_name']; 
    $product_price = $_POST['product_price']; 
    $product_dimensions = $_POST['product_dimensions']; 
    $product_stock = $_POST['product_stock']; 
    $product_category = $_POST['product_category']; 
    $product_brand = $_POST['product_brand']; 
    $product_memory1 = isset($_POST['product_memory1']) ? $_POST['product_memory1'] : '';
    $product_memory2 = isset($_POST['product_memory2']) ? $_POST['product_memory2'] : ''; 
    $product_memory3 = isset($_POST['product_memory3']) ? $_POST['product_memory3'] : '';
    $product_description = isset($_POST['product_description']) ? $_POST['product_description'] : '';

    if (!empty($_FILES['image']['name'][0])) {
        $images = []; 

        foreach ($_FILES['image']['name'] as $key => $image_name) {
            $file_temp = $_FILES['image']['tmp_name'][$key]; 
            $file_destination = "../uploads/" . $image_name;

            if (move_uploaded_file($file_temp, $file_destination)) {
                $images[] = $image_name; 
            } else {
                echo "Failed to upload image."; 
            }
        }

        $image_string = implode(",", $images); 

        $image_update_query = "UPDATE products SET image = '$image_string' WHERE product_id = $product_id"; 
        mysqli_query($conn, $image_update_query);
    }

    $update_query = "UPDATE products SET 
                    product_name = '$product_name',
                    price = '$product_price',
                    dimensions = '$product_dimensions',
                    stock_quantity = '$product_stock',
                    category_id = '$product_category',
                    brand_id = '$product_brand',
                    memory_size = '$product_memory1',
                    memory_size2 = '$product_memory2',
                    memory_size3 = '$product_memory3',
                    description = '$product_description'
                    WHERE product_id = $product_id";

    if (mysqli_query($conn, $update_query)) {
        header("Location: ../products.php"); 
        exit();
    } else {
        echo "Error updating product: " . mysqli_error($conn);
    }

    mysqli_close($conn); 
} else {
    echo "Invalid request."; 
}
?>
