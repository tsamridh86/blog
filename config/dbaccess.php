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

  //this is an extra function to calculate the name of the image to be replaced during the server upload
  function nameOfImage ( $fileName) 
  {
  	$i = 0;
		while(file_exists("../images/".$fileName))
		{
			if(!$i) 
			$fileName = substr($fileName,0,-4).$i.substr($fileName, -4);
			else 	 
				$fileName= substr($fileName,0,-(numberOfDigits($i)+4)).$i.substr($fileName, -4);
			$i++;
		}
		return $fileName;
  }

?>