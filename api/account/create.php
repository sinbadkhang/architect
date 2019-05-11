<?php 
	// headers
	header('Access-Control-Allow-Origin: *');
	header('Content-Type: application/json');
	header('Access-Control-Allow-Methods: POST');
	header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization,X-Requested-With');

	include_once '../../config/Database.php';
	include_once '../../models/Account.php';

	// start db and connect
	$database = new Database();
	$db = $database->connect();

	// start account object
	$account = new Account($db);

	// get data
	$data = json_decode(file_get_contents("php://input"));

	$account->username=$data->username;
	$account->password=$data->password;
	$account->type=$data->type;
	$account->point=$data->point;

	// create account
	if($account->create()){ 
		echo json_encode(
			array('message'=>'Account created')
		);
	} else {
		echo json_encode(
			array('message'=>'Account not created')
		);
	}
 ?>