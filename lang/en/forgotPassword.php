<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" conetent="text/html; charset=UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php
		$_SESSION['pages']="forgotPassword.php";
		include ("menu.php");
	?>
	<title>Forgot Password - SabahTCM</title>
</head>
<body>
	<div id="body">
		<br>
		<div style="background:lightblue" class="alert alert-info">Forgot Password</div>
		
		<?php
			$username=isset($_POST['username']) ? $_POST['username'] : NULL;
			$email=isset($_POST['email']) ? $_POST['email'] : NULL;
		?>
		</br>
		<div class="sidebar">	 
			<p><a href="login.php" class="btn btn-info"><i class="icon-arrow-left icon-large"></i>&nbsp;Back</a></p>
		</div>
		<div id="home" style="width:700px">
			<div id="hd">Please fills the information below</div>
			</br></br>
			<form class="form-inline" method="POST" action="" enctype="multipart/form-data">
				<!--Username-->
				<div class="form-group">
					<label style="padding-left: 125px">Username:</label>
					<input style="width:300px" type="text" data-toggle="tooltip" data-placement="right" class="form-control" value="<?php echo $username;?>" name="username" minlength="8" placeholder="Username" title="Must match with the username that already signup" required>
				</div>
				<br><br>
				<!--Email-->
				<div class="form-group">
					<label style="padding-left: 164px">Email:</label>
					<input style="width:300px" type="email" data-toggle="tooltip" data-placement="right" class="form-control" value="<?php echo $email;?>" name="email" placeholder="example@email.com" title="Must match with the email that already signup" required>
				</div>
				<br><br>
				<div class="form-group" style="padding-top:20px">
					<button class="form-control" value="action" name="action" type="submit" class="btn btn-lg btn-primary btn-block" style="margin-left: 300px"><i class="icon-signal icon-large"></i>&nbsp;Confirm</button>
				</div>
			</form>
		</div>
	</div>
	<?php
		include("footer.php");
	?>
</body>
</html>

<?php
	require "db_conn.php";
	if(isset($_POST['action'])){
		$username = $_POST['username'];
		$email = $_POST['email'];
		$sql = "SELECT * FROM user WHERE username = '$username' AND email = '$email'";
		$que = mysqli_query($conn, $sql) or die(mysqli_error($conn));
		$count = mysqli_num_rows($que);
		if($count == 1){
			$data = mysqli_fetch_assoc($que);
			$_SESSION['user']=$data['username'];
			$_SESSION['email']=$data['email'];
			$_SESSION['squestion']=$data['security_question'];
			$_SESSION['sanswer']=$data['security_answer'];
			echo "<script>location.href='forgotPasswordAdvanced.php';</script>";
		}else{
			echo "<script>alert('The Username and Email do not match!');</script>";
		}
	}
?>
