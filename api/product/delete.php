<?php

    header('Access-Control-Allow-Origin: *');
    header('Context-Type: application/json');
    header('Access-Control-Allow-Methods: DELETE');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization, X-Requested-With');

    include_once '../../config/Database.php';
    include_once '../../models/Product.php';

    $database = new Database();
    $db = $database->Connect();

    $product = new Product($db);

   // $data = json_decode(file_get_contents("php://input"));

    $product->pro_id = isset($_GET['id']) ? $_GET['id'] : die();

    if($product->delete()){
        echo json_encode(array('messege' => 'Product deleted'));
    }else{
        echo json_encode(array('messege' => 'Product not deleted'));
    }