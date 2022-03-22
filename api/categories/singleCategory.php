<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Category.php';

    $database = new Database();
    $db = $database->connect();

    $category = new Category($db);

    $category->id = isset($_GET['id']) ? $_GET['id'] : die();
    

    $category->readSingle();
    //$quote->readAuthorId();

    $category_arr = array(
        'id' => $category->id,
        //'quote' => $quote->quote,
        'category' => $category->category
        //'category' => $quote->category_name
    );

    print_r(json_encode($category_arr));