<?php 
	// headers
	header('Access-Control-Allow-Origin: *');
	header('Content-Type: application/json');
	header('Access-Control-Allow-Methods: PUT');
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

	// set id to update
	$product->id=$data->id;

	$product->product_name=$data->product_name;
	$product->product_id=$data->product_id;
	$product->category_id=$data->category_id;
	$product->quantity=$data->quantity;
	$product->price=$data->price;

	// update product
	if($product->update()){ 
		echo json_encode(
			array('message'=>'Product updated')
		);
	} else {
		echo json_encode(
			array('message'=>'Product not updated')
		);
	}
 ?>