<?php

$HOST_DB = 'dbk';
$USER_DB = 'dev';
$PASSWORD_DB = '123456';
$NAME_DB = 'prueba_konecta_db';

$conn = mysqli_connect(
    $HOST_DB,
    $USER_DB,
    $PASSWORD_DB,
    $NAME_DB
) or trigger_error("Error: " . mysqli_error($conn));

?>