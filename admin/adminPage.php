<!-- Objective of this page
	1. Admin should be able to see all the bloggers.  <- Done
	2. Admin can deactivate & activate bloggers at will. 
	3. Admin can delete posts at will.
	4. Admin is baap & maa at the same time. #super-position
-->

<?php
	session_start();
	if(($_POST['userName']=="admin" && $_POST['pswd']=="admin@123")||$_SESSION['userName']=='admin')
	{
		//if the permission are correct
		//begin the administrator session
		$_SESSION['userName'] = 'admin';
		require '../config/classBundle.php';	//call the required classes
		$connect = new connector(); 			//begin a connection to the database 
		if(!empty($_POST['aId'])&&!empty($_POST['activity']))
		{
			if($_POST['activity']=='N') $endDate = date("Y-m-d");
			else $endDate = "NULL";
			$connect->executeQuery("update blogger_info set isActive = '".$_POST['activity']."' , endDate = '".$endDate."' where bloggerId = ".$_POST['aId']);
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
	<div class="header">
		<h4>List of Bloggers :</h4>
		<hr>
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
</body>
</html>
<?php
}
else
{
echo "Incorrect information. Try again.";
}
?>