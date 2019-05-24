<?php 
	// headers
	header('Access-Control-Allow-Origin: *');
	header('Content-Type: application/json');

	include_once '../../config/Database.php';
	include_once '../../models/Sync_log.php';

	// start db and connect
	$database = new Database();
	$db = $database->connect();

	// start sync_log object
	$sync_log = new Sync_log($db);

	// sync_log query
	$result = $sync_log->read_latest();

	// get row count
	$num = $result->rowCount();

	// check if any sync_log
	if($num > 0){
		// sync_log array
		$sync_log_arr = array();
		$sync_log_arr['data'] = array();

		while($row = $result->fetch(PDO::FETCH_ASSOC)){
			extract($row);

			$sync_log_item = array(
				'server_version'=>$server_version
			);

			// push to data array
			array_push($sync_log_arr['data'], $sync_log_item);
		}

		// into json
		echo json_encode($sync_log_arr);
	}else{
		// no sync_log
		echo json_encode(
			array('message' => 'No sync_log found')
		);
	}

 ?>