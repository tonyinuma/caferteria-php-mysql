<?php

include('../../db/connection.php');

$searchValue = $_POST['searchValue'];
$query_find = $searchValue ? " WHERE name LIKE '%$searchValue%'" : "";

$query = "SELECT * from products $query_find";
$result = mysqli_query($conn, $query);

if (!$result) {
    die('Query Failed' . mysqli_error($conn));
}

$json = array();
while ($row = mysqli_fetch_array($result)) {
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
$json_string = json_encode($json);
echo $json_string;

?>