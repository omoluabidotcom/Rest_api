<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// database class and category class file are added here
include_once '../../config/Datab.php';
include_once '../../models/Category.php';

// database class is been instantiated and connection to database is been established with connect() method
$instansdb = new Datab();
$db = $instansdb->connect();

// category class is been instantiated and the read method is called on it next line
$instanscat = new Category($db);
$result = $instanscat->read();

$num = $result->rowCount();

// conditional statement check if fetch data is more than zero and fetched data are push into an array
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