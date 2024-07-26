<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

include 'config/db.php';

$sql = "SELECT * FROM  admin  ";
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
                        <form action="func/add_user.php" method="post" enctype="multipart/form-data">
                            <div class="modal-body">
                                <!-- Product Name and Product Image side by side -->
                                <div class="row">
                                    <!-- Product Name -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="product_name"> Name:</label>
                                            <input type="text" class="form-control" id="product_name" name="username"
                                                placeholder="Enter product name" required>
                                        </div>
                                    </div>
                                    <!-- Product Image -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="product_name"> password:</label>
                                            <input type="text" class="form-control" id="product_name" name="password"
                                                placeholder="Enter product name" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <!-- Product Name -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="product_name">email:</label>
                                            <input type="text" class="form-control" id="product_name" name="email"
                                                placeholder="Enter product name" required>
                                        </div>
                                    </div>
                                    <!-- Product Image -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="role">Role:</label>
                                            <select class="form-control" id="role" name="role" required>
                                                <?php
                    $sqlrole = "SELECT * FROM roles";
                    $roles = mysqli_query($conn, $sqlrole);
                    foreach ($roles as $role) {
                        ?>

                                                <option value="<?php echo $role['id']?>"><?php echo $role['name']?>
                                                </option>

                                                <?php

                    }
                    ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="modal-footer">
                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary">Add </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <?php


            if ($role_admin == "1") {
               ?>
               <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addModal" href="#">Add New user</a>
           <?php
            }
            ?>

            <br>
            <br>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>password</th>
                            <th>email</th>
                            <th>role</th>
                            <th>date</th>

                            <th>action</th>

                        </tr>
                    </thead>

                    <tbody>
                        <?php

                        foreach ($result_pro as $pro) {
                            ?>

                        <tr>
                            <td><?= $pro['username'] ?></td>

                            <td><?= $pro['password'] ?></td>
                            <td><?= $pro['email'] ?></td>

                            <td>
                                <?php
                                    $role_id = $pro['role_id'];
                                    $brand = "SELECT * FROM roles WHERE id = $role_id";
                                    $brand_result = mysqli_query($conn, $brand);
                                    $brand_row = mysqli_fetch_assoc($brand_result);
                                    echo $brand_row['name'];

                                    ?>

                            </td>
                            <td><?=$pro['created_at']?></td>

                            <td>

                            <?php
if ($role_admin == 1) {
    ?>
    <a class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editmodal<?= $pro['id']; ?>" href="#">Edit</a>

    <div class="modal fade" id="editmodal<?= $pro['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

                                <!-- Edit Modal -->
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Edit Product</h5>
                                                <button class="close" type="button" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="func/update_user.php" method="post">
                                                <input type="hidden" name="user_id" value="<?= $pro['id']; ?>">
                                                <!-- حقل مخفي لنقل معرف المستخدم -->
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="username">اسم المستخدم:</label>
                                                            <input type="text" class="form-control" id="username"
                                                                name="username" placeholder="Enter username" required
                                                                value="<?= $pro['username'] ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="password">كلمة المرور:</label>
                                                            <input type="password" class="form-control" id="password"
                                                                name="password" placeholder="Enter password" required
                                                                value="<?= $pro['password'] ?>">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="email">البريد الإلكتروني:</label>
                                                            <input type="email" class="form-control" id="email"
                                                                name="email" placeholder="Enter email" required
                                                                value="<?= $pro['email'] ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="role">الدور:</label>
                                                            <select class="form-control" id="role" name="role" required>
                                                                <?php
                    $sqlrole = "SELECT * FROM roles";
                    $roles = mysqli_query($conn, $sqlrole);
                    foreach ($roles as $role) {
                        $selected = ($role['id'] == $pro['role_id']) ? 'selected' : '';
                        echo '<option value="' . $role['id'] . '" ' . $selected . '>' . $role['name'] . '</option>';
                    }
                    ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="modal-footer">
                                                    <button class="btn btn-secondary" type="button"
                                                        data-dismiss="modal">إلغاء</button>
                                                    <button type="submit" class="btn btn-primary">تحديث</button>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
</div>

    <a href="func/deleteuser.php?id=<?= $pro['id']; ?>" class="btn btn-danger btn-sm">Delete</a>
<?php } elseif ($role_admin == 2) {
    // Role 2 can edit users with roles 2 and 3 only
    if ($pro['role_id'] == 2 || $pro['role_id'] == 3) {
        ?>
        <a class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editmodal<?= $pro['id']; ?>" href="#">Edit</a>

        <!-- Edit Modal -->
        <div class="modal fade" id="editmodal<?= $pro['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
         
                                <!-- Edit Modal -->
                                <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Edit Product</h5>
                                                <button class="close" type="button" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="func/update_user.php" method="post">
                                                <input type="hidden" name="user_id" value="<?= $pro['id']; ?>">
                                                <!-- حقل مخفي لنقل معرف المستخدم -->
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="username">اسم المستخدم:</label>
                                                            <input type="text" class="form-control" id="username"
                                                                name="username" placeholder="Enter username" required
                                                                value="<?= $pro['username'] ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="password">كلمة المرور:</label>
                                                            <input type="password" class="form-control" id="password"
                                                                name="password" placeholder="Enter password" required
                                                                value="<?= $pro['password'] ?>">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="email">البريد الإلكتروني:</label>
                                                            <input type="email" class="form-control" id="email"
                                                                name="email" placeholder="Enter email" required
                                                                value="<?= $pro['email'] ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="role">الدور:</label>
                                                            <select class="form-control" id="role" name="role" required>
                                                                <?php
                    $sqlrole = "SELECT * FROM roles";
                    $roles = mysqli_query($conn, $sqlrole);
                    foreach ($roles as $role) {
                        $selected = ($role['id'] == $pro['role_id']) ? 'selected' : '';
                        echo '<option value="' . $role['id'] . '" ' . $selected . '>' . $role['name'] . '</option>';
                    }
                    ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="modal-footer">
                                                    <button class="btn btn-secondary" type="button"
                                                        data-dismiss="modal">إلغاء</button>
                                                    <button type="submit" class="btn btn-primary">تحديث</button>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
        </div>

        <a href="func/deleteuser.php?id=<?= $pro['id']; ?>" class="btn btn-danger btn-sm">Delete</a>
    <?php }
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