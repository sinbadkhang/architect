<?php 
 	// CATEGORY
	class Category {
		private $conn;
		private $table = 'category';

		// PROPERTIES
		public $id;
		public $category_id;
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
				category_id
				FROM
				' . $this->table . '
				ORDER BY 
				category_name DESC';

			// prepare statement
			$stmt = $this->conn->prepare($query);

			// execute query
			$stmt->execute();

			return $stmt;
		}

		// GET SINGLE CATEGORY
		public function read_single(){
			$query = 'SELECT 
				id,
				category_name,
				category_id
				FROM
				' . $this->table . ' 
				WHERE
				id=?
				LIMIT 0,1';

			// prepare statement
			$stmt = $this->conn->prepare($query);

			// bind id
			$stmt->bindParam(1, $this->id);

			// execute query
			$stmt->execute();

			$row = $stmt->fetch(PDO::FETCH_ASSOC);

			// set properties
			$this->id = $row['id'];
			$this->category_name = $row['category_name'];
			$this->category_id = $row['category_id'];
		}

		// UPDATE CATEGORY
		public function update(){
			// create query
			$query = 'UPDATE '.$this->table.'
				SET 
				category_id = :category_id,
				category_name = :category_name 
				WHERE
				id = :id';

			// prepare statement
			$stmt = $this->conn->prepare($query);

			// clean data
			$this->category_name=htmlspecialchars(strip_tags($this->category_name));
			$this->category_id=htmlspecialchars(strip_tags($this->category_id));
			$this->id=htmlspecialchars(strip_tags($this->id));

			// bind data
			$stmt->bindParam(':category_name', $this->category_name);
			$stmt->bindParam(':category_id', $this->category_id);
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
				category_id = :category_id';

			// prepare statement
			$stmt = $this->conn->prepare($query);

			// clean data
			$this->category_name=htmlspecialchars(strip_tags($this->category_name));
			$this->category_id=htmlspecialchars(strip_tags($this->category_id));
			
			// bind data
			$stmt->bindParam(':category_name', $this->category_name);
			$stmt->bindParam(':category_id', $this->category_id);

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