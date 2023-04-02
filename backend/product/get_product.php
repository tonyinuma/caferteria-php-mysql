<?php

include('../../db/connection.php');

if (isset($_POST['product_id'])) {
    $id = $_POST['product_id'];

    $query = "SELECT * from products WHERE id  = {$id}";

    $res = mysqli_query($conn, $query);
    if (!$res) {
        die('Query Failed' . mysqli_error($conn));
    }

    $json = array();
    while ($row = mysqli_fetch_array($res)) {
        $json[] = array(
            'id' => $row['id'],
            'name' => $row['name'],
            'reference' => $row['reference'],
            'price' => $row['price'],
            'weight' => $row['weight'],
            'category_id' => $row['category_id'],
            'stock' => $row['stock'],
        );
    }

    $json_string = json_encode($json[0]);
    echo $json_string;
}

?>