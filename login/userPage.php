<!-- This is the user page, the objective of this page is :
1. Since the blog is going to be stored in a text file & only the details of the textfile will be saved in the database.
2. There will be a edit tab on each blog post which will allow them to edit the blogs one by one.
3. There will be a insert at the top if & only if the admin has enabled them, the disabled state users may not have an option to insert more data on the page.
4. All the blogs belonging to the user only must be displayed.
5. This is going to be super complicated. so lol. -->
<!doctype html>
<title> User Page </title>
<head>
<!-- Any links to the css or the javascript file will come here -->
<link rel="stylesheet" type="text/css" href="../css/user.css">
<!-- This is the link of the index file here for the right class -->
<link rel="stylesheet" type="text/css" href="../css/index.css">
</head>
<?php 

	//begin the game of sessions, lol
	session_start();
	//redirect away if a session is not active
	if(empty($_SESSION['userName']))
		header("location:../index.php");
	//now that everything is verified & secured, bringing in the heavy guns
	require '../config/classBundle.php';
	$blogger = new blogger();

	//getting the details of the currently logged in user 
	$blogger->getDetails($_SESSION['userName']);
	?>
<body>
<div class="welcome">
<strong>Welcome,</strong> <?php echo $_SESSION['userName']; ?>
<a href="write.php" type="submit" <?php if(!$blogger->isActive()) echo "class='disabled'"; ?> >Write a Blog</a href="write.php">
<a class="right" href="../admin/logout.php">Log Out</a>
<hr>
</div>
</body>
</html>