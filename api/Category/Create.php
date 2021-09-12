<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-with');

include_once '../../config/Datab.php';
include_once '../../models/Category.php';

$instansdb = new Datab();
$db = $instansdb->connect();

$instanspost = new Category($db);

$data = json_decode(file_get_contents("php://input"));

$instanspost->name = $data->name; 

if ($instanspost->create()) {

    echo json_encode(
        array(
            "message" => "Post Created"));
} else {

    echo json_encode(
        array(
            "message" => "Post not Created"));
}

?>