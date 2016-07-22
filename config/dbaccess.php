<?php
  
class connector	
  {
  	private $connection;
    private $hostName;
    private $userName;
    private $password;
    private $database;
  	
  	public function __construct()
  	{
  		$this->hostName = "localhost";
  		$this->userName = "root";
  		$this->password = "";
  		$this->database = "blog";
  	}

  	//this function is used to open the connection between php & sql server
  	public function openConnection()
  	{
  		$this->connection = mysqli_connect($this->hostName,$this->userName,$this->password);
  		$createdb = "create database if not exists ".$this->database;
		$this->connection->query($createdb);
		mysqli_select_db($this->connection , $this->database);
  	}

  	//this function is used to close the opened connection 
  	public function closeConnection()
  	{
  		if (isset($this->connection)) 
  			$this->connection->close();
  	}

  	//this function is for executing sql queries
  	public function executeQuery ( $query )
  	{
  		$this->openConnection();
  		$result = $this->connection->query($query);
  		$this->closeConnection();
  		return $result;
  	}


  }

?>