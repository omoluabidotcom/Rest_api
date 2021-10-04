<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// database class and category class file are been added
include_once '../../config/Datab.php';
include_once '../../models/Category.php';

// database connection class is been instantiated and connection to database is ade on it next line
$instansdb = new Datab();
$db = $instansdb->connect();

// category class is been instantiated
$instanspost = new Category($db);

// GET request value  id is been assigned to the category class property
$instanspost->id = isset($_GET['id']) ? $_GET['id'] : die();

// read single data method is been called to fetch single data/user from database
$instanspost->read_single();

// fetch data are assigned to an array
$post_arr = array(
    'id' => $instanspost->id,
    'name' => $instanspost->name
);

echo(json_encode($post_arr));

?>