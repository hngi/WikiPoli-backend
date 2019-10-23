<?php
    include_once('Config.php');
?>
<?php

    class Database{

        public $host = DB_HOST;
		public $user = DB_USER;
		public $pass = DB_PASS;
		public $dbname = DB_NAME;

		public $link;
		public $error;
		
		public function __construct(){
			$this->connectDB();
		}

		// Connect to database
		private function connectDB(){
			$this->link = new mysqli($this->host, $this->user, $this->pass, $this->dbname);
			if (!$this->link) {
				$this->error = "Connection fail".$this->link->connect_error;
				return false;
			}
		}

		// Select Data or Read Data
		public function select($query){
			$result = $this->link->query($query) or die($this->link->error.__LINE__);
			if ($result->num_rows > 0) {
				return $result;
			}
			else {
				return false;
			}
		}

		// Select Data or Read Dataand return total row
		public function get_total_rows($query){
			$result = $this->link->query($query) or die($this->link->error.__LINE__);
			if ($result->num_rows > 0) {
				return $result->num_rows;
			}
			else {
				return false;
			}
		}

		// Insert Data
		public function insert($query){
			$insert_row = $this->link->query($query) or die($this->link->error.__LINE__);
			if ($insert_row) {
				return $insert_row;
			}
			else {
				return false;
			}
		}

		// Update Data 
		public function update($query){
			$update_row = $this->link->query($query) or die($this->link->error.__LINE__);
			if ($update_row) {
				return $update_row;
			}
			else {
				return false;
			}
		}

		// Delete Data
		public function delete($query){
			$delete_row = $this->link->query($query) or die($this->link->error.__LINE__);
			if ($delete_row) {
				return $delete_row;
			}
			else {
				return false;
			}
		}
    }
?>