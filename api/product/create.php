<?php

    header('Access-Control-Allow-Origin: *');
    header('Context-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization, X-Requested-With');

    include_once '../../config/Database.php';
    include_once '../../models/Product.php';

    $database = new Database();
    $db = $database->Connect();

    $product = new Product($db);

    $data = json_decode(file_get_contents("php://input"));

    $product->pro_name = $data->pro_name;
    $product->pro_price = $data->pro_price;

    if($product->create()){
        echo json_encode(array('messege' => 'New product created'));
    }else{
        echo json_encode(array('messege' => 'Product not created'));
    }