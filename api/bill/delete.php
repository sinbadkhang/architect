<?php 
	// headers
	header('Access-Control-Allow-Origin: *');
	header('Content-Type: application/json');
	header('Access-Control-Allow-Methods: DELETE');
	header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization,X-Requested-With');

	include_once '../../config/Database.php';
	include_once '../../models/Bill.php';

	// start db and connect
	$database = new Database();
	$db = $database->connect();

	// start bill object
	$bill = new Bill($db);

	// get data
	$data = json_decode(file_get_contents("php://input"));

	// set id to update
	$bill->id=$data->id;

	// delete bill
	if($bill->delete()){ 
		echo json_encode(
			array('message'=>'Bill deleted')
		);
	} else {
		echo json_encode(
			array('message'=>'Bill not deleted')
		);
	}
 ?>