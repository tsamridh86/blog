<!-- Objective of this page
1. Create a nice UI for login & signup 
2. The created blogger should be deactivated by default, the user will be later be activated by the admin.
3. There is currently no method to encrypt/decrypt the password, so you're more insecure than a teenage girl.

-->

<?php
	//the php code for the login of the user will come here.
	if(!empty($_POST['userName']) && !empty($_POST['pswd']))
	//the php code for the signup of the user will come here.
	if(!empty($_POST['newName']) && !empty($_POST['newPswd']))
?>

<!doctype html>
<head>
	<!-- The links to the css and javascript comes over here -->
	<link rel="stylesheet" type="text/css" href="../css/login.css">
	<script type="text/javascript" src="../js/login.js"></script>
	<!--Pull the resources of the admin css because I can lol -->
	<link rel="stylesheet" type="text/css" href="../css/admin.css">
</head>
<title>Login Page</title>
<body>
	<!--This class is the admin wala, rest is pure magic -->
	<form method='post' action="index.php">
	<div class="login" id="login">
		<h4> Enter user details here </h4>
			<p>User Name :</p>
			<input type="text" name="userName">
			<br>
			<p>Password : </p>
			<input type="password" name="pswd">
			<br><br>
			<input type="submit" value="Login">
			<br><br>
			<a onclick="changestuff();">New here? Click here to signup</a>
	</div>
	</form>
	<form method='post' action="index.php">
	<div class="login" id="signUp">
		<h4> Alright, let's get you started </h4>
			<p>New User Name :</p>
			<input type="text" name="newName">
			<br>
			<p>New Password : </p>
			<input type="password" name="newPswd">
			<br><br>
			<input type="submit" value="Sign Up">
			<br><br>
			<a onclick="changestuff();">Already a member? Login here</a>
	</div>
	</form>
</body>
</html>