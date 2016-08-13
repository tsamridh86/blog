<!--This page is to display the details of the user,
1. we reach this page, without the use of sessions or the use of an unnessacry form, just a simple twist in the href
2. lol , nothing to see here, move
3. there is no use of bootstrap here
-->
<?php
	require '../config/classBundle.php';
	$connect = new connector();
	$bloggerDetails = "select userName from blogger_info where bloggerId = ".$_GET['id'];
	$bloggerDetails = $connect->executeQuery($bloggerDetails);
	$blogger = new blogger();
	$bloggerDetails = $bloggerDetails->fetch_assoc();
	$blogger->getDetails($bloggerDetails['userName'])
?>
<!DOCTYPE html>
<html>
	<title>About, <?php echo $blogger->getUserName();?></title>
	<head>
		<!-- The link to the css & js -->
		<link rel="stylesheet" type="text/css" href="../css/user.css">
		<link rel="stylesheet" type="text/css" href="../css/index.css">
	</head>
	<body>
	<a href="../" class="right userDetails">Go back</a>
		<div class="userDetails">
			<?php
				$blogger->showDetails($bloggerDetails['userName']);
			?>
		</div>
		<div>
			<h3>Blogs written by the user : </h3>
			<hr>
			<?php
				//retrieve all the blogs written by the user
				$connect = new connector();
				$blog = new blog();
				$que = "select blogId from blog_master where bloggerId = ".$blogger->getId();
				$blogs = $connect->executeQuery($que);
				if(empty($blogs)) echo "<p> You have not written any blogs yet. </p>";
				else
				while($row = $blogs->fetch_assoc())
				{
					$blog->getBlog($row['blogId']);
			?>
			<div class="blog">
				<form method='post' action='edit.php'>
					<input type="hidden" name="id" value="<?php echo $blog->getBlogId();?>">
					<img src="<?php echo "../".$blog->imgLoc ; ?>" class='img'>
					<h3><?php echo $blog->blogTitle; ?></h3>
					<p class='cat'> By, <?php echo $blog->blogAuthor; ?> on <?php echo $blog->createdOn; ?></p>
					<?php if(!empty($blog->updatedOn)) echo "<p class='cat'> Last updated on , ".$blog->updatedOn; ?>
						<p class='cat'>Category : <?php echo $blog->blogCategory; ?></p>
						<p class='desc'> <?php echo $blog->blogDesc; ?></p>
					</form>
				</div>
				<?php }?>
			</div>
		</div>
	</body>
</html>