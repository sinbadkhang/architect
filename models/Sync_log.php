<?php 
 	// CLASS CATEGORY
	class Sync_log {
		private $conn;
		private $table = 'sync_log';

		// properties
		public $server_version;
		public $id;

		// constructor with database
		public function __construct($db){
			$this->conn = $db;
		}

		// GET LATEST VERSION
		public function read_latest(){
			// query
			$query = 'SELECT 
				id,
				server_version 
				FROM
				' . $this->table . '
				ORDER BY 
				id DESC 
				LIMIT 1';

			// prepare statement
			$stmt = $this->conn->prepare($query);

			// execute query
			$stmt->execute();

			return $stmt;
		}

		// ADD VERSION
		public function create(){
			// create query
			$query = 'INSERT INTO '.$this->table.'
				SET 
				server_version = :server_version';

			// prepare statement
			$stmt = $this->conn->prepare($query);

			// clean data
			$this->server_version=htmlspecialchars(strip_tags($this->server_version));
			
			// bind data
			$stmt->bindParam(':server_version', $this->server_version);

			// execute query
			if($stmt->execute()){
				return true;
			}

			// print error
			print('Error: %s.\n'. $stmt->error);

			return false;
		}
	}
 ?>