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
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li><a href="login"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Login</a></li>
				<li><a href="contact"><span class="glyphicon glyphicon-earphone" aria-hidden="true"></span> Contact Us</a></li>
			</ul>
		</div>
	</div>
</nav>
<div class="container-fluid bg">
<?php
	//retrieve all the blogs written by the user
	require '/config/classBundle.php';
	$connect = new connector();
	$disp = new blog();
	$que = "select blogId from blog_master where blogActivity = 'A' order by createdDate desc";
	$blogs = $connect->executeQuery($que);
	if(empty($blogs)) echo "<p> There are no blogs here honey. </p>";
	else
	while($blog = $blogs->fetch_assoc())
	{
		$disp->getBlog($blog['blogId']);
?>
<div class="blog">
<form method='post' action='edit.php'>
<img src="<?php echo $disp->imgLoc; ?>" class='img-responsive'>
<h3><?php echo $disp->blogTitle; ?></h3>
<p class='cat'> By, <a><?php echo $disp->blogAuthor; ?></a> on <?php echo $disp->createdOn; ?></p>
<p class='cat'> Category : <?php echo $disp->blogCategory; ?></p>
<p class='desc'> <?php echo $disp->blogDesc; ?> </p>
</form>
</div>
<?php } ?>
</body>
</html>