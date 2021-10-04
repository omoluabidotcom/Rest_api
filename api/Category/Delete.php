<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-with');

// database connection and category class file are been added below
include_once '../../config/Datab.php';
include_once '../../models/Category.php';

// database connection class is been instantiated and database connection method is called
$instansdb = new Datab();
$db = $instansdb->connect();

// category class is been instantiated
$instanspost = new Category($db);

// DELETE request variables is been grabbed
$data = json_decode(file_get_contents("php://input"));

$instanspost->id = $data->id;

// conditional statement calling deleted method to delete data/user from database
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