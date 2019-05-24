<?php 
	// headers
	header('Access-Control-Allow-Origin: *');
	header('Content-Type: application/json');
	header('Access-Control-Allow-Methods: POST');
	header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization,X-Requested-With');

	include_once '../../config/Database.php';
	include_once '../../models/Sync_log.php';

	// start db and connect
	$database = new Database();
	$db = $database->connect();

	// start sync_log object
	$sync_log = new Sync_log($db);

	// get data
	$data = json_decode(file_get_contents("php://input"));
	
	$sync_log->server_version=$data->server_version;

	// create sync_log
	if($sync_log->create()){ 
		echo json_encode(
			array('message'=>'Sync_log created')
		);
	} else {
		echo json_encode(
			array('message'=>'Sync_log not created')
		);
	}
 ?>