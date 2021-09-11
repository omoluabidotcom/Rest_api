<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-with');

include_once '../../config/Datab.php';
include_once '../../models/Posts.php';

$instansdb = new Datab();
$db = $instansdb->connect();

$instanspost = new Post($db);

$data = json_decode(file_get_contents("php://input"));

$instanspost->title = $data->title;
$instanspost->body = $data->body;
$instanspost->author = $data->author;
$instanspost->category_id = $data->category_id;

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