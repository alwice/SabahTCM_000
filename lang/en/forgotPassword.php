<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" conetent="text/html; charset=UTF-8">
	<link href="../../images/logo2.png" rel="icon" > <!--Icon-->
	<link href="../../css/font-awesome.css" rel="stylesheet" > <!--font-awsome icon-->
	<link href="../../css/docs.css" rel="stylesheet" > <!--doc css-->
	<link href="../../css/bootstrap.min.css" rel="stylesheet"> <!--Bootstrap-->
	<link href="../../css/style.css" rel="stylesheet" type="text/css" >
	<link href="../../css/selfstyle.css" rel="stylesheet" type="text/css" >	
	<script src="../../js/jquery-3.1.1.min.js"></script> 
	<title>Forgot Password</title>
</head>
<body>
<div class="container">
	<form class="form-signin" method="POST">
	<input type="text" name="username" class="form-control" placeholder="Username" required />
</div>
	<button class="btn btn-lg btn-primary btn-block" type="submit">Forgot Password</button>
</form>
</div>
</body>
</html>
<?php
	require "db_conn.php";
	if(isset($_POST) & !empty($_POST)){
		$username = mysqli_real_escape_string($conn, $_POST['username']);
		$sql = "SELECT * FROM user WHERE username = '$username'";
		$res = mysqli_query($conn, $sql);
		$count = mysqli_num_rows($res);
		if($count == 1){
			$r = mysqli_fetch_assoc($res);
			$password = $r['password'];
			$to = $r['email'];
			$subject = "Your Recovered Password";
			$message = "Here is your login information for accessing the SabahTCM."."\nPlease use this password to login.\nPassword: ".$password;
			$email_from = "admin@sabahtcm.com";
			$headers = "From: ".$email_from;
			if(mail($to, $subject, $message, $headers)){
				echo "Your Password has been sent to your email.";
			}else{
				echo "Failed to Recover your password, try again";
			}
		}else{
			echo "User name does not exist in database";
		}
	}
?>