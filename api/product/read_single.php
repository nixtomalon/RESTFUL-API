<?php

    header('Access-Control-Allow-Origin: *');
    header('Context-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Product.php';

    $database = new Database();
    $db = $database->Connect();

    $product = new Product($db);

    $result = $product->read_single();

    $product->pro_id = isset($_GET['id']) ? $_GET['id'] : die();

    $product->read_single();

    $product_arr = array(
        'id' => $product->pro_id,
        'name' => $product->pro_name,
        'price' => $product->pro_price
    );

    echo json_encode($product_arr);

