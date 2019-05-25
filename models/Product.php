<?php 
 	// CLASS PRODUCT
	class Product {
		private $conn;
		private $table = 'product';

		// propertiess
		public $id;
		public $product_code;
		public $product_name;
		public $category_id;
		public $category_code;
		public $category_name;
		public $quantity;
		public $price;

		// constructor with database
		public function __construct($db){
			$this->conn = $db;
		}

		// GET PRODUCTS
		public function read(){
			// query
			$query = 'SELECT 
				c.category_name,
				c.category_code,
				p.category_id,
				p.id,
				p.product_code,
				p.product_name,
				p.quantity,
				p.price
				FROM
				' . $this->table . ' p
				LEFT JOIN 
				category c ON p.category_id = c.id
				ORDER BY 
				p.id ASC';

			// prepare statement
			$stmt = $this->conn->prepare($query);

			// execute query
			$stmt->execute();

			return $stmt;
		}

		// GET NEW PRODUCTS SINCE THE LATEST SYNC
		public function read_latest(){
			// query
			$q = 'SELECT server_version FROM sync_log ORDER BY id DESC LIMIT 1';

			$query = 'SELECT
				t.product_code,
				t.product_name,
				t.category_id,
				t.quantity,
				t.price,
				l.version,
				l.operation
				FROM
				product_log l
				LEFT JOIN
					(
					SELECT 
					p.id,
					p.category_id,
					p.product_code,
					p.product_name,
					p.quantity,
					p.price
					FROM
					' . $this->table . ' p
					LEFT JOIN 
					category c ON p.category_id = c.id
					ORDER BY 
					p.id ASC
					) t
				ON t.product_code = l.product_code
				WHERE l.version = ('.$q.')
				ORDER BY 
				l.id ASC';

			// prepare statement
			$stmt = $this->conn->prepare($query);

			// execute query
			$stmt->execute();

			return $stmt;
		}

		// UPDATE PRODUCT
		public function update(){
			// create query
			$query = 'UPDATE '.$this->table.'
				SET 
				product_name = :product_name,
				category_id = :category_id,
				quantity = :quantity,
				price = :price
				WHERE
				product_code = :product_code';

			// prepare statement
			$stmt = $this->conn->prepare($query);

			// clean data
			$this->product_name=htmlspecialchars(strip_tags($this->product_name));
			$this->product_code=htmlspecialchars(strip_tags($this->product_code));
			$this->category_id=htmlspecialchars(strip_tags($this->category_id));
			$this->quantity=htmlspecialchars(strip_tags($this->quantity));
			$this->price=htmlspecialchars(strip_tags($this->price));

			// bind data
			$stmt->bindParam(':product_name', $this->product_name);
			$stmt->bindParam(':product_code', $this->product_code);
			$stmt->bindParam(':category_id', $this->category_id);
			$stmt->bindParam(':quantity', $this->quantity);
			$stmt->bindParam(':price', $this->price);

			// execute query
			if($stmt->execute()){
				return true;
			}

			// print error
			print('Error: %s.\n'. $stmt->error);

			return false;
		}

		// ADD PRODUCT
		public function create(){
			// create query
			$query = 'INSERT INTO '.$this->table.'
				SET 
				product_name = :product_name,
				product_code = :product_code,
				category_id = :category_id,
				quantity = :quantity,
				price = :price';

			// prepare statement
			$stmt = $this->conn->prepare($query);

			// clean data
			$this->product_name=htmlspecialchars(strip_tags($this->product_name));
			$this->product_code=htmlspecialchars(strip_tags($this->product_code));
			$this->category_id=htmlspecialchars(strip_tags($this->category_id));
			$this->quantity=htmlspecialchars(strip_tags($this->quantity));
			$this->price=htmlspecialchars(strip_tags($this->price));

			// bind data
			$stmt->bindParam(':product_name', $this->product_name);
			$stmt->bindParam(':product_code', $this->product_code);
			$stmt->bindParam(':category_id', $this->category_id);
			$stmt->bindParam(':quantity', $this->quantity);
			$stmt->bindParam(':price', $this->price);


			// execute query
			if($stmt->execute()){
				return true;
			}

			// print error
			print('Error: %s.\n'. $stmt->error);

			return false;
		}

		// DELETE PRODUCT
		public function delete(){
			// create query
			$query = 'DELETE FROM '.$this->table.' WHERE product_code = :product_code';

			// prepare statement
			$stmt = $this->conn->prepare($query);

			// clean data
			$this->product_code = htmlspecialchars(strip_tags($this->product_code));
			
			// bind data
			$stmt->bindParam(':product_code', $this->product_code);

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