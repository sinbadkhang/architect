<?php 
 	// CLASS PRODUCT
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

		// GET PRODUCTS
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
				l.id,
				t.product_id,
				t.product_name,
				t.category_id,
				t.category_name,
				t.quantity,
				t.price,
				l.version,
				l.operation
				FROM
				product_log l
				LEFT JOIN
					(
					SELECT
					c.category_name,
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
					p.id ASC
					) t
				ON t.id = l.product_id
				WHERE l.version = ('.$q.')
				ORDER BY 
				id ASC';

			// prepare statement
			$stmt = $this->conn->prepare($query);

			// execute query
			$stmt->execute();

			return $stmt;
		}

		// GET SINGLE PRODUCT
		public function read_single(){
			$query = 'SELECT 
				c.category_name,
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

		// UPDATE PRODUCT
		public function update(){
			// create query
			$query = 'UPDATE '.$this->table.'
				SET 
				product_name = :product_name,
				product_id = :product_id,
				category_id = :category_id,
				quantity = :quantity,
				price = :price
				WHERE
				id = :id';

			// prepare statement
			$stmt = $this->conn->prepare($query);

			// clean data
			$this->product_name=htmlspecialchars(strip_tags($this->product_name));
			$this->product_id=htmlspecialchars(strip_tags($this->product_id));
			$this->category_id=htmlspecialchars(strip_tags($this->category_id));
			$this->quantity=htmlspecialchars(strip_tags($this->quantity));
			$this->price=htmlspecialchars(strip_tags($this->price));
			$this->id=htmlspecialchars(strip_tags($this->id));

			// bind data
			$stmt->bindParam(':product_name', $this->product_name);
			$stmt->bindParam(':product_id', $this->product_id);
			$stmt->bindParam(':category_id', $this->category_id);
			$stmt->bindParam(':quantity', $this->quantity);
			$stmt->bindParam(':price', $this->price);
			$stmt->bindParam(':id', $this->id);

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
				product_id = :product_id,
				category_id = :category_id,
				quantity = :quantity,
				price = :price';

			// prepare statement
			$stmt = $this->conn->prepare($query);

			// clean data
			$this->product_name=htmlspecialchars(strip_tags($this->product_name));
			$this->product_id=htmlspecialchars(strip_tags($this->product_id));
			$this->category_id=htmlspecialchars(strip_tags($this->category_id));
			$this->quantity=htmlspecialchars(strip_tags($this->quantity));
			$this->price=htmlspecialchars(strip_tags($this->price));

			// bind data
			$stmt->bindParam(':product_name', $this->product_name);
			$stmt->bindParam(':product_id', $this->product_id);
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