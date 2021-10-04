<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-with');

// database connection file and post class file is added to the file
include_once '../../config/Datab.php';
include_once '../../models/Posts.php';

// database connection class is been instantiated and connection initiated
$instansdb = new Datab();
$db = $instansdb->connect();

$instanspost = new Post($db);

// DELETE request variables are been grabbed
$data = json_decode(file_get_contents("php://input"));

$instanspost->id = $data->id;

// conditional statement to check if deletion of data/user has been performed or not
if ($instanspost->delete()) {

    echo json_encode(
        array(
            "message" => "Post Deleted"));
} else {

    echo json_encode(
        array(
            "message" => "Post not Deleted"));
}

?>