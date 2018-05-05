<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" conetent="text/html; charset=UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php
		$_SESSION['pages']="forgotPasswordShow.php";
		include ("menu.php");
	?>
	<title>忘记密码 - SabahTCM</title>
</head>
<body>
	<?php
		$username=$_SESSION['user'];
		$password=$_SESSION['pw'];
	?>
	</br>

	<div id="body">
		</br><span class="nav_break"></br></br></br></br></br></span>
		<div id="small_window">
			<div id="hd">您的密码</div>
			</br><span class="form_break"></br></span>
			<form id="login" class="form-inline" method="POST" action="login.php" enctype="multipart/form-data">
				<!--Username-->
				<div class="form-group">
					<label>用户名：</label>
					<input type="text" data-toggle="tooltip" data-placement="right" class="form-control" value="<?php echo $username;?>" name="username" minlength="8" disabled>
				</div>
				</br><span class="form_break"></br></span>

				<!--Password-->
				<div class="form-group">
					<label>密码：</label>
					<input type="text" data-toggle="tooltip" data-placement="right" class="form-control" value="<?php echo $password;?>" name="password"  placeholder="Pa55w0rd" disabled>
				</div>
				</br><span class="form_break"></br></span>

				<!--submit button-->
				<div class="form-group" style="padding-top:20px">
					<button class="form-control" value="action" name="action" type="submit"><i class="icon-user icon-large"></i>&nbsp;登入</button>
				</div>
			</form>
		</div>	
	</div>			
	<?php
		include("footer.php");
	?>
</body>
</html>