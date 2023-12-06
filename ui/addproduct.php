<?php

include_once "connectdb.php";
session_start();

include_once "header.php";




if (isset($_POST['btn_save'])) {

    $barcode = $_POST['barcode'];
    $product = $_POST['product_name'];
    $category = $_POST['select_category'];
    $description = $_POST['description'];
    $stock = $_POST['numOf_Stock'];
    $purchase_Price = $_POST['purchase_Price'];
    $sale_Price = $_POST['sale_Price'];



    $f_name = $_FILES['product_image']['name'];
    $f_tmp = $_FILES['product_image']['tmp_name'];
    $f_extension = strtolower(pathinfo($f_name, PATHINFO_EXTENSION));
    $f_size = $_FILES['product_image']['size'];

    // Define allowed file extensions and maximum file size
    $allowed_extensions = ['jpg', 'png', 'jpeg'];
    $max_file_size = 3500000; // 3MB

    if (in_array($f_extension, $allowed_extensions)) {
        if ($f_size <= $max_file_size) {
            $unique_filename = uniqid() . '_' . $f_name;
            $store = "../productimage/" . $unique_filename;

            if (move_uploaded_file($f_tmp, $store)) {
                $productimage = $unique_filename;

                if (empty($barcode)) {

                    $insert = $pdo->prepare("INSERT INTO tbl_product (product, category, description, stock, purchaseprice, saleprice, image) VALUES (:product, :category, :description, :stock, :pprice, :saleprice, :img)");


                    // $insert->bindParam(':barcode', $barcode);

                    $insert->bindParam(':product', $product);
                    $insert->bindParam(':category', $category);
                    $insert->bindParam(':description', $description);
                    $insert->bindParam(':stock', $stock);
                    $insert->bindParam(':pprice', $purchase_Price);
                    $insert->bindParam(':saleprice', $sale_Price);
                    $insert->bindParam(':img', $productimage);

                    $insert->execute();

                    $pid = $pdo -> lastInsertId();

                    date_default_timezone_set("Asia/Manila");
                    $newbarcode = $pid.date('his');

                    $update = $pdo -> prepare("update tbl_product set barcode='$newbarcode' where pid='".$pid."'");

                    if($update->execute()){

                        $statusMessage = "Product uploaded successfully";
                        $statusCode = 'success';
                    }else{

                        $statusMessage = "Product failed to upload";
                        $statusCode = 'error';
                    }


                } else {
                    $insert = $pdo->prepare("INSERT INTO tbl_product (barcode, product, category, description, stock, purchaseprice, saleprice, image) VALUES (:barcode, :product, :category, :description, :stock, :pprice, :saleprice, :img)");

                    $insert->bindParam(':barcode', $barcode);
                    $insert->bindParam(':product', $product);
                    $insert->bindParam(':category', $category);
                    $insert->bindParam(':description', $description);
                    $insert->bindParam(':stock', $stock);
                    $insert->bindParam(':pprice', $purchase_Price);
                    $insert->bindParam(':saleprice', $sale_Price);
                    $insert->bindParam(':img', $productimage);

                    if ($insert->execute()) {
                        $statusMessage = "Product uploaded successfully";
                        $statusCode = 'success';
                    } else {
                        $statusMessage = "Product failed to upload";
                        $statusCode = 'error';
                    }
                }
            } else {
                $statusMessage = "Failed to upload image";
                $statusCode = 'error';
            }
        } else {
            $statusMessage = "File should be less than 3MB";
            $statusCode = 'warning';
        }
    } else {
        $statusMessage = "Only upload png, jpg, jpeg files";
        $statusCode = 'warning';
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
                    <h1 class="m-0">Add Product</h1>
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
                            <h5 class="m-0">Product</h5>
                        </div>
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <label>Barcode</label>
                                            <input type="text" class="form-control" placeholder="Enter Barcode" name="barcode">
                                        </div>

                                        <div class="form-group">
                                            <label>Product Name</label>
                                            <input type="text" class="form-control" placeholder="Enter Product" name="product_name" required>
                                        </div>


                                        <div class="form-group">
                                            <label>Category</label>
                                            <select class="form-control" name="select_category" required>
                                                <option value="" disabled selected>Select Category</option>

                                                <?php
                                                // Prepare and execute the query
                                                $select = $pdo->prepare("SELECT category FROM tbl_category ORDER BY catid DESC");
                                                $select->execute();

                                                // Fetch the results and display them
                                                while ($row = $select->fetch(PDO::FETCH_ASSOC)) {
                                                    echo '<option>' . htmlspecialchars($row['category']) . '</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label>Description</label>
                                            <textarea class="form-control" placeholder="Enter Description..." name="description" rows="8" required></textarea>
                                        </div>


                                    </div>
                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <label>Stock Quantity</label>
                                            <input type="number" min="1" step="any" class="form-control" placeholder="Enter Quantity" name="numOf_Stock" required>
                                        </div>

                                        <div class="form-group">
                                            <label>Purchase Price</label>
                                            <input type="number" min="1" step="any" class="form-control" placeholder="Enter Purchase Price" name="purchase_Price" required>
                                        </div>

                                        <div class="form-group">
                                            <label>Sale Price</label>
                                            <input type="number" min="1" step="any" class="form-control" placeholder="Enter Sale Price" name="sale_Price" required>
                                        </div>

                                        <div class="form-group">
                                            <label>Product Image</label>
                                            <input type="file" class="input-group" name="product_image" required>
                                            <p>Upload Product Image</p>
                                        </div>



                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="text-center p-2">
                                    <button type="submit" class="btn btn-primary" name="btn_save">Save Product</button>
                                </div>
                            </div>
                        </form>
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

    .card-footer {
        background-color: transparent !important;
    }

    .swal2-styled.swal2-confirm {
        background-color: #5C3EF4;
    }

    .swal2-icon.swal2-warning {
        border-color: rgba(92, 62, 244, 0.4);
        color: #F58D3D;
    }

    .swal2-icon.swal2-error [class^=swal2-x-mark-line] {
        background-color: #F53D3D;
    }

    .swal2-icon.swal2-error {
        border-color: rgba(245, 61, 61, 0.4);
    }

    .card-header {
        border-color: #38393B !important;
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