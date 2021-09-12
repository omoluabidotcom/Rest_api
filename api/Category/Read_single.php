<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Datab.php';
include_once '../../models/Category.php';

$instansdb = new Datab();
$db = $instansdb->connect();

$instanspost = new Category($db);

$instanspost->id = isset($_GET['id']) ? $_GET['id'] : die();

$instanspost->read_single();

$post_arr = array(
    'id' => $instanspost->id,
    'name' => $instanspost->name
);

echo(json_encode($post_arr));

?>