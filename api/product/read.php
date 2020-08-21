<?php

    header('Access-Control-Allow-Origin: *');
    header('Context-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Product.php';

    $database = new Database();
    $db = $database->Connect();

    $product = new Product($db);

    $result = $product->read();

    if($result->rowCount() > 0){

        $product_arr = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            extract($row);

            $product_item = array(
                'id' => $pro_id,
                'name' => $pro_name,
                'price' => $pro_price
            );

            array_push($product_arr, $product_item);

        }
        echo json_encode($product_arr);

    }else{
        echo json_encode(
            array('messege' => 'No products found')
        );
    }
