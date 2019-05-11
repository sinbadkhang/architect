<?php 
	// headers
	header('Access-Control-Allow-Origin: *');
	header('Content-Type: application/json');
	header('Access-Control-Allow-Methods: DELETE');
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

	// set id to update
	$account->id=$data->id;

	// delete account
	if($account->delete()){ 
		echo json_encode(
			array('message'=>'Account deleted')
		);
	} else {
		echo json_encode(
			array('message'=>'Account not deleted')
		);
	}
 ?>