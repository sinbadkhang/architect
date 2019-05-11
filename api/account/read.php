<?php 
	// headers
	header('Access-Control-Allow-Origin: *');
	header('Content-Type: application/json');

	include_once '../../config/Database.php';
	include_once '../../models/Account.php';

	// start db and connect
	$database = new Database();
	$db = $database->connect();

	// start account object
	$account = new Account($db);

	// account query
	$result = $account->read();

	// get row count
	$num = $result->rowCount();

	// check if any account
	if($num > 0){
		// account array
		$account_arr = array();
		$account_arr['data'] = array();

		while($row = $result->fetch(PDO::FETCH_ASSOC)){
			extract($row);

			$account_item = array(
				'id'=>$id,
				'username'=>$username,
				'password'=>$password,
				'type'=>$type,
				'point'=>$point,
			);

			// push to data array
			array_push($account_arr['data'], $account_item);
		}

		// into json
		echo json_encode($account_arr);
	}else{
		// no account
		echo json_encode(
			array('message' => 'No account found')
		);
	}

 ?>