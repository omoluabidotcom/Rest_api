<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-with');

// database connection file and post class file is been added below
include_once '../../config/Datab.php';
include_once '../../models/Posts.php';

// database connection class is been instantiated and connection initiated
$instansdb = new Datab();
$db = $instansdb->connect();

// post category class instantiated
$instanspost = new Post($db);

// POST request variables are been grabbed
$data = json_decode(file_get_contents("php://input"));

$instanspost->title = $data->title;
$instanspost->body = $data->body;
$instanspost->author = $data->author;
$instanspost->category_id = $data->category_id;

// conditional statement to check if user/data was created in database
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