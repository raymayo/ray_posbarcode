<?php
include_once 'connectdb.php';

$id = $_POST['pidd'];

$sql = "DELETE FROM tbl_product WHERE pid = :id";

$delete = $pdo->prepare($sql);
$delete->bindParam(':id', $id, PDO::PARAM_INT);

if ($delete->execute()) {
    $rowCount = $delete->rowCount(); // Check the number of affected rows

    if ($rowCount > 0) {
        // Deletion was successful
        echo "Product deleted successfully";
    } else {
        // No rows were affected, meaning the product with the given ID wasn't found
        echo "Product not found or already deleted";
    }
} else {
    // Error executing the query
    echo "Error deleting the product";
}
?>
