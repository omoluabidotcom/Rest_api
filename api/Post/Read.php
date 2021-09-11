<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Datab.php';
include_once '../../models/Posts.php';

// instantiating database class
$instandb = new Datab();
$db = $instandb->connect();

// instantiating post class
$instanpost = new Post($db);
$result = $instanpost->read();

$num = $result->rowCount();

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