<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: UPDATE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-with');

// database connection file and post model class is added to file
include_once '../../config/Datab.php';
include_once '../../models/Posts.php';

// database class is instantiated and connection initiated
$instansdb = new Datab();
$db = $instansdb->connect();

// post class is instentiated
$instanspost = new Post($db);

// UPDATE request variables are been grabbed
$data = json_decode(file_get_contents("php://input"));

$instanspost->id = $data->id;

$instanspost->title = $data->title;
$instanspost->body = $data->body;
$instanspost->author = $data->author;

// conditional statement checking if update has been made to database 
if ($instanspost->update()) {

    echo json_encode(
        array(
            "message" => "Post Updated"));
} else {

    echo json_encode(
        array(
            "message" => "Post not Updated"));
}

?>