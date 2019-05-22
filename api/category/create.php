<?php 
	// headers
	header('Access-Control-Allow-Origin: *');
	header('Content-Type: application/json');
	header('Access-Control-Allow-Methods: POST');
	header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization,X-Requested-With');

	include_once '../../config/Database.php';
	include_once '../../models/Category.php';

	// start db and connect
	$database = new Database();
	$db = $database->connect();

	// start category object
	$category = new Category($db);

	// get data
	$data = json_decode(file_get_contents("php://input"));

	$category->category_name=$data->category_name;
	$category->category_code=$data->category_code;

	// create category
	if($category->create()){ 
		echo json_encode(
			array('message'=>'Category created')
		);
	} else {
		echo json_encode(
			array('message'=>'Category not created')
		);
	}
 ?>