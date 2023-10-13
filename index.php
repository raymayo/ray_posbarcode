<?php

include_once "ui/connectdb.php";

session_start();

if (isset($_POST['btn_login'])) {

  $useremail = $_POST['txt_email'];
  $password = $_POST['txt_password'];


  $select = $pdo->prepare("select * from tbl_form where useremail='$useremail' AND userpassword='$password'");
  $select->execute();

  $row = $select->fetch(PDO::FETCH_ASSOC);

  if (is_array($row) && $row['useremail'] == $useremail && $row['userpassword'] == $password) {

    $username = $row['username'];

    $_SESSION['userid'] = $row['userid'];
    $_SESSION['username'] = $row['username'];
    $_SESSION['useremail'] = $row['useremail'];
    $_SESSION['role'] = $row['role'];

    if ($row['role'] == "Admin") {

        $_SESSION['status'] = "Login Success, Welcome $username!";
        $_SESSION['status_code'] = 'success';

        header('refresh: 1; ui/dashboard.php');

    } elseif ($row['role'] == "User") {

        $_SESSION['status'] = "Login Success, Welcome $username!";
        $_SESSION['status_code'] = 'success';
        
        header('refresh: 1; ui/user.php');
    }
} else {
    $_SESSION['status'] = "Wrong Email or Password";
    $_SESSION['status_code'] = 'error';
}

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Log in moko</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">

  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="plugins/toastr/toastr.min.css">

  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <link rel="stylesheet" href="./style.css">k
</head>

<body class="hold-transition login-page">
  <div class="login-box">
    <!-- /.login-logo -->
    <div class="card card-outline card-primary">
      <div class="card-header text-center">
        <a href="./index2.html" class="h1"><b>POS</b>BARCODE</a>
      </div>
      <div class="card-body">
        <p class="login-box-msg">Sign in to start your session</p>

        <form action="" method="post">
          <div class="input-group mb-3">

            <input type="email" class="form-control" placeholder="Email" name='txt_email' required>

            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">

            <input type="password" class="form-control" placeholder="Password" name="txt_password" required>

            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-8">
              <div class="icheck-primary">
                <a href="forgot-password.html">I forgot my password</a>
              </div>
            </div>
            <!-- /.col -->
            <div class="col-4">
              <button type="submit" class="btn btn-primary btn-block" name="btn_login">Login</button>
            </div>
            <!-- /.col -->
          </div>
        </form>

        <!-- /.social-auth-links -->

        <p class="mb-1">

        </p>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
  <!-- /.login-box -->

  <!-- jQuery -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- SweetAlert2 -->
  <script src="plugins/sweetalert2/sweetalert2.min.js"></script>
  <!-- Toastr -->
  <script src="plugins/toastr/toastr.min.js"></script>

  <!-- AdminLTE App -->
  <script src="./dist/js/adminlte.min.js"></script>

  <style>

    .swal2-popup.swal2-toast{
      background-color: #222325 !important;
    }

    .swal2-title{
      color: #ebebeb !important;
    }

    /* .swal2-icon.swal2-error{
      border-color: #000 !important;
    }

    .swal2-icon.swal2-error{
      color: #000 !important;
    } */
  </style>
  
</body>

</html>


<?php
if (isset($_SESSION['status']) && $_SESSION['status'] !== '') {
    $icon = $_SESSION['status_code'];
    $message = $_SESSION['status'];

    // Output JavaScript directly with values from PHP variables
    echo <<<HTML
    <script>
        $(function() {
            var Toast = Swal.mixin({
                toast: true,
                position: 'top',
                showConfirmButton: false,
                timer: 40000
            });

            Toast.fire({
                icon: '{$icon}',
                title: '{$message}'
            });
        });
    </script>
HTML;

    unset($_SESSION['status']);
}
?>