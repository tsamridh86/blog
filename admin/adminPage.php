<!--
	1. Admin should be able to see all the bloggers.  <- Done
	2. Admin can deactivate & activate bloggers at will.
	3. Admin can delete posts at will.
	4. Admin is baap & maa at the same time. #super-position
-->
<?php
	error_reporting(0);
	session_start();
	if(($_POST['userName']=="admin" && $_POST['pswd']=="admin@123")||$_SESSION['userName']=='admin')
	{
		//if the permission are correct
		//begin the administrator session
		$_SESSION['userName'] = 'admin';
			require '../config/classBundle.php';	//call the required classes
			$connect = new connector(); 			//begin a connection to the database
		
		//if a signal is sent to deactivate / activate a user, it is passed thru here to perform the required action
		if(!empty($_POST['aId'])&&!empty($_POST['activity']))
		{
			if($_POST['activity']=='N') $endDate = date("Y-m-d");
			else $endDate = "NULL";
			$connect->executeQuery("update blogger_info set isActive = '".$_POST['activity']."' , endDate = '".$endDate."' where bloggerId = ".$_POST['aId']);
		}
		//if a signal is sent to deactivate / activate a user, it is passed thru here to perform the required action
		if(!empty($_POST['bId'])&&!empty($_POST['shown']))
		{
			$updatedDate = date("Y-m-d");
			$connect->executeQuery("update blogger_info set updatedDate = '".$updatedDate."' where bloggerId = ".$_POST['rId']);
			$connect->executeQuery("update blog_master set blogActivity = '".$_POST['shown']."' , updatedDate = '".$updatedDate."' where blogId = ".$_POST['bId']);
		}
?>
<!DOCTYPE html>
<title> Admin page </title>
<head>
	<!--Link to the css comes here -->
	<link rel="stylesheet" type="text/css" href="/blog/css/admin.css">
</head>
<body>
	<a href="/blog/admin/logout.php" class='logout'>Logout</a>
	<div class='header'>
	<h4> Welcome, administrator </h3>
	</div>
	<div class="header">
		<h4>List of Bloggers :</h4>
	</div>
	<table class='details'>
		<thead>
			<tr>
				<td>Blogger Id</td>
				<td>Blogger Name</td>
				<td>Password</td>
				<td>Created On</td>
				<td>Activity</td>
				<td>Last Update</td>
				<td>End Date</td>
				<td>Change Activity</td>
			</tr>
		</thead>
		<tbody>
			<?php
				$allBloggers = "select userName from blogger_info";
				$allBloggers = $connect->executeQuery($allBloggers);
				$blogger = new blogger();
				while($row = $allBloggers->fetch_assoc())
				{
					
					echo "<tr>";
					$blogger->showDetailsAsTable($row['userName']);
						
					//This section is used to create the activate/ deactivate form
					echo "<td><form method='post' action='adminPage.php'>
							<input type = 'hidden' name = 'aId'value = ".$blogger->getId().">";
							
					//keep in the mind that the values have been swapped for easier jugaad
					if($blogger->isActive()!='Y')
						echo "<button name='activity' type= 'submit' value = 'N'>Deactivate</button>";
					else
						echo "<button name='activity' type='submit' value = 'Y'>Activate</button>";
							
						echo "</form></td></tr>";
					}
				?>
			</tbody>
		</table>
		<hr>
		<div class="header">
			<h4>List of Blogs :</h4>
		</div>
		<table class='details'>
			<thead>
				<tr>
					<td>Blog Author</td>
					<td>Blog Title</td>
					<td>Category</td>
					<td>Description</td>
					<td>Activity</td>
					<td>Created On</td>
					<td>Updated On</td>
					<td>Change Activity</td>
				</tr>
			</thead>
			<tbody>
				<?php
					$allBlogs = "select blogId from blog_master";
					$allBlogs = $connect->executeQuery($allBlogs);
					$blog = new blog();
					while($row = $allBlogs->fetch_assoc())
					{
						
						$blog->getBlog($row['blogId']);
						echo "<tr>";
						echo "<td>".$blog->blogAuthor."</td>";
						echo "<td>".$blog->blogTitle."</td>";
						echo "<td>".$blog->blogCategory."</td>";
						echo "<td>".$blog->blogDesc."</td>";
						if($blog->getBlogActivity()=='A')
						echo "<td> Displayed </td>";
						else echo "<td> Hidden </td>";
						echo "<td>".$blog->createdOn."</td>";
						if(empty($blog->updatedOn))
						echo "<td>-</td>";
						else
						echo "<td>".$blog->updatedOn."</td>";
						//This section is used to create the hide/show form
						echo "<td><form method='post' action='adminPage.php'>
								<input type = 'hidden' name = 'bId'value = ".$blog->getBlogId().">
								<input type = 'hidden' name = 'rId'value = ".$blog->getBloggerId().">";
								
							//keep in the mind that the values have been swapped for easier jugaad
						if($blog->getBlogActivity()=='A')
							echo "<button name='shown' type= 'submit' value = 'H'>Hide</button>";
						else
								echo "<button name='shown' type='submit' value = 'A'>Show</button>";
							
						echo "</form></td>";
						echo "</tr>";
					}
				?>
			</tbody>
		</table>
		<hr>
	</body>
</html>
<?php
}
else
{
echo "Incorrect information. Try again.";
}
?>