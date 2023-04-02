<?php

include('../../db/connection.php');

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $reference = $_POST['reference'];
    $price = $_POST['price'];
    $weight = $_POST['weight'];
    $category_id = $_POST['category_id'];
    $stock = $_POST['stock'];

    $query = "UPDATE products 
                    SET name = '$name', 
                        reference = '$reference', 
                        price = '$price', 
                        weight = '$weight',
                        category_id = '$category_id', 
                        stock = '$stock'
                    WHERE id = '$id'; ";

    $res = mysqli_query($conn, $query);

    if (!$res) {
        die('Query Failed' . mysqli_error($conn));
    }
    echo "Product Update Successfully";

}

?>