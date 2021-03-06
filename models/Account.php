<?php 
 	// CLASS ACCOUNT
	class Account {
		private $conn;
		private $table = 'account';

		// PROPERTIES
		public $id;
		public $username;
		public $password;
		public $type;
		public $point;

		// constructor with database
		public function __construct($db){
			$this->conn = $db;
		}

		// GET ACCOUNTS
		public function read(){
			// query
			$query = 'SELECT 
				id,
				username,
				password,
				type,
				point
				FROM
				' . $this->table . '
				ORDER BY 
				id ASC';

			// prepare statement
			$stmt = $this->conn->prepare($query);

			// execute query
			$stmt->execute();

			return $stmt;
		}

		// GET SINGLE ACCOUNT
		public function read_single(){
			$query = 'SELECT 
				id,
				username,
				password,
				type,
				point
				FROM
				' . $this->table . ' 
				WHERE
				username=?
				AND 
				password=?
				';

			// prepare statement
			$stmt = $this->conn->prepare($query);

			// bind data
			$stmt->bindParam(1, $this->username);
			$stmt->bindParam(2, $this->password);

			// execute query
			$stmt->execute();

			$row = $stmt->fetch(PDO::FETCH_ASSOC);

			// set properties
			$this->id = $row['id'];
			$this->username = $row['username'];
			$this->password = $row['password'];
			$this->type = $row['type'];
			$this->point = $row['point'];
		}

		// GET NEW ACCOUNTS SINCE THE LATEST SYNC
		public function read_latest(){
			// query
			$q = 'SELECT server_version FROM sync_log ORDER BY id DESC LIMIT 1';

			$query = 'SELECT
				a.username,
				a.password,
				a.type,
				a.point,
				l.version,
				l.operation
				FROM
				account_log l
				LEFT JOIN
				' . $this->table . ' a
				ON a.username = l.username
				WHERE l.version = ('.$q.')
				ORDER BY 
				l.id ASC';

			// prepare statement
			$stmt = $this->conn->prepare($query);

			// execute query
			$stmt->execute();

			return $stmt;
		}

		// UPDATE ACCOUNT
		public function update(){
			// create query
			$query = 'UPDATE '.$this->table.'
				SET 
				password = :password,
				username = :username,
				type = :type,
				point = :point
				WHERE
				username = :username';

			// prepare statement
			$stmt = $this->conn->prepare($query);

			// clean data
			$this->username=htmlspecialchars(strip_tags($this->username));
			$this->password=htmlspecialchars(strip_tags($this->password));
			$this->type=htmlspecialchars(strip_tags($this->type));
			$this->point=htmlspecialchars(strip_tags($this->point));

			// bind data
			$stmt->bindParam(':username', $this->username);
			$stmt->bindParam(':password', $this->password);
			$stmt->bindParam(':type', $this->type);
			$stmt->bindParam(':point', $this->point);

			// execute query
			if($stmt->execute()){
				return true;
			}

			// print error
			print('Error: %s.\n'. $stmt->error);

			return false;
		}

		// ADD ACCOUNT
		public function create(){
			// create query
			$query = 'INSERT INTO '.$this->table.'
				SET 
				username = :username,
				password = :password,
				type = :type,
				point = :point';

			// prepare statement
			$stmt = $this->conn->prepare($query);

			// clean data
			$this->username=htmlspecialchars(strip_tags($this->username));
			$this->password=htmlspecialchars(strip_tags($this->password));
			$this->type=htmlspecialchars(strip_tags($this->type));
			$this->point=htmlspecialchars(strip_tags($this->point));
			
			// bind data
			$stmt->bindParam(':username', $this->username);
			$stmt->bindParam(':password', $this->password);
			$stmt->bindParam(':type', $this->type);
			$stmt->bindParam(':point', $this->point);
			
			// execute query
			if($stmt->execute()){
				return true;
			}

			// print error
			print('Error: %s.\n'. $stmt->error);

			return false;
		}

		// DELETE ACCOUNT
		public function delete(){
			// create query
			$query = 'DELETE FROM '.$this->table.' WHERE id = :id';

			// prepare statement
			$stmt = $this->conn->prepare($query);

			// clean data
			$this->id = htmlspecialchars(strip_tags($this->id));
			
			// bind data
			$stmt->bindParam(':id', $this->id);

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