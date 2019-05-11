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

	// category query
	$result = $category->read();

	// get row count
	$num = $result->rowCount();

	// check if any category
	if($num > 0){
		// category array
		$category_arr = array();
		$category_arr['data'] = array();

		while($row = $result->fetch(PDO::FETCH_ASSOC)){
			extract($row);

			$category_item = array(
				'id'=>$id,
				'category_id'=>$category_id,
				'category_name'=>$category_name
			);

			// push to data array
			array_push($category_arr['data'], $category_item);
		}

		// into json
		echo json_encode($category_arr);
	}else{
		// no category
		echo json_encode(
			array('message' => 'No category found')
		);
	}

 ?>