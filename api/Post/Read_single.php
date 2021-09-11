<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Datab.php';
include_once '../../models/Posts.php';

$instansdb = new Datab();
$db = $instansdb->connect();

$instanspost = new Post($db);

$instanspost->id = isset($_GET['id']) ? $_GET['id'] : die();

$instanspost->read_single();

$post_arr = array(
    'id' => $instanspost->id,
    'title' => $instanspost->title,
    'body' => $instanspost->body,
    'author' => $instanspost->author,
    'category_id' => $instanspost->category_id,
    'category_name' => $instanspost->category_name
);

print_r(json_encode($post_arr));

?>