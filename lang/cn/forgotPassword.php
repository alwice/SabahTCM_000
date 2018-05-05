<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" conetent="text/html; charset=UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php
		$_SESSION['pages']="forgotPassword.php";
		include ("menu.php");
	?>
	<title>忘记密码 - SabahTCM</title>
</head>
<body>
	<div id="body">
		<?php
			$username=isset($_POST['username']) ? $_POST['username'] : NULL;
			$email=isset($_POST['email']) ? $_POST['email'] : NULL;
		?>
		</br><span class="nav_break"></br></br></br></br></br></span>
		<div class="sidebar">	 
			<p><a href="login.php" class="btn btn-info"><i class="icon-arrow-left icon-large"></i>&nbsp;回去</a></p>
		</div>
		<div id="small_window">
			<div id="hd">请填以下资料</div>
			</br></br>
			<form id="login" class="form-inline" method="POST" action="" enctype="multipart/form-data">
				<!--Username-->
				<div class="form-group">
					<label>用户名：</label>
					<input type="text" data-toggle="tooltip" data-placement="right" class="form-control" value="<?php echo $username;?>" name="username" minlength="8" placeholder="Username" title="必须和已登记用户名配对" required>
				</div>
				</br><span class="form_break"></br></span>
				<!--Email-->
				<div class="form-group">
					<label>电邮：</label>
					<input type="email" data-toggle="tooltip" data-placement="right" class="form-control" value="<?php echo $email;?>" name="email" placeholder="example@email.com" title="必须和已登记电邮配对" required>
				</div>
				</br><span class="form_break"></br></span>
				<div class="form-group" style="padding-top:2%">
					<button class="form-control" value="action" name="action" type="submit"><i class="icon-signal icon-large"></i>&nbsp;确认</button>
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
			echo "<script>alert('用户名和电邮不配对！');</script>";
		}
	}
?>
