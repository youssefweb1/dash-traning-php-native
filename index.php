<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}
include 'inc/header.php';
include 'config/db.php';
$result = mysqli_query($conn, "SELECT * FROM products");
$num_rows = mysqli_num_rows($result);

?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        
    </div>

    <!-- Content Row -->
    <div class="row">
<?php
 if ($role_admin == '1') {
   ?>
   
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-danger shadow ">
                <div class="card-body">
                    <div class="row no-gutters align-items-start">
                        <div class="col ">
                            <div class="text-xs font-weight-bold text-danger  text-uppercase mb-1">
                                Link Website</div>
                            <span style="font-size:15px" class=" mb-0 font-weight-bold text-warning text-gray-800">

                                <a class="text text-gray-800" href="http://localhost/createivo/e-commerce/" target="_blank">View The
                                    Website <i class="bi bi-caret-right-fill text-danger"></i> </a>
                            </span>
                        </div>
                        <div class="col-auto">
                            <i style="font-size:25px" class="bi bi-browser-edge text-secondary"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow ">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                products numbers</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?= $num_rows?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i style="font-size:30px" class="bi bi-eye text-secondary "></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow ">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Admin</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                1
                            </div>
                        </div>
                        <div class="col-auto">
                            <i style="font-size:30px" class="bi bi-person-workspace text-secondary"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Requests Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow ">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Number Of Orders</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?=$num_rows?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-comments fa-2x text-secondary"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php
    }elseif ($role_admin == '2') {
       ?>
       
       <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-danger shadow ">
                <div class="card-body">
                    <div class="row no-gutters align-items-start">
                        <div class="col ">
                            <div class="text-xs font-weight-bold text-danger  text-uppercase mb-1">
                                Link Website</div>
                            <span style="font-size:15px" class=" mb-0 font-weight-bold text-warning text-gray-800">

                                <a class="text text-gray-800" href="http://localhost/createivo/e-commerce/" target="_blank">View The
                                    Website <i class="bi bi-caret-right-fill text-danger"></i> </a>
                            </span>
                        </div>
                        <div class="col-auto">
                            <i style="font-size:25px" class="bi bi-browser-edge text-secondary"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow ">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                products numbers</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?= $num_rows?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i style="font-size:30px" class="bi bi-eye text-secondary "></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php
    }elseif ($role_admin == '3') {
    ?>

        <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-danger shadow ">
            <div class="card-body">
                <div class="row no-gutters align-items-start">
                    <div class="col ">
                        <div class="text-xs font-weight-bold text-danger  text-uppercase mb-1">
                            Link Website</div>
                        <span style="font-size:15px" class=" mb-0 font-weight-bold text-warning text-gray-800">

                            <a class="text text-gray-800" href="http://localhost/createivo/e-commerce/" target="_blank">View The
                                Website <i class="bi bi-caret-right-fill text-danger"></i> </a>
                        </span>
                    </div>
                    <div class="col-auto">
                        <i style="font-size:25px" class="bi bi-browser-edge text-secondary"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
    } 
    ?>

        
    </div>

</div>

<?= include 'inc/footer.php';?>