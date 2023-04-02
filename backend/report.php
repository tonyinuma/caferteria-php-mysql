<?php

include('../db/connection.php');

$query = "SELECT name, stock from products ORDER BY stock DESC LIMIT 1";
$result_full = mysqli_query($conn, $query);

if (!$result_full) {
    die('Query Failed' . mysqli_error($conn));
}

$json = array();
while ($row = mysqli_fetch_array($result_full)) {
    $json['full'] = array(
        'name' => $row['name'],
        'stock' => $row['stock'],
    );
}

$sql = "SELECT product_id , SUM(quantity) AS sells, p.name 
        FROM orders o 
        INNER JOIN products p on p.id = o.product_id 
        GROUP BY product_id
        ORDER BY sells DESC
        LIMIT 1;";

$result_top = mysqli_query($conn, $sql);

if (!$result_top) {
    die('Query Failed' . mysqli_error($conn));
}

while ($row = mysqli_fetch_array($result_top)) {
    $json['top'] = array(
        'name' => $row['name'],
        'sells' => $row['sells'],
    );
}

$json_string = json_encode($json);
echo $json_string;

?>