<?php 
 	// CLASS CATEGORY
	class Category {
		private $conn;
		private $table = 'category';

		// properties
		public $id;
		public $category_code;
		public $category_name;

		// constructor with database
		public function __construct($db){
			$this->conn = $db;
		}

		// GET CATEGORIES
		public function read(){
			// query
			$query = 'SELECT 
				id,
				category_name,
				category_code
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

		// GET NEW CATEGORIES SINCE THE LATEST SYNC
		public function read_latest(){
			// query
			$q = 'SELECT server_version FROM sync_log ORDER BY id DESC LIMIT 1';

			$query = 'SELECT 
				l.id,
				a.id as category_id,
				a.category_code,
				a.category_name,
				l.version,
				l.operation
				FROM
				category_log l
				LEFT JOIN
				' . $this->table . ' a
				ON a.id = l.category_id
				WHERE l.version = ('.$q.')
				ORDER BY 
				id ASC';

			// prepare statement
			$stmt = $this->conn->prepare($query);

			// execute query
			$stmt->execute();

			return $stmt;
		}

		// UPDATE CATEGORY
		public function update(){
			// create query
			$query = 'UPDATE '.$this->table.'
				SET 
				category_code = :category_code,
				category_name = :category_name 
				WHERE
				id = :id';

			// prepare statement
			$stmt = $this->conn->prepare($query);

			// clean data
			$this->category_name=htmlspecialchars(strip_tags($this->category_name));
			$this->category_code=htmlspecialchars(strip_tags($this->category_code));
			$this->id=htmlspecialchars(strip_tags($this->id));

			// bind data
			$stmt->bindParam(':category_name', $this->category_name);
			$stmt->bindParam(':category_code', $this->category_code);
			$stmt->bindParam(':id', $this->id);

			// execute query
			if($stmt->execute()){
				return true;
			}

			// print error
			print('Error: %s.\n'. $stmt->error);

			return false;
		}

		// ADD CATEGORY
		public function create(){
			// create query
			$query = 'INSERT INTO '.$this->table.'
				SET 
				category_name = :category_name,
				category_code = :category_code';

			// prepare statement
			$stmt = $this->conn->prepare($query);

			// clean data
			$this->category_name=htmlspecialchars(strip_tags($this->category_name));
			$this->category_code=htmlspecialchars(strip_tags($this->category_code));
			
			// bind data
			$stmt->bindParam(':category_name', $this->category_name);
			$stmt->bindParam(':category_code', $this->category_code);

			// execute query
			if($stmt->execute()){
				return true;
			}

			// print error
			print('Error: %s.\n'. $stmt->error);

			return false;
		}

		// DELETE CATEGORY
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