<?php


class Database {
	
	private static $instance = null;

	private $pdo;
	private $query;
	private $error = false;
	private $results;
	private $count = 0;

	public function getResults()
	{
		return $this->results;
	}

	public function getCount()
	{
		return $this->count;
	}

	private function __construct() {
		try {
			$this->pdo = new PDO('mysql:host=127.0.0.1;dbname=OurTrack', 'root', 'root');
		} catch (PDOException $e) {
			die($e->getMessage());
		}
	}

	public static function getInstance() {
		if (!isset(self::$instance)) {
			self::$instance = new Database();
		}

		return self::$instance;
	}

	public function fetchToClass($sql, $class) {
		$this->query = $this->pdo->query($sql);

		if ($this->query->execute()) {
			$this->results = $this->query->fetchAll(PDO::FETCH_CLASS, $class);
			$this->count = $this->query->rowCount();
		}

		return $this->results;
	}

	public function query($sql, $params = array()) {
		$this->error = false;
		if ($this->query = $this->pdo->prepare($sql)) {
			if (count($params)) {
				$count = 1;
				foreach ($params as $param) {
					$this->query->bindValue($count, $param);
					$count++;
				}
			}

			if ($this->query->execute()) {
				$this->results = $this->query->fetchAll(PDO::FETCH_OBJ);
				$this->count = $this->query->rowCount();
			} else {
				$this->error = true;
			}
		}

		return $this;
	}

	public function action($action, $table, $where = array()) {
		if (count($where) === 3) {
			$operators = array('=', '>', '<', '<=', '>=');

			$column = $where[0];
			$operator = $where[1];
			$value = $where[2];

			if (in_array($operator, $operators)) {
				$sql = "{$action} FROM {$table} WHERE {$column} {$operator} ?";
				if (!$this->query($sql, array($value))->error()) {
					return $this;
				}
			}
		} 
	}

	public function get($table, $where) {
		return $this->action("SELECT *", $table, $where);
	}

	public function delete($table, $where) {
		return $this->action("DELETE", $table, $where);
	}

	public function insert($table, $fields = array()) {
		if (count($fields)) {
			$keys = array_keys($fields);
			$values = '';
			$count = 1;

			foreach($fields as $field) {
				$values .= '?';
				if ($count < count($fields)) {
					$values .= ', ';
				}
				$count++;
			}

			$sql = "INSERT INTO {$table} (`".implode('`, `', $keys)."`) VALUES ({$values})";


			if (!$this->query($sql, $fields)->error()) {
				return true;
			}
		}

		return false;
	}

	public function update($table, $id, $fields = array()) {
		if (count($fields)) {
			$set = '';
			$count = 1;

			foreach ($fields as $key => $value) {
				$set .= "{$key} = ?";
				if ($count < count($fields)) {
					$set .= ", ";
				}
				$count++;
			}

			$sql = "UPDATE {$table} SET {$set} WHERE id = {$id}";

			error_log($sql);

			if (!$this->query($sql, $fields)->error()) {
				return true;
			}

			return false;
		}
	}

	public function error() {
		return $this->error;
	}

	public function count() {
		return $this->count;
	}

	public function results() {
		return $this->results;
	}

	public function first() {
		return $this->results()[0];
	}

}


?>