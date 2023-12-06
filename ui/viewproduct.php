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
          <h1 class="m-0">Blank Dashboard</h1>
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

                  <center><p class="list-group-item list-group-item-info"><b>PRODUCT DETAILS</b></p></center>
                    <li class="list-group-item">Barcode<span class="badge badge-info float-right">'.$row->pid.'</span></li>
                    <li class="list-group-item">Product<span class="badge badge-warning float-right">'.$row->product.'</span></li>
                    <li class="list-group-item">Category<span class="badge badge-success float-right">'.$row->category.'</span></li>
                    <li class="list-group-item">Description<span class="badge badge-primary float-right">'.$row->description.'</span></li>
                    <li class="list-group-item">Stock<span class="badge badge-danger float-right">'.$row->stock.'</span></li>
                    <li class="list-group-item">Purchase Price<span class="badge badge-secondary float-right">'.$row->purchaseprice.'</span></li>
                    <li class="list-group-item">Sale Price<span class="badge badge-dark float-right">'.$row->saleprice.'</span></li>
                  </ul>

                </div>

                <div class="col-md-6">

                  <ul class="list-group">
                  <center><p class="list-group-item list-group-item-info"><b>PRODUCT IMAGE</b></p></center>
                    <li class="list-group-item">New <span class="badge">12</span></li>
                    <li class="list-group-item">Deleted <span class="badge">5</span></li>
                    <li class="list-group-item">Warnings <span class="badge">3</span></li>
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

  .content {
    color: #151618;
  }

  .btn-primary {
    background-color: #5C3EF4 !important;
    border: #5C3EF4 !important;
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
</style>




<?php
include_once "footer.php";
?>