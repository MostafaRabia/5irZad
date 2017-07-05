<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="css/login.css"/>
</head>
<body>
	<div class="login">
		<h1>Login</h1>
	    <form method="post">
	    	<input type="text" name="u" placeholder="Username" required />
	        <input type="password" name="p" placeholder="Password" required />
	        <button type="submit" name="b" class="btn btn-primary btn-block btn-large">Let me in.</button>
	    </form>
	</div>
</body>
</html>
<?php
if (isset($_POST['b'])){
	$username = htmlspecialchars(strip_tags($_POST['u']));
	$password = htmlspecialchars(strip_tags(md5(md5(md5(sha1(md5(md5(md5(md5($_POST['p']))))))))));
	if ($username=='AdminIslam'&&$password=='e79a67f0fbcf328d938dacf825aff165'){
		$_SESSION['login'] = true;
		header("LOCATION: upload.php");
	}
}