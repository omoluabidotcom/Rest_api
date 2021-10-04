<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: UPDATE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-with');

// the database connection class and category class are added below
include_once '../../config/Datab.php';
include_once '../../models/Category.php';

// database connection class is been instantiated and the cpnnectio initiated
$instansdb = new Datab();
$db = $instansdb->connect();

// category class is ben instantiated
$instanspost = new Category($db);

// UPDATE request variables are been grabbed 
$data = json_decode(file_get_contents("php://input"));

$instanspost->id = $data->id;
$instanspost->name = $data->name;

// conditional statement is used to check if updated method is been called and data are updated to database
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