<?php 
 	// CLASS BILL
	class Bill {
		private $conn;
		private $table = 'bill';

		// propertiess
		public $id;
		public $created_date;
		public $bill_code;
		public $bill_info;
		
		public $total_price;
		public $total_point;
		public $customer_name;
		public $cashier_name;

		// constructor with database
		public function __construct($db){
			$this->conn = $db;
		}

		// GET BILLS
		public function read(){
			// query
			$query = 'SELECT 
				id,
				created_date,
				bill_code,
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

		// GET NEW BILLS SINCE THE LATEST SYNC
		public function read_latest(){
			// query
			$q = 'SELECT server_version FROM sync_log ORDER BY id DESC LIMIT 1';

			$query = 'SELECT 
				l.id,
				l.bill_code,
				a.bill_code,
				a.bill_info,
				a.created_date,
				a.total_price,
				a.total_point,
				a.customer_name,
				a.cashier_name,
				l.version,
				l.operation
				FROM
				bill_log l
				LEFT JOIN
				' . $this->table . ' a
				ON a.id = l.bill_code
				WHERE l.version = ('.$q.')
				ORDER BY 
				id ASC';

			// prepare statement
			$stmt = $this->conn->prepare($query);

			// execute query
			$stmt->execute();

			return $stmt;
		}

		// GET SINGLE BILL
		public function read_single(){
			$query = 'SELECT 
				id,
				created_date,
				bill_code,
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
			$this->bill_code = $row['bill_code'];

			$this->total_point = $row['total_point'];
			$this->total_price = $row['total_price'];
			$this->customer_name = $row['customer_name'];
			$this->cashier_name = $row['cashier_name'];
		}

		// UPDATE BILL
		public function update(){
			// create query
			$query = 'UPDATE '.$this->table.'
				SET 
				bill_info = :bill_info,
				bill_code = :bill_code,
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
			$this->bill_code=htmlspecialchars(strip_tags($this->bill_code));
			
			$this->total_point=htmlspecialchars(strip_tags($this->total_point));
			$this->total_price=htmlspecialchars(strip_tags($this->total_price));
			$this->customer_name=htmlspecialchars(strip_tags($this->customer_name));
			$this->cashier_name=htmlspecialchars(strip_tags($this->cashier_name));
			

			// bind data
			$stmt->bindParam(':id', $this->id);
			$stmt->bindParam(':created_date', $this->created_date);
			$stmt->bindParam(':bill_info', $this->bill_info);
			$stmt->bindParam(':bill_code', $this->bill_code);
			
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

		// ADD BILL
		public function create(){
			// create query
			$query = 'INSERT INTO '.$this->table.'
				SET 
				created_date = :created_date,
				bill_info = :bill_info,
				bill_code = :bill_code,
				total_point = :total_point,
				total_price = :total_price,
				customer_name = :customer_name,
				cashier_name = :cashier_name';

			// prepare statement
			$stmt = $this->conn->prepare($query);

			// clean data
			$this->bill_info=json_encode($this->bill_info);

			$this->created_date=htmlspecialchars(strip_tags($this->created_date));
			$this->bill_code=htmlspecialchars(strip_tags($this->bill_code));
			
			$this->total_point=htmlspecialchars(strip_tags($this->total_point));
			$this->total_price=htmlspecialchars(strip_tags($this->total_price));
			$this->customer_name=htmlspecialchars(strip_tags($this->customer_name));
			$this->cashier_name=htmlspecialchars(strip_tags($this->cashier_name));
			
			
			// bind data
			$stmt->bindParam(':created_date', $this->created_date);
			$stmt->bindParam(':bill_info', $this->bill_info);//
			$stmt->bindParam(':bill_code', $this->bill_code);

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

		// DELETE BILL
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