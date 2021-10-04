<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// database connection file and post class file is added below
include_once '../../config/Datab.php';
include_once '../../models/Posts.php';

// database connection is been instantiated and connection initiated
$instansdb = new Datab();
$db = $instansdb->connect();

// post class is been instantiated
$instanspost = new Post($db);

// GET request variable id is assign to a property if it is set
$instanspost->id = isset($_GET['id']) ? $_GET['id'] : die();

// read single data method is been called
$instanspost->read_single();

// fetched data are been assigned into an array
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