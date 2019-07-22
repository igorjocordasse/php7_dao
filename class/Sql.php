<?php

class Sql extends PDO {

	private $conn;

	function __construct(){

		$this->conn = new PDO("mysql:dbname=dbphp7;host=127.0.0.1","root","");
	}

	private function setParams($statment, $paramters = array()){

		foreach ($paramters as $key => $value) {
		
		 $this->setParam($statment,$key,$value);	
		}
	}

	private function setParam($statment, $key,$value){

		$statment->bindParam($key,$value);
	}

	function query($rowQuery, $params = array()){

		$stmt = $this->conn->prepare($rowQuery);

		$this->setParams($stmt, $params);

		$stmt->execute();
		
		return $stmt;
	}

	function select($rowQuery, $params = array()):array{

		$stmt = $this->query($rowQuery, $params);

		return  $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
}