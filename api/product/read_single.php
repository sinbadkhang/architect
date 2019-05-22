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

	// get id
	$product->id = isset($_GET['id']) ? $_GET['id'] : die();

	// get product
	$product->read_single();

	// create array
	$product_single_arr = array(
		'id'=>$product->id,
		'product_code'=>$product->product_code,
		'product_name'=>$product->product_name,
		'category_name'=>$product->category_name,
		'category_code'=>$product->category_code,
		'quantity'=>$product->quantity,
		'price'=>$product->price
	);

	// make json
	print_r(json_encode($product_single_arr));

?>