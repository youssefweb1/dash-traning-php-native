<?php
include 'inc/header.php';
include "config/db.php";

$sql = "SELECT * FROM admin";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);


?>

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">profile</h1>

    </div>

    <!-- Content Row -->
    <form action="func/profile_update.php" method="post" class="row">
        <div class="col-12 col-md-4">
            <label for="username">Username</label>
            <input id="username" name="username" class="w-100 py-2 rounded border pl-2" type="text"
                value="<?=$row['username']?>">
        </div>

        <div class="col-12 col-md-4">
            <label for="email">Email</label>
            <input id="email" name="email" class="w-100 py-2 rounded border pl-2" type="text"
                value="<?=$row['email']?>">
        </div>

        <div class="col-12 col-md-4">
            <label for="password">Password</label>
            <input id="password" name="password" class="w-100 py-2 rounded border pl-2" type="password">
        </div>

        <button type="submit" class="btn btn-warning btn-icon-split p-2 mt-4 ml-3">
            Save changes
        </button>
</div>

<?= include 'inc/footer.php';?>