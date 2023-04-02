<?php

include('../../db/connection.php');

$sql = "SELECT o.*, p.name from orders o
        INNER JOIN products p on o.product_id = p.id
        ORDER BY id DESC";

$result = mysqli_query($conn, $sql);

if (!$result) {
    die('Query Failed' . mysqli_error($conn));
}

$json = array();
while ($row = mysqli_fetch_array($result)) {
    $json[] = array(
        'id' => $row['id'],
        'order_number' => $row['order_number'],
        'name' => $row['name'],
        'quantity' => $row['quantity'],
        'total' => $row['total']
    );
}
$json_string = json_encode($json);
echo $json_string;

?>