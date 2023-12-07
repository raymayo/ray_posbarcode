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
                    <!-- <h1 class="m-0">Product List</h1> -->
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
                            <h5 class="m-0">Product List</h5>
                        </div>
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
                                        <td>' . $row->barcode . '</td>
                                        <td>' . $row->product . '</td>
                                        <td>' . $row->category . '</td>
                                        <td>' . $row->description . '</td>
                                        <td>' . $row->stock . '</td>
                                        <td>' . $row->purchaseprice . '</td>
                                        <td>' . $row->saleprice . '</td>
                                       <td><img src="../productimage/' . $row->image . '" class="img-rounded" width="40px" height="40px"></td>
                                        <td>
                                        <div class="btn-group">

                                        <a href="printbarcode.php?id=' . $row->pid . '" class="btn btn-primary btn-s" role="button"><span class="fa fa-barcode" style="color:#fff" data-toggle="tooltip" title="Print Barcode"></span></a>
                                        
                                        <a href="viewproduct.php?id=' . $row->pid . '" class="btn btn-warning btn-s" role="button"><span class="fa fa-eye" style="color:#fff" data-toggle="tooltip" title="View Product"></span></a>
                                        
                                        <a href="editproduct.php?id=' . $row->pid . '" class="btn btn-success btn-s" role="button"><span class="fa fa-edit" style="color:#fff" data-toggle="tooltip" title="Edit Product"></span></a>
                                        
                                        <button id=' . $row->pid . ' class="btn btn-danger btn-s btndelete"><span class="fa fa-trash-alt" style="color:#fff" data-toggle="tooltip" title="Delete Product"></span></button>
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
    * {
        font-family: 'Poppins', sans-serif;
    }

    .card-header h5{
      color: #5C3EF4 !important;
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
        border-bottom: 1px solid #272C3F !important;
    }

    .card-outline {
        border-color: #5C3EF4 !important;
        border: none !important;
    }

    .card {
        background-color: #050505 !important;
        border: 1px solid #272C3F !important;
        border-radius: 8px;
        color: white;
    }

    .card-footer {
        background-color: transparent !important;
    }

    .btn-primary{
        background: none !important;
        /* border: 1px solid #5C3EF4 !important; */
        border: none !important;
    }

    .fa-barcode{
        color: #fff !important;
    }


    .btn-warning{
        background: none !important;
        /* border: 1px solid #F58D3D !important; */
        border: none !important;
    }

    .fa-eye{
        color: #F58D3D !important;
    }

    .btn-success{
        background: none !important;
        /* border: 1px solid #77DD66 !important; */
        border: none !important;
    }

    .btn-success .fa-edit{
        color: #77DD66 !important;
    }

    .btn-danger{
        background: none !important;
        /* border: 1px solid #F53D3D !important; */
        border: none !important;
    }

    .fa-trash-alt{
        color: #F53D3D !important;
    }


    .table td,
    .table th {
        /* background-color: #151618; */
        border-top: 1px solid #242424 !important;
    }


    tbody tr:nth-child(even) {
        background-color: #0D0D0D !important;
    }

    tbody tr:nth-child(odd) {
        background-color: #050505 !important;
    }

    thead {
        background-color: #0D0D0D !important;
    }

    tr {
        border-radius: 8px !important;
    }

    td {
        width: 200px !important;
    }

    /* .page-link {
        background-color: red;
    } */

    .page-item.disabled .page-link {
        background-color: #050505;
        border-color: #151618;
        border: solid 1px #242424;
    }

    .page-item.active .page-link {
        background-color: #5C3EF4;
        border-color: #5C3EF4;

    }


    .page-link {
        background-color: #151618;
        border-color: #151618;
        font-weight: 600 !important;

    }

    #table_product_previous{
        color:#5C3EF4 !important;
        font-weight: 600 !important;
    }

    .page-link:hover {
        background-color: #1E2022;
        border-color: #1E2022;
        color: #5C3EF4;
    }

    .wrapper {
        background-color: #151618;
    }

    .btn-group{
        gap: 5px;
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

<script>
    $(document).ready(function() {
        $('#table_product').DataTable({
            "lengthMenu": [8, 16, 24],
            "pageLength": 5,
            // responsive: true 
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>

<script>
    $(document).ready(function () {
        $('.btndelete').click(function () {
            var tdt = $(this);
            var id = $(this).attr('id');


            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                if (result.isConfirmed) {

                    
                    $.ajax({
                        url: 'productdelete.php',
                        type: "POST",
                        data: {
                            pidd: id
                        },
                        success: function (data) {
                            tdt.parents('tr').hide(); // Corrected variable name to tdt
                        }
                    });

                    Swal.fire({
                    title: "Deleted!",
                    text: "Product has been deleted.",
                    icon: "success"
                    });
                }
                });

        });
    });
</script>



