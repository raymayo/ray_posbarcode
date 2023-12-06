<?php
include_once "connectdb.php";
session_start();


if ($_SESSION['useremail'] == '' or $_SESSION['role'] == 'User') {
    header('location:../index.php');
}

include_once "header.php";

$id = $_GET['id'];

$select = $pdo->prepare("select * from tbl_product where pid=$id");
$select->execute();

$row = $select->fetch(PDO::FETCH_ASSOC);

$id_db = $row['pid'];

$barcode_db = $row['barcode'];
$product_db = $row['product'];
$category_db = $row['category'];
$description_db = $row['description'];
$stock_db = $row['stock'];
$purchaseprice_db = $row['purchaseprice'];
$saleprice_db = $row['saleprice'];
$image_db = $row['image'];

// print_r($row);







if (isset($_POST['btneditproduct'])) {

    $product_txt = $_POST['product_name'];
    $category_txt = $_POST['select_category'];
    $description_txt = $_POST['description'];
    $stock_txt = $_POST['numOf_Stock'];
    $purchase_Price_txt = $_POST['purchase_Price'];
    $sale_Price_txt = $_POST['sale_Price'];

    $f_name = $_FILES['product_image']['name'];

    if (!empty($f_name)) {
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
                    
                    $update = $pdo->prepare("UPDATE tbl_product SET product = :product, category = :category, description = :description, stock = :stock, purchaseprice = :pprice, saleprice = :sprice, image = :image WHERE pid = $id");

                    $update->bindParam(':product', $product_txt);
                    $update->bindParam(':category', $category_txt);
                    $update->bindParam(':description', $description_txt); // Fix variable name here
                    $update->bindParam(':stock', $stock_txt);
                    $update->bindParam(':pprice', $purchase_Price_txt);
                    $update->bindParam(':sprice', $sale_Price_txt);
                    $update->bindParam(':image', $unique_filename);

                    if ($update->execute()) {
                        $statusMessage = "Product Updated Successfully"; // Updated status message
                        $statusCode = 'success';
                    } else {
                        $statusMessage = "Product Update Unsuccessful"; // Updated status message
                        $statusCode = 'error';
                    }
                }
            }else{
                $statusMessage = "File should be less than 3MB";
                $statusCode = 'warning';
            }
        }
    }


    $_SESSION['status'] = $statusMessage;
    $_SESSION['status_code'] = $statusCode;
}


$select = $pdo->prepare("select * from tbl_product where pid=$id");
$select->execute();

$row = $select->fetch(PDO::FETCH_ASSOC);

$id_db = $row['pid'];

$barcode_db = $row['barcode'];
$product_db = $row['product'];
$category_db = $row['category'];
$description_db = $row['description'];
$stock_db = $row['stock'];
$purchaseprice_db = $row['purchaseprice'];
$saleprice_db = $row['saleprice'];
$image_db = $row['image'];



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
            <div class="row">
                <div class="col-lg-12">

                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h5 class="m-0">Edit Product</h5>
                        </div>

                        <form action="" method="post" name="formeditproduct" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <label>Barcode</label>
                                            <input type="text" class="form-control" value="<?php echo $barcode_db ?>" placeholder="Enter Barcode" name="barcode" disabled>
                                        </div>

                                        <div class="form-group">
                                            <label>Product Name</label>
                                            <input type="text" class="form-control" value="<?php echo $product_db ?>" placeholder="Enter Product" name="product_name" required>
                                        </div>


                                        <div class="form-group">
                                            <label>Category</label>
                                            <select class="form-control" value="<?php echo $category_db_db ?>" name="select_category" required>
                                                <option value="" disabled selected>Select Category</option>

                                                <?php
                                                // Prepare and execute the query
                                                $select = $pdo->prepare("SELECT category FROM tbl_category ORDER BY catid DESC");
                                                $select->execute();

                                                // Fetch the results and display them
                                                while ($row = $select->fetch(PDO::FETCH_ASSOC)) {
                                                    if ($row['category'] == $category_db) {
                                                        echo '<option selected="selected">' . htmlspecialchars($row['category']) . '</option>';
                                                    }
                                                    if ($row['category'] != $category_db)
                                                        echo '<option>' . htmlspecialchars($row['category']) . '</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label>Description</label>
                                            <textarea class="form-control" placeholder="Enter Description..." name="description" rows="8" required><?php echo $description_db ?></textarea>
                                        </div>


                                    </div>
                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <label>Stock Quantity</label>
                                            <input type="number" min="1" step="any" class="form-control" value="<?php echo $stock_db ?>" placeholder="Enter Quantity" name="numOf_Stock" required>
                                        </div>

                                        <div class="form-group">
                                            <label>Purchase Price</label>
                                            <input type="number" min="1" step="any" class="form-control" value="<?php echo $purchaseprice_db ?>" placeholder="Enter Purchase Price" name="purchase_Price" required>
                                        </div>

                                        <div class="form-group">
                                            <label>Sale Price</label>
                                            <input type="number" min="1" step="any" class="form-control" value="<?php echo $saleprice_db ?>" placeholder="Enter Sale Price" name="sale_Price" required>
                                        </div>

                                        <div class="form-group">
                                            <label>Product Image</label>
                                            <br>
                                            <image src"productimages/<?php echo $image_db ?>" class="img-rounded" width="50px" height="50px" />
                                            <input type="file" class="input-group" name="product_image">
                                            <p>Upload Product Image</p>
                                        </div>



                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="text-center p-2">
                                    <button type="submit" class="btn btn-primary" name="btneditproduct">Update Product</button>
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
        font-weight: 500;
    }


    .content-wrapper {
        background-color: #050505 !important;
        color: white;
    }

    .content {
        color: #151618;
    }

    .btn-primary {
        background-color: #7D4BDB !important;
        border: #7D4BDB !important;
        color: #050505 !important;
    }

    .card-header {
        border-bottom: 1px solid #242424 !important;
    }

    .card-outline {
        border-color: #7D4BDB !important;
        border: none !important;
    }

    .card {
        background-color: #050505 !important;
        border: 1px solid #242424 !important;
        border-radius: 8px;
        color: white;
    }

    td {
        border-bottom: 1px solid #242424 !important;
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