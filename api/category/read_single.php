<?php
	// headers
	header('Access-Control-Allow-Origin: *');
	header('Content-Type: application/json');

	include_once '../../config/Database.php';
	include_once '../../models/Category.php';

	// start db and connect
	$database = new Database();
	$db = $database->connect();

	// start category object
	$category = new Category($db);

	// get id
	$category->id = isset($_GET['id']) ? $_GET['id'] : die();

	// get category
	$category->read_single();

	// create array
	$category_single_arr = array(
		'id'=>$category->id,
		'category_name'=>$category->category_name,
		'category_code'=>$category->category_code
	);

	// make json
	print_r(json_encode($category_single_arr));

?>