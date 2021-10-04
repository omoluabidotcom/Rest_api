<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-with');

// database connection file and category model file are added below
include_once '../../config/Datab.php';
include_once '../../models/Category.php';

// database connection class is instantiated and connection to database made on it next line
$instansdb = new Datab();
$db = $instansdb->connect();

// category class is instantiated 
$instanspost = new Category($db);

// POST request variables are been grabbed 
$data = json_decode(file_get_contents("php://input"));

$instanspost->name = $data->name; 

// conditional statement calling create method to add new data/user to database
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