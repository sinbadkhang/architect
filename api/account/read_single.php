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

	// get id
	$account->id = isset($_GET['id']) ? $_GET['id'] : die();

	// get account
	$account->read_single();

	// create array
	$account_single_arr = array(
		'id'=>$account->id,
		'username'=>$account->username,
		'password'=>$account->password,
		'type'=>$account->type,
		'point'=>$account->point,
	);

	// make json
	print_r(json_encode($account_single_arr));

?>