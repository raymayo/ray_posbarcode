<?php

include_once "connectdb.php";
session_start();

if ($_SESSION['useremail'] == '') {
    header('location:../index.php');
}


include_once "header.php";
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
                            <h5 class="m-0">Generate Barcode</h5>
                        </div>
                        <div class="card-body">




                            <div class="row">
                                <div class="col-lg-12">

                                    <div class="card card-info card-outline">
                                        <div class="card-header">
                                            <h5 class="m-0">View Product</h5>
                                        </div>
                                        <div class="card-body">
                                            <form class="form-horizontal" method="post" action="barcode.php" target="_blank">

                                                <?php 
                                                $id=$_GET['id'];
                                                $select=$pdo->prepare("select * from tbl_product where pid =$id");
                                                $select->execute();
                                                
                                                while($row=$select->fetch(PDO::FETCH_OBJ)){
                                                   
                                                    echo'
                                                    
                                                    <div class="row">
                                                    <div class="col-md-6">

                                                        <ul class="list-group">
                                                            <center>
                                                                <p class="list-group-item list-group-item-info"><b>Print Barcode</b></p>
                                                            </center>
                                                            <div class="form-group">
                                                                <label class="control-label col-sm-2" for="product">Product:</label>
                                                                <div class="col-sm-10">
                                                                    <input autocomplete="OFF" type="text" class="form-control" id="product" name="product">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-sm-2" for="product_id">Product ID:</label>
                                                                <div class="col-sm-10">
                                                                    <input autocomplete="OFF" type="text" class="form-control" id="product_id" name="product_id">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-sm-2" for="rate">Rate</label>
                                                                <div class="col-sm-10">
                                                                    <input autocomplete="OFF" type="text" class="form-control" id="rate" name="rate">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-sm-2" for="print_qty">Barcode Quantity</label>
                                                                <div class="col-sm-10">
                                                                    <input autocomplete="OFF" type="print_qty" class="form-control" id="print_qty" name="print_qty">
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <div class="col-sm-offset-2 col-sm-10">
                                                                    <button type="submit" class="btn btn-default">Submit</button>
                                                                </div>
                                                            </div>
                                                        </ul>

                                                    </div>

                                                    <div class="col-md-6">

                                                        <ul class="list-group">
                                                            <center>
                                                                <p class="list-group-item list-group-item-info"><b>Product Image</b></p>
                                                            </center>
                                                            <img src="../productimage/'.$row->image.'" class="img-responsive" /></img>

                                                        </ul>

                                                    </div>
                                                </div>
                                                    
                                                    
                                                    
                                                    
                                                    
                                                    ';

                                                }
                                                
                                                ?>
                                            </form>

                                        </div>
                                    </div>

                                </div>
                                <!-- /.col-md-6 -->
                            </div>
        


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
        background-color: #050505 !important;
        color: white;
    }

    .content {
        color: #151618;
    }

    .btn-primary {
        background-color: #7D4BDB !important;
        border: #7D4BDB !important;
        color: #050505;
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