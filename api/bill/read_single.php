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
		'id'=>$bill->id,
		'created_date'=>$bill->created_date,
		'bill_code'=>$bill->bill_code,
		'bill_info'=>$bill->bill_info,
		'customer_name'=>$bill->customer_name,
		'cashier_name'=>$bill->cashier_name,
		'total_price'=>$bill->total_price,
		'total_point'=>$bill->total_point
	);

	// make json
	print_r(json_encode($bill_single_arr));

?>