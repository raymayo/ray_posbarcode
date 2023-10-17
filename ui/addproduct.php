<?php

include_once "connectdb.php";
session_start();

include_once "header.php";
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Add Product</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <!-- <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Starter Page</li> -->
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h5 class="m-0">Product</h5>
                        </div>
                        <form action="" method="POST">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">

                                    <div class="form-group">
                                        <label>Barcode</label>
                                        <input type="text" class="form-control" placeholder="Enter Barcode" name="barcode" required>
                                    </div>

                                    <div class="form-group">
                                        <label>Product Name</label>
                                        <input type="text" class="form-control" placeholder="Enter Product" name="product_name" required>
                                    </div>


                                    <div class="form-group">
                                        <label>Category</label>
                                        <select class="form-control" name="select_option" required>
                                            <option value="" disabled selected >Select Category</option>
                                            <option>Admin</option>
                                            <option>User</option>
                                        </select>
                                    </div>
                                    

                                    </div>
                                    <div class="col-md-6">
                                        <h1>6</h1>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
                <!-- /.col-md-6 -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<style>
    .content-wrapper {
        background-color: #151618 !important;
        color: white;
    }

    .content {
        color: #151618;
    }

    .btn-primary {
        background-color: #5C3EF4 !important;
        border: #5C3EF4 !important;
    }

    .card-outline {
        border-color: #5C3EF4 !important;
    }

    .card {
        background-color: #222325 !important;
        border-radius: 8px;
        color: white;
    }
</style>




<?php
include_once "footer.php";
?>