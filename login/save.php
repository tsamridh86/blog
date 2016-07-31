<!-- This is the page where we dunk all the information into the database -->
<?php 
	//the usual drill
	session_start();
	if(empty($_SESSION['userName']))
		header("location:../index.php");
	require '../config/classBundle.php';
	$blogger = new blogger();
	$blogger->getDetails($_SESSION['userName']);
	//time to save in the database, calling in the blog class
	$blog = new blog();
	$blog->writeblog($blogger->getId(), $_POST['title'], $_POST['desc'] , $_POST['category'] , $_SESSION['userName']);
	header("location:userPage.php");
?>