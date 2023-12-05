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
                            <table class="table table-striped" id='table_product'>
                                <thead>
                                    <tr>
                                        <td>Barcode</td>
                                        <td>Product</td>
                                        <td>Category</td>
                                        <td>Description</td>
                                        <td>Stock</td>
                                        <td>Purchase Price</td>
                                        <td>Sale Price</td>
                                        <td>Image</td>
                                        <td>Action Icons</td>

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
                                        <td><image src"productimages/'.$row->image.'" class="img-rounded" width="40px" height="40px"</td>
                                        <td>
                                        <div class="btn-group">

                                        <a href="printbarcode.php?id"='.$row->pid.'" class="btn btn-primary btn-xs" role="button"><span class="fa fa-barcode" style="color:#fff" data-toggle="tooltip" title="Print Barcode"></span></a>
                                        
                                        <a href="viewproduct.php?id"='.$row->pid.'" class="btn btn-warning btn-xs" role="button"><span class="fa fa-eye" style="color:#fff" data-toggle="tooltip" title="View Product"></span></a>
                                        
                                        <a href="editproduct.php?id"='.$row->pid.'" class="btn btn-success btn-xs" role="button"><span class="fa fa-edit" style="color:#fff" data-toggle="tooltip" title="Edit Product"></span></a>
                                        
                                        <button id='.$row->pid.' class="btn btn-danger btn-xs"><span class="fa fa-trash-alt" style="color:#fff" data-toggle="tooltip" title="Delete Product"></span></button>
                                        </div>
                                        </td>
                                        </tr';
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

<script>
   $(document).ready(function (){
    $('#table_product').DataTable({
        "lengthMenu": [8, 16, 24],
        "pageLength": 8,
    });
   }) ;
</script>

<script>
   $(document).ready(function (){
       $('[data-toggle="tooltip"]').tooltip();
}) ;
</script>