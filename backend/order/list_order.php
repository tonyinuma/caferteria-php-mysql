<?php

include('../../db/connection.php');

$query = "SELECT * from orders";
$result = mysqli_query($conn, $query);

if (!$result) {
    die('Query Failed' . mysqli_error($conn));
}

$json = array();
while ($row = mysqli_fetch_array($result)) {
    $json[] = array(
        'id' => $row['id'],
        'order_number' => $row['order_number'],
        'product_id' => $row['product_id'],
        'quantity' => $row['quantity'],
        'total' => $row['total']
    );
}
$json_string = json_encode($json);
echo $json_string;

?>