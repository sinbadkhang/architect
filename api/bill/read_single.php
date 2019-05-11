<?php
	// headers
	header('Access-Control-Allow-Origin: *');
	header('Content-Type: application/json');

	include_once '../../config/Database.php';
	include_once '../../models/Bill.php';

	// start db and connect
	$database = new Database();
	$db = $database->connect();

	// start bill object
	$bill = new Bill($db);

	// get id
	$bill->id = isset($_GET['id']) ? $_GET['id'] : die();

	// get bill
	$bill->read_single();

	// create array
	$bill_single_arr = array(
		'id'=>$id,
		'created_date'=>$created_date,
		'bill_id'=>$bill_id,
		'bill_info'=>$bill_info,
		'customer_name'=>$customer_name,
		'cashier_name'=>$cashier_name,
		'total_price'=>$total_price,
		'total_point'=>$total_point
	);

	// make json
	print_r(json_encode($bill_single_arr));

?>