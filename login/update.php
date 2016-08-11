<?php
	//this is a pure php page created only to update the blog from the userPage.
	//the usual drill
	session_start();
	if(empty($_SESSION['userName']))
		header("location:../index.php");
	require '../config/classBundle.php';
	$blogger = new blogger();
	$blogger->getDetails($_SESSION['userName']);
	
	$conn = new connector();
	//upload this file into the server if it is there
	if(!empty($_FILES['pic']['tmp_name']))
	{
	$file_temp = $_FILES['pic']['tmp_name'];
	$file_name = $_FILES['pic']['name'];

	//the name of image function will rename the file name if it already exists
	$file_name = nameOfImage($file_name);		
	move_uploaded_file($file_temp,"../images/".$file_name);
	
	$conn->executeQuery("update blog_detail_image set blogImage = 'images/".$file_name."' where blogId = ".$_POST['id']);
	}

	//time to update in the database,
	$query = "update blog_master set blogTitle = '".$_POST['title']."' , blogDesc = '".$_POST['desc']."' , blogCategory = '".$_POST['category']."' , updatedDate = '".date('Y-m-d')."' where blogId = ".$_POST['id'];
	$conn->executeQuery($query);
	
	//now since the user has made a update, make an update on his account as well
	$conn->executeQuery("update blogger_info set updatedDate = '".date('y-m-d')."' where bloggerId = ".$blogger->getId());
	header("location:userPage.php");

?>