<?php
include_once "connectdb.php";
session_start();


if ($_SESSION['useremail'] == '' or $_SESSION['role'] == 'User') {
    header('location:../index.php');
}

include_once "header.php";

$id = $_GET['id'];

$select = $pdo->prepare("select * from tbl_product where pid=$id");
$select -> execute();

$row=$select->fetch(PDO::FETCH_ASSOC);

$id_db = $row['pid'];



?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
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
                            <h5 class="m-0">Edit Product</h5>
                        </div>

                        <form action="" method="post" name="formeditproduct" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <label>Barcode</label>
                                            <input type="text" class="form-control" placeholder="Enter Barcode" name="barcode">
                                        </div>

                                        <div class="form-group">
                                            <label>Product Name</label>
                                            <input type="text" class="form-control" placeholder="Enter Product" name="product_name" required>
                                        </div>


                                        <div class="form-group">
                                            <label>Category</label>
                                            <select class="form-control" name="select_category" required>
                                                <option value="" disabled selected>Select Category</option>

                                                <?php
                                                // Prepare and execute the query
                                                $select = $pdo->prepare("SELECT category FROM tbl_category ORDER BY catid DESC");
                                                $select->execute();

                                                // Fetch the results and display them
                                                while ($row = $select->fetch(PDO::FETCH_ASSOC)) {
                                                    echo '<option>' . htmlspecialchars($row['category']) . '</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label>Description</label>
                                            <textarea class="form-control" placeholder="Enter Description..." name="description" rows="8" required></textarea>
                                        </div>


                                    </div>
                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <label>Stock Quantity</label>
                                            <input type="number" min="1" step="any" class="form-control" placeholder="Enter Quantity" name="numOf_Stock" required>
                                        </div>

                                        <div class="form-group">
                                            <label>Purchase Price</label>
                                            <input type="number" min="1" step="any" class="form-control" placeholder="Enter Purchase Price" name="purchase_Price" required>
                                        </div>

                                        <div class="form-group">
                                            <label>Sale Price</label>
                                            <input type="number" min="1" step="any" class="form-control" placeholder="Enter Sale Price" name="sale_Price" required>
                                        </div>

                                        <div class="form-group">
                                            <label>Product Image</label>
                                            <input type="file" class="input-group" name="product_image" required>
                                            <p>Upload Product Image</p>
                                        </div>



                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="text-center p-2">
                                    <button type="submit" class="btn btn-primary" name="btneditproduct">Edit Product</button>
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
    * {
        font-family: 'Poppins', sans-serif;
        font-weight: 500;
    }


    .content-wrapper {
        background-color: #050505 !important;
        color: white;
    }

    .content {
        color: #151618;
    }

    .btn-primary {
        background-color: #7D4BDB !important;
        border: #7D4BDB !important;
        color: #050505 !important;
    }

    .card-header {
        border-bottom: 1px solid #242424 !important;
    }

    .card-outline {
        border-color: #7D4BDB !important;
        border: none !important;
    }

    .card {
        background-color: #050505 !important;
        border: 1px solid #242424 !important;
        border-radius: 8px;
        color: white;
    }

    td {
        border-bottom: 1px solid #242424 !important;
    }
</style>




<?php
include_once "footer.php";
?>