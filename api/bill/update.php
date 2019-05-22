<?php 
	// headers
	header('Access-Control-Allow-Origin: *');
	header('Content-Type: application/json');
	header('Access-Control-Allow-Methods: PUT');
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

	$bill->bill_info=$data->bill_info;
	$bill->bill_code=$data->bill_code;
	$bill->customer_name=$data->customer_name;
	$bill->cashier_name=$data->cashier_name;

	$bill->total_price=$data->total_price;
	$bill->total_point=$data->total_point;

	// update bill
	if($bill->update()){ 
		echo json_encode(
			array('message'=>'Bill updated')
		);
	} else {
		echo json_encode(
			array('message'=>'Bill not updated')
		);
	}
 ?>