<!-- Objective of this page:
1. Load the previous content
2. Edit them
3. Upload them back to the database
4. For the image, if there is a new image uploaded, then it will be replaced in the database, otherwise it stays there
5. This is really hectic if you ask me lulz
-->
<?php
	//begin the game of sessions, lol
	session_start();
	//redirect away if a session is not active
	if(empty($_SESSION['userName']) || empty($_POST['id']))
		header("location:../index.php");
	//now that everything is verified & secured, bringing in the heavy guns
	require '../config/classBundle.php';
	$blogger = new blogger();
	//getting the details of the currently logged in user
	$blogger->getDetails($_SESSION['userName']);
	//bringing in the data of the previous stuff
	$blog = new blog();
	$blog->getBlog($_POST['id']);
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Edit Post</title>
		<!-- Using the same css from the write.php file -->
		<link rel="stylesheet" type="text/css" href="../css/user.css">
	</head>
	<body>
		<form method="post" action="update.php" enctype="multipart/form-data">
		<input type="hidden" name="id" value="<?php echo $_POST['id']; ?>">
			<table class="title">
				<tr>
					<td class = 'left'><span>Title : </span></td>
					<td class="small"><input type="text" name="title" maxlength="50" value="<?php echo $blog->blogTitle; ?>"></td>
				</tr>
				<tr>
					<td class = 'left'><span>Category :</span></td>
					<td class="small"> <input type="text" name="category" maxlength="10" value="<?php echo $blog->blogCategory; ?>"></td>
				</tr>
				<tr>
					<td class = 'left'><span>Image :</span></td>
					<td class="small"> <div class='response'><img class='img' src="<?php echo "../".$blog->imgLoc; ?>"></div></td>
				</tr>
				<tr>
				<td></td>
					<td class="small"> <input type="file" name="pic"> <span class="warn"> Uploading a image will replace the older one </span></td>
				</tr>
				<tr><td><span>Description :</span></td></tr>
			</table>
			<textarea name='desc' rows="5" cols="100"><?php echo $blog->blogDesc; ?></textarea><br>
			<button class='ipt' type="submit">Update</button>
			<a class="cancel" href="userPage.php">Cancel</a>
		</form>
	</body>
</html>