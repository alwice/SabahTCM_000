<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" conetent="text/html; charset=UTF-8">
	<?php
		$_SESSION['pages']="forgotPasswordShow.php";
		include ("menu.php");
	?>
	<title>忘记密码 - SabahTCM</title>
</head>
<body>
	<br>
	<div style="background:lightblue" class="alert alert-info">忘记密码</div>
		
	<?php
		$username=$_SESSION['user'];
		$password=$_SESSION['pw'];
	?>
	</br>

	<div id="body">
		</br>
		<div class="sidebar">	 
			<p><a href="login.php" class="btn btn-info"><i class="icon-arrow-left icon-large"></i>&nbsp;回去</a></p>
		</div>
		<div id="home" style="width:700px">
			<div id="hd">您的密码</div>
			</br></br>
			<form class="form-inline" method="POST" action="login.php" enctype="multipart/form-data">
				<!--Username-->
				<div class="form-group">
					<label style="padding-left: 125px">用户名：</label>
					<input style="width:300px" type="text" data-toggle="tooltip" data-placement="right" class="form-control" value="<?php echo $username;?>" name="username" minlength="8" placeholder="Username" title="Must contain at least 8 characters" disabled>
				</div>
				<br><br>
				<!--Password-->
				<div class="form-group">
					<label style="padding-left: 141px">密码：</label>
					<input style="width:300px" type="text" data-toggle="tooltip" data-placement="right" class="form-control" value="<?php echo $password;?>" name="password"  placeholder="Pa55w0rd" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 characters" disabled>
				</div>
				<br><br>
				<div class="form-group" style="padding-top:20px">
					<button class="form-control" value="action" name="action" type="submit" class="btn btn-lg btn-primary btn-block" style="margin-left: 300px"><i class="icon-user icon-large"></i>&nbsp;登入</button>
				</div>
			</form>
		</div>	
	</div>			
	<?php
		include("footer.php");
	?>
</body>
</html>