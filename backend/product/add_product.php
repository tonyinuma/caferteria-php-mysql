<?php

include('../../db/connection.php');

if (isset($_POST['name'])) {

    $name = $_POST['name'];
    $reference = $_POST['reference'];
    $price = $_POST['price'];
    $weight = $_POST['weight'];
    $category_id = $_POST['category_id'];
    $stock = $_POST['stock'];

    $query = "INSERT into products(name, reference, price, weight, category_id, stock)
        VALUES ('$name', '$reference', '$price', '$weight', '$category_id', '$stock')";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        die('Query Error' . mysqli_error($conn));
    }

    echo "Product Added Successfully";
}

?>