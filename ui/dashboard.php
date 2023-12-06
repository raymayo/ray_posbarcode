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
          <h1 class="m-0">Admin Dashboard</h1>
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
              <h5 class="m-0">Featured</h5>
            </div>
            <div class="card-body">
              <h6 class="card-title">Special title treatment</h6>

              <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
              <a href="#" class="btn btn-primary">Go somewhere</a>
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

  * {
    font-family: 'Poppins', sans-serif;
}

 .content-wrapper {
        background-color: #151823 !important;
        color: white;
    }

    .content {
        color: #151618;
    }

    .btn-primary {
        background-color: #D6A78D !important;
        border: #D6A78D !important;
        color: #151823 !important;
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


</style>

<?php
include_once "footer.php";
?>