<?php 
	class Database {
		// parameters
		private $host = '127.0.0.1:3307';
		private $dbname = 'branch_1';
		private $username = 'root';
		private $password = '';
		private $conn;

		public function connect()
		{
			$this->conn = null;

			try {
				$this->conn = new PDO('mysql:host='.$this->host.';
					dbname='.$this->dbname, $this->username, $this->password);
				$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO:: ERRMODE_EXCEPTION);
			} catch(PDOException $e){
				echo 'Connection error: ' . $e->getMessage();
			}

			return $this->conn;
		}
	}
?>