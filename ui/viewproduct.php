<?php

include_once "connectdb.php";
session_start();


if ($_SESSION['useremail'] == '' or $_SESSION['role'] == 'User') {
  header('location:../index.php');
}

if ($_SESSION['role'] == 'Admin') {
  include_once "header.php";
} else {
  include_once "headeruser.php";
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

    <?php
    $id = $_GET['id'];

    $select = $pdo -> prepare("select * from tbl_product where pid = $id");
    $select -> execute();

    while($row=$select->fetch((PDO::FETCH_OBJ))){
      echo'
       <div class="row">
        <div class="col-lg-12">

          <div class="card card-info card-outline">
            <div class="card-header">
              <h5 class="m-0">View Product</h5>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-md-6">

                  <ul class="list-group">

                  <center><p class="list-group-item list-group-item-info"><b>Product Details</b></p></center>
                    <li class="list-group-item"><b>Barcode</b><span class="badge badge-info float-right">'.$row->barcode.'</span></li>
                    <li class="list-group-item"><b>Product</b><span class="badge badge-warning float-right">'.$row->product.'</span></li>
                    <li class="list-group-item"><b>Category</b><span class="badge badge-info float-right">'.$row->category.'</span></li>
                    <li class="list-group-item"><b>Description</b><span class="badge badge-primary float-right">'.$row->description.'</span></li>
                    <li class="list-group-item"><b>Stock</b><span class="badge badge-danger float-right">'.$row->stock.'</span></li>
                    <li class="list-group-item"><b>Purchase Price</b><span class="badge badge-success float-right">$'.$row->purchaseprice.'</span></li>
                    <li class="list-group-item"><b>Sale Price</b><span class="badge badge-success float-right">$'.$row->saleprice.'</span></li>
                    <li class="list-group-item"><b>Product Profit</b><span class="badge badge-success float-right">$'.($row->saleprice - $row->purchaseprice).'</span></li>
                  </ul>

                </div>

                <div class="col-md-6">

                  <ul class="list-group">
                  <center><p class="list-group-item list-group-item-info"><b>Product Image</b></p></center>
                   <img src="productimages/'.$row->image.'" class="img-responsive"/></img>
                  </ul>

                </div>
              </div>

            </div>
          </div>

        </div>
        <!-- /.col-md-6 -->
      </div>
      ';
    }
    ?>

  
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<style>
  * {
    font-family: 'Poppins', sans-serif;
  }
  .content-wrapper {
    background-color: #050505 !important;
    color: white;
  }

  .card-header {
    border-bottom: 1px solid #242424 !important;
  }

  .card-outline {
    border-color: #5C3EF4 !important;
    border: none !important;
  }

  .card {
    background-color: #050505 !important;
    border: 1px solid #242424 !important;
    border-radius: 8px;
    color: white;
  }

  .list-group-item {
    background-color: #050505 !important;
    border: 1px solid #242424 !important;
    color: white;
  }

  .badge{
    font-size: 1em;
    font-weight: 500 !important;
    background-color: #050505 !important;
    border: solid 1px #242424 !important;
    color: white !important;
    border-radius: 4px !important;
    padding: .5em !important;
  }

  /* .badge-info{
    background-color: #7D4BDB !important;
    border: solid 1px #050505 !important;
    color: #050505 !important;
    border-radius: 4px !important;
  } */

    /* .badge-warning{
    background-color: #DBDB4B !important;
    border: solid 1px #050505 !important;
    color: #050505 !important;
    border-radius: 4px !important;
  } */

    .badge-success{
    color: #4BDB52 !important;
  }

    /* .badge-primary{
    background-color: #DB4B4B !important;
    border: solid 1px #050505 !important;
    color: #050505 !important;
    border-radius: 4px !important;
  } */
</style>




<?php
include_once "footer.php";
?>