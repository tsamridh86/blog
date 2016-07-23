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
		private $type;
		//the private variable type is used to define the type of the user, whether it is a normal user or the admin blogger, however the normal viewers do not have to login

		public function __construct()
		{
			//we make sure that the table is created & if it is not then we create it on the spot.
			$createBlogger = "create table if not exists blogger_info ( bloggerId int primary key auto_increment, userName varchar(50), password varchar(25), createdDate date, isActive char(1), updatedDate date, endDate date)";
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

		private function getDetails($userName)
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
				return "The userName already exists, please try another name.";
			
			else //create account if it is a unique userName 
			{
				$createUser = "insert into blogger_info (userName , password, createdDate , isActive , updatedDate , endDate ) values ('".$userName."','".$password."','".date("Y-m-d")."','Y','".date("Y-m-d")."',NULL)";
				$connect->executeQuery($createUser);
				return "Account successfully created.";
			}
		}

		public function showDetails()
		{
			$this->getDetails($this->userName);
			
			echo "Blogger ID : ".$this->bloggerId."<br>" ;
			echo "User Name : ".$this->userName."<br>" ;
			echo "Password : ".$this->password."<br>" ;
			echo "Created On : ".$this->createdOn."<br>" ;
			echo "Activity : ";
			if($this->isActive == 'Y')
				echo "Active.";
			else echo "Not Active.";
			echo "<br>";
			echo "Updated On: ".$this->updatedOn."<br>" ;
			if($this->endDate)
			echo "End date : ".$this->endDate."<br>" ;

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
				echo "No such account exists.";
				return 0;
			}
		}

		public function logout ()
		{
			session_destroy();
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