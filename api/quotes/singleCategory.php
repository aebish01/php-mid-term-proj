<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../config/Database.php';
    include_once '../models/Quote.php';

    $database = new Database();
    $db = $database->connect();

    $quote = new Quote($db);

    $quote->id = isset($_GET['id']) ? $_GET['id'] : die();
    

    //$quote->readSingleId();
    $quote->readCategoryId();

    $quote_arr = array(
        'id' => $quote->id,
        'quote' => $quote->quote,
        'category' => $quote->category_name,
        //'category' => $quote->category_name
    );

    print_r(json_encode($quote_arr));