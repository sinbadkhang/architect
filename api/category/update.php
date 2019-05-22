<?php 
	// headers
	header('Access-Control-Allow-Origin: *');
	header('Content-Type: application/json');
	header('Access-Control-Allow-Methods: PUT');
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

	// set id to update
	$category->id=$data->id;
	
	$category->category_code=$data->category_code;
	$category->category_name=$data->category_name;

	// update category
	if($category->update()){ 
		echo json_encode(
			array('message'=>'Category updated')
		);
	} else {
		echo json_encode(
			array('message'=>'Category not updated')
		);
	}
 ?>