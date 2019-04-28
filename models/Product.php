<?php 
 	// post = product
	class Product {
		private $conn;
		private $table = 'product';

		// propertiess
		public $id;
		public $product_id;
		public $product_name;
		public $category_id;
		public $category_name;
		public $quantity;
		public $price;

		// constructor with database
		public function __construct($db){
			$this->conn = $db;
		}

		// get products
		public function read(){
			// query
			$query = 'SELECT 
				c.category_name as category_name,
				p.id,
				p.category_id,
				p.product_id,
				p.product_name,
				p.quantity,
				p.price
				FROM
				' . $this->table . ' p
				LEFT JOIN 
				category c ON p.category_id = c.category_id
				ORDER BY 
				c.category_name DESC';

			// prepare statement
			$stmt = $this->conn->prepare($query);

			// execute query
			$stmt->execute();

			return $stmt;
		}

		// get single product
		public function read_single(){
			$query = 'SELECT 
				c.category_name as category_name,
				p.id,
				p.category_id,
				p.product_id,
				p.product_name,
				p.quantity,
				p.price
				FROM
				' . $this->table . ' p
				LEFT JOIN 
				category c ON p.category_id = c.category_id
				WHERE
				p.id=?
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
			$this->product_name = $row['product_name'];
			$this->quantity = $row['quantity'];
			$this->price = $row['price'];
		}
	}

 ?>