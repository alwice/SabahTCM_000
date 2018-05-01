<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" conetent="text/html; charset=UTF-8">
	<?php
		$_SESSION['pages']="forgotPasswordAdvanced.php";
		include ("menu.php");
	?>
	<title>忘记密码 - SabahTCM</title>
</head>
<body>
	<div id="body">
		<br>
		<div style="background:lightblue" class="alert alert-info">忘记密码</div>
		<?php
			$username=$_SESSION['user'];
			$email=$_SESSION['email'];
			$squestion=$_SESSION['squestion'];
			$sanswer=$_SESSION['sanswer'];
		?>
		</br>
		<div class="sidebar">	 
			<p><a href="forgotPassword.php" class="btn btn-info"><i class="icon-arrow-left icon-large"></i>&nbsp;回去</a></p>
		</div>
		<div id="home" style="width:700px">
			<div id="hd">请填以下资料</div>
			</br></br>
			<form class="form-inline" method="POST" action="" enctype="multipart/form-data">
				<!--Username-->
				<div class="form-group">
					<label style="padding-left: 125px">用户名：</label>
					<input style="width:300px" type="text" data-toggle="tooltip" data-placement="right" class="form-control" value="<?php echo $username;?>" name="username" minlength="8" placeholder="Username" title="Must match with the username that already signup" disabled>
				</div>
				<br><br>
				<!--Email-->
				<div class="form-group">
					<label style="padding-left: 141px">电邮：</label>
					<input style="width:300px" type="email" data-toggle="tooltip" data-placement="right" class="form-control" value="<?php echo $email;?>" name="email" placeholder="example@email.com" title="Must match with the email that already signup" disabled>
				</div>
				<br><br>
				<!--Security Question-->
				<div class="form-group">
					<label style="padding-left: 110px">安全问题：</label>
					<input style="width:60%" type="text" data-toggle="tooltip" data-placement="right" class="form-control" value="<?php echo $squestion;?>" name="squestion" placeholder="example@email.com" disabled>
				</div>
				<br><br>

				<!--Security Answer-->
				<div class="form-group">
					<label style="padding-left: 110px">安全答案：</label>
					<input style="width:300px" type="text" data-toggle="tooltip" data-placement="right" class="form-control" name="sanswer" placeholder="answer" required>
				</div>

				<div class="form-group" style="padding-top:20px">
					<button class="form-control" value="action" name="action" type="submit" class="btn btn-lg btn-primary btn-block" style="margin-left: 300px"><i class="icon-signal icon-large"></i>&nbsp;确认</button>
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
		$username=$_SESSION['user'];
		$sanswer=$_POST['sanswer'];
		$sql = "SELECT * FROM user WHERE username = '$username' AND security_answer = '$sanswer'";
		$que = mysqli_query($conn, $sql) or die(mysqli_error($conn));
		$count = mysqli_num_rows($que);
		if($count == 1){
			$data = mysqli_fetch_assoc($que);
			$_SESSION['pw']=$data['password'];
			echo "<script>location.href='forgotPasswordShow.php';</script>";
		}else{
			echo "<script>alert('安全答案错误！');</script>";
		}
	}
?>
