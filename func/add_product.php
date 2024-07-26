<?php
include '../config/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

    $images = [];
    if (!empty($_FILES['image']['name'][0])) {
        $total_files = count($_FILES['image']['name']);
        for ($i = 0; $i < $total_files; $i++) {
            $image_name = $_FILES['image']['name'][$i];
            $image_tmp = $_FILES['image']['tmp_name'][$i];
            $upload_dir = "../uploads/";
            move_uploaded_file($image_tmp, $upload_dir . $image_name);
            $images[] = $image_name;
        }
    } else {
        $images = []; 
    }

    $image_string = implode(",", $images);

    $insert_query = "INSERT INTO products (product_name, price, dimensions, stock_quantity, category_id, brand_id, image, memory_size, memory_size2, memory_size3, description)
                    VALUES ('$product_name', '$product_price', '$product_dimensions', '$product_stock', '$product_category', '$product_brand', '$image_string', '$product_memory1', '$product_memory2', '$product_memory3', '$product_description')";

    if (mysqli_query($conn, $insert_query)) {
        $product_id = mysqli_insert_id($conn);

        echo "<h2>Uploaded Images:</h2>";
        foreach ($images as $image_name) {
            echo "<img src='../uploads/$image_name' alt='$image_name' style='max-width: 200px;'><br>";
        }

        echo "<p>Product ID: $product_id</p>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    mysqli_close($conn);
} else {
    echo "Invalid request.";
}
?>
