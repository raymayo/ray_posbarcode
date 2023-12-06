<?php

include_once "connectdb.php";
session_start();

if ($_SESSION['useremail'] == '') {
  header('location:../index.php');
}

include_once "header.php";


if (isset($_POST['btn_save'])) {

    $category = $_POST['category'];

    if (empty($category)) {
        $statusMessage = "Category Field is Empty";
        $statusCode = 'error';
    } else {
        $insert = $pdo->prepare("insert into tbl_category (category) values(:cat)");

        $insert->bindParam(':cat', $category);

        if ($insert->execute()) {
            $statusMessage = "Category added successfully";
            $statusCode = 'success';
        } else {
            $statusMessage = "Category failed to be added";
            $statusCode = 'error';
        }
    }

    $_SESSION['status'] = $statusMessage;
    $_SESSION['status_code'] = $statusCode;
}





if (isset($_POST['btn_update'])) {

    $category = $_POST['category'];
    $id = $_POST['catid'];

    if (empty($category)) {

        $statusMessage = "Category Field is Empty";
        $statusCode = 'error';

    } else {
        $update = $pdo->prepare("update tbl_category set category = :cat where catid=".$id);

        $update->bindParam(':cat', $category);

        if ($update->execute()) {
            $statusMessage = "Category updated successfully";
            $statusCode = 'success';
        } else {
            $statusMessage = "Category failed to be updated";
            $statusCode = 'error';
        }
    }

    $_SESSION['status'] = $statusMessage;
    $_SESSION['status_code'] = $statusCode;
}


if(isset($_POST['btn_delete'])){

  $delete = $pdo -> prepare("delete from tbl_category where catid=".$_POST['btn_delete']);

  if($delete -> execute()){
    $statusMessage = "Category deleted successfully";
    $statusCode = 'success';
  }else{
    $statusMessage = "Category failed to be deleted";
    $statusCode = 'success';
  }

    $_SESSION['status'] = $statusMessage;
    $_SESSION['status_code'] = $statusCode;

}else{

}








?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Category</h1>
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
                    <h5 class="m-0">Category Form</h5>
                </div>
                <form action="" method="POST">
                <div class="card-body">
                        <div class="row">

                        <?php 
                        
                        if(isset($_POST['btn_edit'])){

                           $select = $pdo -> prepare("select * from tbl_category where catid =".$_POST['btn_edit']);
                           
                           $select -> execute();

                           if($select){

                            $row = $select -> fetch(PDO::FETCH_OBJ);

                            echo '                            <div class="col-md-4">
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Category</label>

                                    <input type="hidden" class="form-control" placeholder="Enter Category" value="' . $row->catid . '" name="catid">


                                    <input type="text" class="form-control" placeholder="Enter Category" value="' . $row->category . '" name="category">

                                </div>



                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary" name="btn_update">Update</button>
                            </div>
                        </div>';

                           }


                        }else{
                            echo '                            <div class="col-md-4">
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Category</label>
                                    <input type="text" class="form-control" placeholder="Enter Category" name="category">
                                </div>



                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary" name="btn_save">Save</button>
                            </div>
                        </div>';

                        }

                        ?>



                            

                            <div class="col-md-8">
                                <table class="table table-striped" id="table_category">
                                    <thead>
                                        <tr>
                                            <td>#</td>
                                            <td>Category</td>
                                            <td>Edit</td>
                                            <td>Delete</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $select = $pdo->prepare('SELECT * from tbl_category ORDER BY catid ASC');
                                        $select->execute();

                                        while ($row = $select->fetch(PDO::FETCH_OBJ)) {
                                            echo '
                                        <tr>
                                        <td>' . $row->catid . '</td>
                                        <td>' . $row->category . '</td>
                                        <td>
                                        <button type="submit" class="btn btn-warning" value="' . $row->catid . '" name="btn_edit"><i class="fa fa-edit"></i></button>
                                        </td>
                                        <td>
                                        <button type="submit" class="btn btn-info" value="' . $row->catid . '" name="btn_delete"><i class="fa fa-trash-alt"></i></button>
                                        </td>
                                        </tr>
                                        ';
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                     </div>
                </form>
            </div>
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

    .card-footer {
        background-color: transparent !important;
    }

    .btn-info {
        background-color: transparent;
        border-color: #F53D3D;
        ;
        color: #F53D3D;
    }

    .btn-info:hover {
        color: #151618;
        background-color: #F53D3D;
        border-color: #F53D3D;
    }

    .btn-info:active {
        color: #151618 !important;
        background-color: #F53D3D !important;
        border-color: #F53D3D !important;
    }

    .btn-info:focus {
        background-color: transparent !important;
        border-color: #F53D3D !important;
        color: #F53D3D !important;
    }

    .btn-warning {
        background-color: transparent;
        border-color: #F5AB3D;
        color: #F5AB3D;
    }

    .btn-warning:hover {
        color: #151618;
        background-color: #F5AB3D;
        border-color: #F5AB3D;
    }

    .btn-warning:active {
        filter: brightness(0.5)
    }

    .btn-warning:focus {
        background-color: transparent !important;
        border-color: #F5AB3D !important;
        color: #F5AB3D;
    }

    .table td,
    .table th {
        /* background-color: #151618; */
        border-top: 1px solid #2F3237 !important;
    }


    tbody tr:nth-child(even) {
        background-color: #151618 !important;
    }

    tbody tr:nth-child(odd) {
        background-color: #1A1C1E !important;
    }

    thead {
        background-color: #151618 !important;
    }

    tr {
        border-radius: 8px !important;
    }

    /* .page-link {
        background-color: red;
    } */

    .page-item.disabled .page-link{
        background-color: #151618;
        border-color: #151618;
    }

    .page-item.active .page-link {
        background-color: #5C3EF4; 
        border-color: #5C3EF4;

    }

    .page-link{
        background-color: #151618; 
        border-color: #151618;
        color: #5C3EF4;

    }

    .page-link:hover{
        background-color: #1E2022; 
        border-color: #1E2022;
        color: #5C3EF4;
    }

    .wrapper{
        background-color: #151618 ;
    }
    




    .swal2-popup {
        background: #222426;
        color: white;
    }

    .swal2-icon.swal2-warning {
        border-color: rgba(92, 62, 244, 0.4);
        color: #F58D3D;
    }

    .swal2-styled.swal2-confirm {
        background-color: #5C3EF4;
    }

    .swal2-icon.swal2-error [class^=swal2-x-mark-line] {
        background-color: #F53D3D;
    }

    .swal2-icon.swal2-error {
        border-color: rgba(245, 61, 61, 0.4);
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


<script>
   $(document).ready(function (){
    $('#table_category').DataTable({
        "lengthMenu": [8, 16, 24],
        "pageLength": 8,
    });
   }) ;
</script>