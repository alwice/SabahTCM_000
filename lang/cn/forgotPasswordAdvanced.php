<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" conetent="text/html; charset=UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php
		$_SESSION['pages']="forgotPasswordAdvanced.php";
		include ("menu.php");
	?>
	<title>忘记密码 - SabahTCM</title>
</head>
<body>
	<div id="body">
		<?php
			$username=$_SESSION['user'];
			$email=$_SESSION['email'];
			$squestion=$_SESSION['squestion'];
			$sanswer=$_SESSION['sanswer'];
		?>
		</br><span class="nav_break"></br></br></br></br></br></span>
		<div class="sidebar">	 
			<p><a href="forgotPassword.php" class="btn btn-info"><i class="icon-arrow-left icon-large"></i>&nbsp;回去</a></p>
		</div>
		<div id="small_window">
			<div id="hd">请填以下资料</div>
			</br><span class="form_break"></br></span>	
			<form id="signup" class="form-inline" method="POST" action="" enctype="multipart/form-data">
				<!--Username-->
				<div class="form-group">
					<label>用户名：</label>
					<input  type="text" data-toggle="tooltip" data-placement="right" class="form-control" value="<?php echo $username;?>" name="username" minlength="8" disabled>
				</div>
				</br><span class="form_break"></br></span>	
				
				<!--Email-->
				<div class="form-group">
					<label>电邮：</label>
					<input type="email" data-toggle="tooltip" data-placement="right" class="form-control" value="<?php echo $email;?>" name="email" disabled>
				</div>
				</br><span class="form_break"></br></span>	
			
				<!--Security Question-->
				<div class="form-group">
					<label>安全问题：</label>
					<input type="text" data-toggle="tooltip" data-placement="right" class="form-control" value="<?php echo $squestion;?>" name="squestion" title="向右拉看全题" disabled>
				</div>
				</br><span class="form_break"></br></span>	

				<!--Security Answer-->
				<div class="form-group">
					<label>安全答案：</label>
					<input type="text" data-toggle="tooltip" data-placement="right" class="form-control" name="sanswer" placeholder="答案" title="必须和已登记安全答案配对" required>
				</div>

				<!--submit button-->
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
