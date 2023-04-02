<?php

include('../../db/connection.php');

if (isset($_POST['product_id'])) {
    $id = $_POST['productuid'];
    $query = "DELETE FROM products WHERE id = $id";
    $res = mysqli_query($conn, $query);

    if (!$res) {
        die('Query Failed' . mysqli_error($conn));
    }
    echo "Product Deleted Successfully";

}

?>