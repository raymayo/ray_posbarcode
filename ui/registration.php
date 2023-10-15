<?php

include_once "connectdb.php";
session_start();

include_once "header.php";

if(isset($_POST['btn_save'])){
    $username = $_POST['name'];
    $useremail = $_POST['email'];
    $userpassword = $_POST['password'];
    $userrole = $_POST['select_option'];

    $insert = $pdo -> prepare("insert into tbl_form (username,useremail,userpassword,role) values(:name,:email,:password,:role)");

    $insert->bindParam(':name',$username);
    $insert->bindParam(':email',$useremail);
    $insert->bindParam(':password',$userpassword);
    $insert->bindParam(':role',$userrole);

    if($insert->execute()){
        $statusMessage = "User is successfully registered.";
        $statusCode = 'success';
    }else{
        $statusMessage = "There was a problem registering the user";
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
                    <h1 class="m-0">Registration</h1>
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

            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h5 class="m-0">Registration Form</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">

                            <form action="" method="POST">
                                <div class="card-body">

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Name</label>
                                        <input type="text" class="form-control" placeholder="Enter Name" name="name">
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Email address</label>
                                        <input type="email" class="form-control" placeholder="Enter email" name="email">
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Password</label>
                                        <input type="password" class="form-control" placeholder="Password" name="password">
                                    </div>

                                    <div class="form-group">
                                        <label>Role</label>
                                        <select class="form-control" name="select_option">
                                            <option value="" disabled selected >Select Role</option>
                                            <option>Admin</option>
                                            <option>User</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary" name="btn_save">Save</button>
                                </div>
                            </form>

                        </div>
                        <div class="col-md-8">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <td>#</td>
                                        <td>Name</td>
                                        <td>Email</td>
                                        <td>Password</td>
                                        <td>Role</td>
                                        <td>Delete</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $select = $pdo -> prepare('SELECT * from tbl_form ORDER BY userid ASC');
                                    $select->execute();

                                    while($row = $select -> fetch(PDO::FETCH_OBJ)){
                                        echo'
                                        <tr>
                                        <td>'.$row->userid.'</td>
                                        <td>'.$row->username.'</td>
                                        <td>'.$row->useremail.'</td>
                                        <td>'.$row->userpassword.'</td>
                                        <td>'.$row->role.'</td>
                                        </tr>
                                        ';
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<style>
    .content-wrapper {
        background-color: #151618 !important;
        color: white;
    }

    .content {
        color: #151618;
    }

    .btn-primary {
        background-color: #5C3EF4 !important;
        border: #5C3EF4 !important;
    }

    .card-outline {
        border-color: #5C3EF4 !important;
    }

    .card {
        background-color: #222325 !important;
        border-radius: 8px;
        color: white;
    }


    .table td, .table th{
        /* background-color: #151618; */
        border-top: 1px solid #2F3237 !important;
    }
    

    tbody tr:nth-child(even) {
    background-color: #151618 !important;
    }

    tbody tr:nth-child(odd) {
    background-color: #1A1C1E !important;
    }

    thead{
    background-color: #151618 !important; 
    }

    tr{
        border-radius: 8px !important;
    }

    .swal2-popup {
        background: #222426;
        color: white;
    }
</style>

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

<?php
include_once "footer.php";
?>

