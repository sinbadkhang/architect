<?php
	// headers
	header('Access-Control-Allow-Origin: *');
	header('Content-Type: application/json');

	include_once '../../config/Database.php';
	include_once '../../models/Product.php';

	// start db and connect
	$database = new Database();
	$db = $database->connect();

	// start product object
	$product = new Product($db);

	// get id
	$product->id = isset($_GET['id']) ? $_GET['id'] : die();




?>