<!-- This is the page where we dunk all the information into the database -->
<?php 
	//the usual drill
	session_start();
	if(empty($_SESSION['userName']))
		header("location:../index.php");
	require '../config/classBundle.php';
	$blogger = new blogger();
	$blogger->getDetails($_SESSION['userName']);
	
	//upload this file into the server
	$file_temp = $_FILES['pic']['tmp_name'];
	$file_name = $_FILES['pic']['name'];

	//the name of image function will rename the file name if it already exists
	$file_name = nameOfImage($file_name);		
	move_uploaded_file($file_temp,"../images/".$file_name);
	
	//time to save in the database, calling in the blog class
	$blog = new blog();
	$blog->writeblog($blogger->getId(), $_POST['title'], $_POST['desc'] , $_POST['category'], "images/".$file_name );
	header("location:userPage.php");
?>