<?php

include_once "connectdb.php";
session_start();

if ($_SESSION['useremail'] == '') {
  header('location:../index.php');
}

if ($_SESSION['role'] == 'Admin') {
  include_once "header.php";
} else {
  include_once "headeruser.php";
}



if (isset($_POST['btn_update'])) {
  $oldPassword = $_POST['txt_oldpassword'];
  $newPassword = $_POST['txt_newpassword'];
  $rnewPassword = $_POST['txt_rnewpassword'];



  $email = $_SESSION['useremail'];
  $select = $pdo->prepare("select * from tbl_form where useremail='$email'");


  $select->execute();
  $row = $select->fetch(PDO::FETCH_ASSOC);

  $useremail = $row['useremail'];
  $userpassword = $row['userpassword'];
  $username = $row['username'];



  if ($row['userpassword'] === $oldPassword) {
    if ($newPassword === $rnewPassword) {
      $update = $pdo->prepare("UPDATE tbl_form SET userpassword = :pass WHERE useremail = :email");
      $update->bindParam(':pass', $rnewPassword);
      $update->bindParam(':email', $email);

      if ($update->execute()) {
        $statusMessage = "Password updated.";
        $statusCode = 'success';
      } else {
        $statusMessage = "Password update failed.";
        $statusCode = 'error';
      }
    } else {
      $statusMessage = "New passwords don't match.";
      $statusCode = 'error';
    }
  } else {
    $statusMessage = "Incorrect current password.";
    $statusCode = 'error';
  }

  $_SESSION['status'] = $statusMessage;
  $_SESSION['status_code'] = $statusCode;
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


<style>
    .content-wrapper{
    background-color: #151618 !important; 
    color: white;
  }

.card{
    background-color: #222325 !important;
    border-radius: 8px;
    color: white;
}

.card-header{
    background-color: #5C3EF4 !important;
    /* border-radius: 8px;
    color: white; */
}

.card-footer{
    background-color: transparent !important;
}

.btn-info{
    background-color: #5C3EF4 !important;
    border: #5C3EF4 !important;
}

.swal2-popup {
        background: #222426;
        color: white;
    }

    .swal2-styled.swal2-confirm{
    background-color: #5C3EF4;
}

.swal2-icon.swal2-warning{
    border-color: rgba(92,62,244,0.4);
    color: #F58D3D;
    }


.swal2-icon.swal2-error [class^=swal2-x-mark-line]{
    background-color: #F53D3D;
}

.swal2-icon.swal2-error{
    border-color: rgba(245,61,61,0.4);
}

</style>




<?php
include_once "footer.php";
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