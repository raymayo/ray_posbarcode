<?php

try{
    $pdo = new PDO('mysql:host=localhost;dbname=ray_pos_barcode_db','root','123');
}catch(PDOException $e){
    echo $e->getMessage();
}  

// echo'connection success';

?>