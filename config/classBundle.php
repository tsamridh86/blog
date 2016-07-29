<?php
	
	require 'dbaccess.php';

	class blogger 
	{
		private $bloggerId;
		private $userName;
		private $password;
		private $createdOn;
		private $isActive;
		private $updatedOn;
		private $endDate;
		
		public function __construct()
		{
			//we make sure that the table is created & if it is not then we create it on the spot.
			$createBlogger = "create table if not exists blogger_info ( bloggerId int primary key auto_increment, userName varchar(50), password varchar(25), createdDate date, isActive char(1) default 'N', updatedDate date, endDate date)";
			$connect = new connector();
			$connect->executeQuery($createBlogger);
		}

		private function checkUser ($userName , $password)
		{
			//check to see whether the same userName exists to warn the person
			$warn = "select userName from blogger_info where userName = '".$userName."' and password = '".$password."'";
			$connect = new connector();
			$res = $connect->executeQuery($warn);
			return $res;
		}

		public function getDetails($userName)
		{
			$connect = new connector();
			$details = "select * from blogger_info where userName = '".$userName."'";
			$details = $connect->executeQuery($details);
			$details = $details->fetch_assoc();
			$this->bloggerId = $details['bloggerId'];
			$this->userName = $details['userName'];
			$this->password = $details['password'];
			$this->createdOn = $details['createdDate'];
			$this->isActive = $details['isActive'];
			$this->updatedOn = $details['updatedDate'];
			$this->endDate = $details['endDate'];
		}

		public function createBlogger ($userName, $password)
		{
			$connect = new connector();
			if(mysqli_num_rows($this->checkUser($userName, $password)))
				echo "<p class='error'>The User Name already exists, please try another name.</p>";
			
			else //create account if it is a unique userName 
			{
				$createUser = "insert into blogger_info (userName , password, createdDate , updatedDate , endDate ) values ('".$userName."','".$password."','".date("Y-m-d")."','".date("Y-m-d")."',NULL)";
				$connect->executeQuery($createUser);
				echo "<p class='success'>Account successfully created. Login to begin.</p>";
			}
		}

		public function showDetails($userName)
		{
			$this->getDetails($userName);
			echo "<p>Blogger ID : ".$this->bloggerId."</p>" ;
			echo "<p>User Name : ".$this->userName."</p>" ;
			echo "<p>Password : ".$this->password."</p>" ;
			echo "<p>Created On : ".$this->createdOn."</p>" ;
			echo "<p>Activity : ";
			if($this->isActive == 'Y')
				echo "Active.";
			else echo "Not Active.";
			echo "</p>";
			echo "<p>Updated On: ".$this->updatedOn."</p>" ;
			if($this->endDate)
			echo "<p>End date : ".$this->endDate."</p>" ;
		}

		public function showDetailsAsTable($userName)
		{
			$this->getDetails($userName);
			echo "<td>".$this->bloggerId."</td>" ;
			echo "<td>".$this->userName."</td>" ;
			echo "<td>".$this->password."</td>" ;
			echo "<td>".$this->createdOn."</td>" ;
			echo "<td>";
			if($this->isActive == 'Y')
				echo "Active.";
			else echo "Not Active.";
			echo "</td>";
			echo "<td>".$this->updatedOn."</td>" ;
			if($this->endDate && $this->endDate != "0000-00-00")
			echo "<td>".$this->endDate."</td>" ;
			else
				echo "<td></td>";	
		}

		public function login ($userName , $password )
		{
			if(mysqli_num_rows($this->checkUser($userName , $password)))
			{
				session_start();
				$this->getDetails($userName);
				$_SESSION['userName'] = $userName;
				echo "Successfully logged in.";
			}
			else 
			{
				echo "<p class='error'>No such account exists.</p>";
				return 0;
			}
		}

		public function logout ()
		{
			session_destroy();
		}

		public function isActive()
		{
			return $this->isActive;
		}

		public function getId()
		{
			return $this->bloggerId;
		}
	}

	class blog
	{
		private $blogId;
		private $bloggerId;
		private $blogActivity;
		public $blogTitle;
		public $blogDesc;
		public $blogCategory;
		public $blogAuthor;
		public $createdOn;
		public $updatedOn;
	}


?>