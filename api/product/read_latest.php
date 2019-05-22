<?php 
	// headers
	header('Access-Control-Allow-Origin: *');
	header('Content-Type: application/json');

	include_once '../../config/Database.php';
	include_once '../../models/Product.php';

	// start db and connect
	$database = new Database();
	$db = $database->connect();

	// start product object
	$product = new Product($db);

	// product query
	$result = $product->read_latest();

	// get row count
	$num = $result->rowCount();

	// check if any product
	if($num > 0){
		// product array
		$product_arr = array();
		$product_arr['data'] = array();

		while($row = $result->fetch(PDO::FETCH_ASSOC)){
			extract($row);

			$product_item = array(
				'id'=>$id,
				'product_id'=>$product_id,
				'product_code'=>$product_code,
				'product_name'=>$product_name,
				'category_code'=>$category_code,
				'category_name'=>$category_name,
				'quantity'=>$quantity,
				'price'=>$price,
				'version'=>$version,
				'operation'=>$operation
			);

			// push to data array
			array_push($product_arr['data'], $product_item);
		}

		// into json
		echo json_encode($product_arr);
	}else{
		// no product
		echo json_encode(
			array('message' => 'No product found')
		);
	}

 ?>