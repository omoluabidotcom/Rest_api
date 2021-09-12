<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Datab.php';
include_once '../../models/Category.php';

$instansdb = new Datab();
$db = $instansdb->connect();

$instanscat = new Category($db);
$result = $instanscat->read();

$num = $result->rowCount();

if ($num > 0) {

    $cat_arr = array();
    $cat_arr['data'] = array();

    while ($data = $result->fetch(PDO::FETCH_ASSOC)) {

        extract($data);

        $cat_items = array(
            'id' => $id,
            'name' => $name
        );

        array_push($cat_arr['data'], $cat_items);
    }

    echo json_encode($cat_arr);
}

?>