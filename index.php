<!DOCTYPE html>
<html>
<head>
	<title>Blog</title>
	<!--Links to bootstrap & jquery are here -->
	<script src="js/jquery-3.1.0.min.js"></script>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/bootstrap-theme.min.css"> 
	<script src="js/bootstrap.min.js"></script>

	<!--Link to the custom css-->
	<link rel="stylesheet" type="text/css" href="css/index.css">
</head>
<body>
<nav class="navbar navbar-default" role="navigation">
	<div class="container-fluid">
		<div class="navbar-header">
			<a class="navbar-brand" href="#">Blog</a>
		</div>
		<div class="collapse navbar-collapse navbar-ex1-collapse">
			<ul class="nav navbar-nav">
				<li class="active"><a><span class="glyphicon glyphicon-home" aria-hidden="true"></span> Home</a></li>
				<li><a href="#">Link</a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li><a href="login"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Login</a></li>
			</ul>
		</div>
	</div>
</nav>
<div class="container-fluid bg">
<?php
	//retrieve all the blogs written by the user
	require '/config/classBundle.php';
	$connect = new connector();
	$que = "select * from blog_master natural join blog_detail_image order by createdDate desc";
	$blogs = $connect->executeQuery($que);
	if(empty($blogs)) echo "<p> There are no blogs here honey. </p>";
	else
	while($blog = $blogs->fetch_assoc())
	{
?>
<div class="blog">
<form method='post' action='edit.php'>
<img src="<?php echo $blog['blogImage']; ?>" class='img-responsive'>
<h3><?php echo $blog['blogTitle']; ?></h3>
<p class='cat'> Category : <?php echo $blog['blogCategory']; ?></p>
<p class='desc'> <?php echo $blog['blogDesc']; ?> 
</form>
</div>
<?php } ?>
</body>
</html>