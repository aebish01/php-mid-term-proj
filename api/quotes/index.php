
<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    $method = $_SERVER['REQUEST_METHOD'];
    if ($method === 'OPTIONS') {
        header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
        header('Access-Control-Allow-Headers: Origin, Accept, Content-Type, X-Requested-With');
    }
    echo "<h1>Andrew Bish </h1>";

    if($method == 'DELETE'){
        require_once "delete.php";

    }
    elseif($method == 'POST'){
        require_once "create.php";

    }
    elseif($method == 'PUT'){
        require_once "update.php";
    }
    elseif($method == 'GET'){
        require_once "readsingle.php" || "read.php";
    }
    else{
        echo "<h1>Andrew Bish </h1>";
    }