<?php 

include_once "connectdb.php";
session_start();

include_once"header.php";

if(isset($_POST['btn_update'])){
  $oldPassword = $_POST['txt_oldpassword'];
  $newPassword = $_POST['txt_newpassword'];
  $rnewPassword = $_POST['txt_rnewpassword'];

  // echo "$oldPassword - $newPassword - $rnewPassword";

  $email = $_SESSION['useremail'];
  $select = $pdo -> prepare("select * from tbl_form where useremail='$email'");


  $select ->execute();
  $row = $select-> fetch(PDO:: FETCH_ASSOC);

  // echo $row['useremail'];
 $username = $row['username'];

  $_SESSION['status'] = "$username! Your password was successfully changed!";
  $_SESSION['status_code'] = 'success';
}

?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Change Password</h1>
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

                        <!-- Horizontal Form -->
                        <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Change Password</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form class="form-horizontal" action="" method="post">
                <div class="card-body">
                  
                  <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Old Password</label>
                    <div class="col-sm-10">
                      <input type="password" class="form-control" id="inputPassword3" placeholder="Old Password" name="txt_oldpassword">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">New Password</label>
                    <div class="col-sm-10">
                      <input type="password" class="form-control" id="inputPassword3" placeholder="New Password" name="txt_newpassword">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Confirm Password</label>
                    <div class="col-sm-10">
                      <input type="password" class="form-control" id="inputPassword3" placeholder="Confirm Password" name="txt_rnewpassword">
                    </div>
                  </div>
                  
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-info" name="btn_update">Update Password</button>
                </div>
                <!-- /.card-footer -->
              </form>
            </div>
            <!-- /.card -->
              
          </div>
          <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->




<?php 
include_once"footer.php";
?>

<?php
if (isset($_SESSION['status']) && $_SESSION['status'] !== '') {
    $icon = $_SESSION['status_code'];
    $message = $_SESSION['status'];

    // Output JavaScript directly with values from PHP variables
    echo <<<HTML
    <script>
            Swal.fire({
                icon: '{$icon}',
                title: '{$message}'
            });
    </script>
HTML;

    unset($_SESSION['status']);
}
?>