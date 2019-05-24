<?php 
	// headers
	header('Access-Control-Allow-Origin: *');
	header('Content-Type: application/json');
	header('Access-Control-Allow-Methods: POST');
	header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization,X-Requested-With');

	include_once '../../config/Database.php';
	include_once '../../models/Product.php';

	// start db and connect
	$database = new Database();
	$db = $database->connect();

	// start product object
	$product = new Product($db);

	// get data
	$data = json_decode(file_get_contents("php://input"));

	$product->product_name=$data->product_name;
	$product->product_code=$data->product_code;
	$product->category_id=$data->category_id;
	$product->quantity=$data->quantity;
	$product->price=$data->price;

	// create product
	if($product->create()){ 
		echo json_encode(
			array('message'=>'Product created')
		);
	} else {
		echo json_encode(
			array('message'=>'Product not created')
		);
	}
 ?>