<?php
	require "config/classBundle.php";
	$me = new blogger();
	echo $me->createBlogger("Samridh","simu");
	$me->login("Samridh","simu");
	$me->showDetails();
	$me->logout();

?>