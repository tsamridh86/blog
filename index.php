<?php
	require "config/classBundle.php";
	$me = new blogger();
	echo $me->createBlogger("Samridh","simu");
	$me->login("Samridh","simu");
	$me->showDetails("samridh");
	$me->logout();
	$him = new blogger();
	echo $him->createBlogger("Samip","srija");
	

?>