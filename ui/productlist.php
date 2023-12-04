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
                    <h1 class="m-0">Product List</h1>
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
                        <div class="card-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <td>Barcode</td>
                                        <td>Product</td>
                                        <td>Category</td>
                                        <td>Description</td>
                                        <td>Stock</td>
                                        <td>PurchasePrice</td>
                                        <td>SalePrice</td>
                                        <td>Image</td>
                                        <td>Print Barcode</td>
                                        <td>View</td>
                                        <td>Edit</td>
                                        <td>Delete</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $select = $pdo->prepare('SELECT * from tbl_product ORDER BY pid ASC');
                                    $select->execute();

                                    while ($row = $select->fetch(PDO::FETCH_OBJ)) {
                                        echo '
                                        <tr>
                                        <td>' .$row->barcode.'</td>
                                        <td>' .$row->product.'</td>
                                        <td>' .$row->category.'</td>
                                        <td>' .$row->description.'</td>
                                        <td>' .$row->stock. '</td>
                                        <td>' .$row->purchaseprice.'</td>
                                        <td>' .$row->saleprice.'</td>
                                        <td>' .$row->image.'</td>

                                        <td>
                                        <a href="registration.php?id=' . $row->pid . '" class="btn btn-danger"><i class="fa fa-trash-alt"></i></a>
                                        </td>

                                        <td>
                                        <a href="registration.php?id=' . $row->pid . '" class="btn btn-danger"><i class="fa fa-trash-alt"></i></a>
                                        </td>

                                        <td>
                                        <a href="registration.php?id=' . $row->pid . '" class="btn btn-danger"><i class="fa fa-trash-alt"></i></a>
                                        </td>

                                        <td>
                                        <a href="registration.php?id=' . $row->pid . '" class="btn btn-danger"><i class="fa fa-trash-alt"></i></a>
                                        </td>
                                        </tr
                                        ';
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
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
        background-color: #151823 !important;
        color: white;
    }

    .content {
        color: #151618;
    }

    .btn-primary {
        background-color: #5C3EF4 !important;
        border: #5C3EF4 !important;
    }

    .card-header{
        border-bottom: 1px solid #272C3F !important;
    }

    .card-outline {
        border-color: #5C3EF4 !important;
        border: none !important;
    }

    .card {
        background-color: #151823 !important;
        border: 1px solid #272C3F !important;
        border-radius: 8px;
        color: white;
    }

    td{
        border-bottom:1px solid #272C3F !important;
    }
</style>




<?php
include_once "footer.php";
?>