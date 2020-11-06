<?php
namespace Chalakorn;

class Database {
	public $conn = null;
	private $host = "localhost";
	private $database = "chalakorn_database";
	private $username = "root";
	private $password = "";
	private $port = "3306";
	private $charset = "utf8mb4";
	
	public function __construct()
	{
		$options = [
			\PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
			\PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
			\PDO::ATTR_EMULATE_PREPARES   => false,
		];
		
		$dsn = "mysql:host=".$this->host.";dbname=".$this->database.";charset=".$this->charset.";port=".$this->port;
		
		try {
			$this->conn = new \PDO($dsn, $this->username, $this->password, $options);
		} catch (\PDOException $e) {
			$this->conn = null;
		}
	}
}
?>