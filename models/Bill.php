<?php 
 	// post = bill
	class Bill {
		private $conn;
		private $table = 'bill';

		// propertiess
		public $id;
		public $created_date;
		public $bill_id;
		public $bill_info;
		
		public $total_price;
		public $total_point;
		public $customer_name;
		public $cashier_name;

		// constructor with database
		public function __construct($db){
			$this->conn = $db;
		}

		// get bills
		public function read(){
			// query
			$query = 'SELECT 
				id,
				created_date,
				bill_id,
				bill_info,
				total_point,
				total_price,
				customer_name,
				cashier_name
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

		// get single bill
		public function read_single(){
			$query = 'SELECT 
				id,
				created_date,
				bill_id,
				bill_info,
				total_point,
				total_price,
				customer_name,
				cashier_name
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
			$this->created_date = $row['created_date'];
			$this->bill_info = $row['bill_info'];
			$this->bill_id = $row['bill_id'];

			$this->total_point = $row['total_point'];
			$this->total_price = $row['total_price'];
			$this->customer_name = $row['customer_name'];
			$this->cashier_name = $row['cashier_name'];
		}

		// update bill
		public function update(){
			// create query
			$query = 'UPDATE '.$this->table.'
				SET 
				bill_info = :bill_info,
				bill_id = :bill_id,
				created_date = :created_date,
				total_point = :total_point,
				total_price = :total_price,
				customer_name = :customer_name,
				cashier_name = :cashier_name
				WHERE
				id = :id';

			// prepare statement
			$stmt = $this->conn->prepare($query);

			// clean data
			$this->bill_info=json_encode($this->bill_info);

			$this->id=htmlspecialchars(strip_tags($this->id));
			$this->created_date=htmlspecialchars(strip_tags($this->created_date));
			$this->bill_id=htmlspecialchars(strip_tags($this->bill_id));
			
			$this->total_point=htmlspecialchars(strip_tags($this->total_point));
			$this->total_price=htmlspecialchars(strip_tags($this->total_price));
			$this->customer_name=htmlspecialchars(strip_tags($this->customer_name));
			$this->cashier_name=htmlspecialchars(strip_tags($this->cashier_name));
			

			// bind data
			$stmt->bindParam(':id', $this->id);
			$stmt->bindParam(':created_date', $this->created_date);
			$stmt->bindParam(':bill_info', $this->bill_info);
			$stmt->bindParam(':bill_id', $this->bill_id);
			
			$stmt->bindParam(':total_point', $this->total_point);
			$stmt->bindParam(':total_price', $this->total_price);
			$stmt->bindParam(':customer_name', $this->customer_name);
			$stmt->bindParam(':cashier_name', $this->cashier_name);

			// execute query
			if($stmt->execute()){
				return true;
			}

			// print error
			print('Error: %s.\n'. $stmt->error);

			return false;
		}

		// create bill
		public function create(){
			// echo json_encode($bill_info);
			// create query
			$query = 'INSERT INTO '.$this->table.'
				SET 
				created_date = :created_date,
				bill_info = :bill_info,
				bill_id = :bill_id,
				total_point = :total_point,
				total_price = :total_price,
				customer_name = :customer_name,
				cashier_name = :cashier_name';

			// prepare statement
			$stmt = $this->conn->prepare($query);

			// clean data
			$this->bill_info=json_encode($this->bill_info);

			$this->created_date=htmlspecialchars(strip_tags($this->created_date));
			$this->bill_id=htmlspecialchars(strip_tags($this->bill_id));
			
			$this->total_point=htmlspecialchars(strip_tags($this->total_point));
			$this->total_price=htmlspecialchars(strip_tags($this->total_price));
			$this->customer_name=htmlspecialchars(strip_tags($this->customer_name));
			$this->cashier_name=htmlspecialchars(strip_tags($this->cashier_name));
			
			
			// bind data
			$stmt->bindParam(':created_date', $this->created_date);
			$stmt->bindParam(':bill_info', $this->bill_info);//
			$stmt->bindParam(':bill_id', $this->bill_id);

			$stmt->bindParam(':total_point', $this->total_point);
			$stmt->bindParam(':total_price', $this->total_price);
			$stmt->bindParam(':customer_name', $this->customer_name);
			$stmt->bindParam(':cashier_name', $this->cashier_name);

			// execute query
			if($stmt->execute()){
				return true;
			}

			// print error
			print('Error: %s.\n'. $stmt->error);
			return false;
		}

		// delete bill
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