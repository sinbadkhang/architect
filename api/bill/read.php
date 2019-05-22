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

	// bill query
	$result = $bill->read();

	// get row count
	$num = $result->rowCount();

	// check if any bill
	if($num > 0){
		// bill array
		$bill_arr = array();
		$bill_arr['data'] = array();

		while($row = $result->fetch(PDO::FETCH_ASSOC)){
			extract($row);

			$bill_item = array(
				'id'=>$id,
				'created_date'=>$created_date,
				'bill_code'=>$bill_code,
				'bill_info'=>$bill_info,
				'customer_name'=>$customer_name,
				'cashier_name'=>$cashier_name,
				'total_price'=>$total_price,
				'total_point'=>$total_point
			);

			// push to data array
			array_push($bill_arr['data'], $bill_item);
		}

		// into json
		echo json_encode($bill_arr);
	}else{
		// no bill
		echo json_encode(
			array('message' => 'No bill found')
		);
	}

 ?>