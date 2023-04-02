<?php

include('../../db/connection.php');

if (isset($_POST['product_id'])) {

    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];

    // Get Order Number
    $query = "SELECT order_number from orders ORDER BY id DESC LIMIT 1";
    $result_on = mysqli_query($conn, $query);
    $row = mysqli_fetch_array($result_on);
    $order_number = (int) $row['order_number'] + 1;

    if (!$result_on) {
        die('Query Error' . mysqli_error($conn));
    }

    // Get Total
    $query = "SELECT price, stock from products WHERE id = $product_id";
    $result_total = mysqli_query($conn, $query);
    $row = mysqli_fetch_array($result_total);
    $total = (double) $row['price'] * $quantity;
    $new_stock = (int) $row['stock'] - $quantity;

    if (!$result_total) {
        die('Query Error' . mysqli_error($conn));
    }

    $query = "INSERT INTO orders(order_number, product_id, quantity, total)
                VALUES ('$order_number', '$product_id', '$quantity', '$total')";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        die('Query Error' . mysqli_error($conn));
    }

    // Update Stock
    $query = "UPDATE products SET stock = '$new_stock' WHERE id = '$product_id';";
    $result_stock = mysqli_query($conn, $query);

    if (!$result_stock) {
        die('Query Error' . mysqli_error($conn));
    }

    $json_string = json_encode(["order_number" => $order_number]);
    echo $json_string;
}


?>