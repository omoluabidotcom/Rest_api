<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// database connection file and post model file is added
include_once '../../config/Datab.php';
include_once '../../models/Posts.php';

// instantiating database class and connection initiated
$instandb = new Datab();
$db = $instandb->connect();

// instantiating post class and read data method called
$instanpost = new Post($db);
$result = $instanpost->read();

$num = $result->rowCount();

// conditonal statement to check if data are more than zero and then fetch and pass them into an array
if ($num > 0) {

    $post_data = array();
    $post_data['data'] = array();

    while ( $data = $result->fetch(PDO::FETCH_ASSOC)) {

        extract($data);

        $post_items = array(

            'id' => $id,
            'title' => $title,
            'body' => $body,
            'author' => $author,
            'category_id' => $category_id,
            'category_name' => $category_name
        );

        array_push($post_data['data'], $post_items);

    }

    echo json_encode($post_data);


}

?>