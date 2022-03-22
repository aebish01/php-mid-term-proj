<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Author.php';

    $database = new Database();
    $db = $database->connect();

    $author = new Author($db);

    $author->id = isset($_GET['id']) ? $_GET['id'] : die();
    

    $author->readSingle();
    //$quote->readAuthorId();

    $author_arr = array(
        'id' => $author->id,
        //'quote' => $quote->quote,
        'author' => $author->author
        //'category' => $quote->category_name
    );

    print_r(json_encode($author_arr));