<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

include 'config/db.php';

$sql = "SELECT * FROM  products  ";
$result_pro = mysqli_query($conn, $sql);


include 'inc/header.php'

    ?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Products</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <?php
if ($role_admin == "1" || $role_admin == "2") {
    ?>
            <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addModal" href="#">Add New Product</a>
            <?php
                                }?>

            <!-- Add Product Modal -->
            <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <!-- Adjust modal size if needed -->
                    <div class="modal-content">
                        <div class="modal-header">

                            <h5 class="modal-title" id="exampleModalLabel">Add Product</h5>

                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="func/add_product.php" method="post" enctype="multipart/form-data">
                            <div class="modal-body">
                                <!-- Product Name and Product Image side by side -->
                                <div class="row">
                                    <!-- Product Name -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="product_name">Product Name:</label>
                                            <input type="text" class="form-control" id="product_name"
                                                name="product_name" placeholder="Enter product name" required>
                                        </div>
                                    </div>
                                    <!-- Product Image -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="product_image">Product Image:</label>
                                            <input type="file" id="image" name="image[]" multiple>

                                        </div>
                                    </div>
                                </div>

                                <!-- Product Price and Product Dimensions side by side -->
                                <div class="row">
                                    <!-- Product Price -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="product_price">Product Price:</label>
                                            <input type="text" class="form-control" id="product_price"
                                                name="product_price" placeholder="Enter product price" required>
                                        </div>
                                    </div>
                                    <!-- Product Dimensions -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="product_dimensions">Product Dimensions:</label>
                                            <input type="text" class="form-control" id="product_dimensions"
                                                name="product_dimensions" placeholder="Enter product dimensions"
                                                required>
                                        </div>
                                    </div>
                                </div>

                                <!-- Product Stock, Category, and Brand side by side -->
                                <div class="row">
                                    <!-- Product Stock -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="product_stock">Product Stock:</label>
                                            <input type="text" class="form-control" id="product_stock"
                                                name="product_stock" placeholder="Enter product stock" required>
                                        </div>
                                    </div>
                                    <!-- Product Category -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="product_category">Product Category:</label>
                                            <select class="form-control" id="product_category" name="product_category"
                                                required>
                                                <?php
                    $sqlcat = "SELECT * FROM categories";
                    $categories = mysqli_query($conn, $sqlcat);
                    foreach ($categories as $category) {
                        echo '<option value="' . $category['category_id'] . '">' . $category['category_name'] . '</option>';
                    }
                    ?>
                                            </select>
                                        </div>
                                    </div>
                                    <!-- Product Brand -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="product_brand">Product Brand:</label>
                                            <select class="form-control" id="product_brand" name="product_brand"
                                                required>
                                                <?php
                    $sqlbrands = "SELECT * FROM brands";
                    $brands = mysqli_query($conn, $sqlbrands);
                    foreach ($brands as $brand) {
                        echo '<option value="' . $brand['brand_id'] . '">' . $brand['brand_name'] . '</option>';
                    }
                    ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <!-- Product Memories -->
                                <div class="row">
                                    <!-- Product Memory 1 -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="product_memory1">Product Memory 1:</label>
                                            <input type="text" class="form-control" id="product_memory1"
                                                name="product_memory1" placeholder="Enter product memory 1">
                                        </div>
                                    </div>
                                    <!-- Product Memory 2 -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="product_memory2">Product Memory 2:</label>
                                            <input type="text" class="form-control" id="product_memory2"
                                                name="product_memory2" placeholder="Enter product memory 2">
                                        </div>
                                    </div>
                                    <!-- Product Memory 3 -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="product_memory3">Product Memory 3:</label>
                                            <input type="text" class="form-control" id="product_memory3"
                                                name="product_memory3" placeholder="Enter product memory 3">
                                        </div>
                                    </div>
                                </div>

                                <!-- Product Description -->
                                <div class="form-group">
                                    <label for="product_description">Product Description:</label>
                                    <textarea class="form-control" id="product_description" name="product_description"
                                        rows="3" placeholder="Enter product description"></textarea>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary">Add Product</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <br>
            <br>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>image</th>
                            <th>price</th>
                            <th>stock</th>
                            <th>description</th>
                            <th>brand</th>
                            <th>category</th>
                            <th>action</th>

                        </tr>
                    </thead>

                    <tbody>
                        <?php

                        foreach ($result_pro as $pro) {
                            ?>

                        <tr>
                            <td><?= $pro['product_name'] ?></td>
                            <td width="200px">
    <?php
            $images = explode(",", $pro['image']);
            foreach ($images as $image) {
                ?>

                <img src="../admin/uploads/<?=$image?>" alt="" srcset="" width="20px">

<?php
            }
    ?>
</td>

                            <td><?= $pro['price'] ?>$</td>
                            <td><?= $pro['stock_quantity'] ?></td>
                            <td><?= substr($pro['description'], 0, 30) ?> ..eg</td>

                            <td>
                                <?php
                                    $brand_id = $pro['brand_id'];
                                    $brand = "SELECT * FROM brands WHERE brand_id = $brand_id";
                                    $brand_result = mysqli_query($conn, $brand);
                                    $brand_row = mysqli_fetch_assoc($brand_result);
                                    echo $brand_row['brand_name'];

                                    ?>

                            </td>
                            <td> <?php
                                $category_id = $pro['category_id'];
                                $category = "SELECT * FROM categories WHERE category_id = $category_id";
                                $category_result = mysqli_query($conn, $category);
                                $category_row = mysqli_fetch_assoc($category_result);
                                echo $category_row['category_name'];

                                ?></td>
                            <td>

                                <?php
if ($role_admin == "1" || $role_admin == "2") {
    ?>

                                <a class="btn btn-warning btn-sm" data-toggle="modal"
                                    data-target="#editmodal<?= $pro['product_id']; ?>" href="#">Edit</a>
                                <?php
                                }
                                ?>

                                <!-- edit Modal -->
                                <div class="modal fade" id="editmodal<?= $pro['product_id']; ?>" tabindex="-1"
                                    role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <!-- Adjust modal size if needed -->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Edit Product</h5>
                                                <button class="close" type="button" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="func/update_product.php?id=<?= $pro['product_id']; ?>"
                                                method="post" enctype="multipart/form-data">
                                                <div class="modal-body">
                                                    <!-- Product Name and Product Image side by side -->
                                                    <div class="row">
                                                        <!-- Product Name -->
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="product_name">Product Name:</label>
                                                                <input type="text" class="form-control"
                                                                    id="product_name" name="product_name"
                                                                    value="<?= $pro['product_name']; ?>">
                                                            </div>
                                                        </div>
                                                        <!-- Product Image -->
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="product_image">Product Image:</label>
                                                                <div class="custom-file">
                                                                    <input type="file" class="custom-file-input"
                                                                        id="image" name="image[]" multiple>
                                                                    <label class="custom-file-label" for="image">Choose
                                                                        file</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Product Price and Product Dimensions side by side -->
                                                    <div class="row">
                                                        <!-- Product Price -->
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="product_price">Product Price:</label>
                                                                <input type="text" class="form-control"
                                                                    id="product_price" name="product_price"
                                                                    value="<?= $pro['price']; ?>">
                                                            </div>
                                                        </div>
                                                        <!-- Product Dimensions -->
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="product_dimensions">Product
                                                                    Dimensions:</label>
                                                                <input type="text" class="form-control"
                                                                    id="product_dimensions" name="product_dimensions"
                                                                    value="<?= $pro['dimensions']; ?>">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Product Stock, Category, and Brand side by side -->
                                                    <div class="row">
                                                        <!-- Product Stock -->
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="product_stock">Product Stock:</label>
                                                                <input type="text" class="form-control"
                                                                    id="product_stock" name="product_stock"
                                                                    value="<?= $pro['stock_quantity']; ?>">
                                                            </div>
                                                        </div>
                                                        <!-- Product Category -->
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="product_category">Product Category:</label>
                                                                <select class="form-control" id="product_category"
                                                                    name="product_category">
                                                                    <?php
                                    $sqlcat = "SELECT * FROM categories";
                                    $categories = mysqli_query($conn, $sqlcat);
                                    foreach ($categories as $category) {
                                        echo '<option value="' . $category['category_id'] . '"';
                                        if ($category['category_id'] == $category_row['category_id']) {
                                            echo ' selected';
                                        }
                                        echo '>' . $category['category_name'] . '</option>';
                                    }
                                    ?>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <!-- Product Brand -->
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="product_brand">Product Brand:</label>
                                                                <select class="form-control" id="product_brand"
                                                                    name="product_brand">
                                                                    <?php
                                    $sqlbrands = "SELECT * FROM brands";
                                    $brands = mysqli_query($conn, $sqlbrands);
                                    foreach ($brands as $brand) {
                                        echo '<option value="' . $brand['brand_id'] . '"';
                                        if ($brand['brand_id'] == $brand_row['brand_id']) {
                                            echo ' selected';
                                        }
                                        echo '>' . $brand['brand_name'] . '</option>';
                                    }
                                    ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Product Memories -->
                                                    <div class="row">
                                                        <!-- Product Memory 1 -->
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="product_memory1">Product Memory 1:</label>
                                                                <input type="text" class="form-control"
                                                                    id="product_memory1" name="product_memory1"
                                                                    value="<?= $pro['memory_size']; ?>">
                                                            </div>
                                                        </div>
                                                        <!-- Product Memory 2 -->
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="product_memory2">Product Memory 2:</label>
                                                                <input type="text" class="form-control"
                                                                    id="product_memory2" name="product_memory2"
                                                                    value="<?= $pro['memory_size2']; ?>">
                                                            </div>
                                                        </div>
                                                        <!-- Product Memory 3 -->
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="product_memory3">Product Memory 3:</label>
                                                                <input type="text" class="form-control"
                                                                    id="product_memory3" name="product_memory3"
                                                                    value="<?= $pro['memory_size3']; ?>">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Product Description -->
                                                    <div class="form-group">
                                                        <label for="product_description">Product Description:</label>
                                                        <textarea class="form-control" id="product_description"
                                                            name="product_description"
                                                            rows="3"><?= $pro['description']; ?></textarea>
                                                    </div>
                                                </div>

                                                <div class="modal-footer">
                                                    <button class="btn btn-secondary" type="button"
                                                        data-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <?php
if ($role_admin == "1") {
    ?>
                                <a href="func/deletepro.php?id=<?=$pro['product_id'];?>"
                                    class="btn btn-danger btn-sm">Delete</a>
                                <?php
} 


?>

                            </td>
                        </tr>

                        <?php
                        }
                        ?>

                    </tbody>
                </table>

            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

<?= include 'inc/footer.php' ?>