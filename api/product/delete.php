<?php 
	// headers
	header('Access-Control-Allow-Origin: *');
	header('Content-Type: application/json');
	header('Access-Control-Allow-Methods: DELETE');
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
	$product->product_code=$data->product_code;

	// delete product
	if($product->delete()){ 
		echo json_encode(
			array('message'=>'Product deleted')
		);
	} else {
		echo json_encode(
			array('message'=>'Product not deleted')
		);
	}
 ?>