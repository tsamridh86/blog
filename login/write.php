<!--This page is for the user to write thier blogs -->
<!doctype html>
<title> Write a blog </title>
<head>
	<!-- The link to the css comes here -->
	<link rel="stylesheet" type="text/css" href="../css/user.css">
</head>
<body>
<?php
	//get the details of the user for filling up the database, these are kept in hidden, because the user is a dumb guy & doesnt need to know anyway. lol
	
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
<form method="post" action="save.php" enctype="multipart/form-data">
<table class="title">
<tr>
	<td class = 'left'><span>Title : </span></td>
	<td class="small"><input type="text" name="title" maxlength="50"></td>
</tr>
<tr>
	<td class = 'left'><span>Category :</span></td>
	<td class="small"> <input type="text" name="category" maxlength="10"></td>
</tr>
<tr>
	<td class = 'left'><span>Image :</span></td>
	<td class="small"> <input type="file" name="pic"></td>
</tr>
<tr><td><span>Description :</span></td></tr>
</table>
<textarea name='desc' rows="5" cols="100"></textarea><br>
<button class='ipt' type="submit">Post</button>
<a class="cancel" href="userPage.php">Cancel</a>
</form>
</body>
</html>