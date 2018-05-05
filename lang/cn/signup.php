<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" conetent="text/html; charset=UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php
		$_SESSION['pages']="signup.php";
		include ("menu.php");
	?>
	<title>注册 - SabahTCM</title>
</head>
<body>
	<?php
		$username=isset($_POST['username']) ? $_POST['username'] : NULL;
		$email=isset($_POST['email']) ? $_POST['email'] : NULL;
		$squestion=isset($_POST['squestion']) ? $_POST['squestion'] : NULL;
		$sanswer=isset($_POST['sanswer']) ? $_POST['sanswer'] : NULL;
	?>
	
	<div id="body">
		</br><span class="nav_break"></br></br></br></br></br></span>
		<div class="sidebar">	 
			<p><a href="login.php" class="btn btn-info"><i class="icon-arrow-left icon-large"></i>&nbsp;回去</a></p>
		</div>
		<div id="small_window">
			<div id="hd">请填以下资料</div>
			</br><span class="form_break"></br></span>
			<form id="signup" class="form-inline" method="POST" action="" enctype="multipart/form-data">
				<!--Username-->
				<div class="form-group">
					<label>用户名：</label>
					<input type="text" data-toggle="tooltip" data-placement="right" class="form-control" value="<?php echo $username;?>" name="username" minlength="8" placeholder="用户名" title="最少8个字" required>
				</div>
				</br><span class="form_break"></br></span>

				<!--Password-->
				<div class="form-group">
					<label>密码：</label>
					<input type="password" data-toggle="tooltip" data-placement="right" class="form-control" value="" name="password"  placeholder="Pa55w0rd" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="至少一个数字，一个大字母，一个小字母，以及最少八个字" required>
				</div>
				</br><span class="form_break"></br></span>

				<!--Password-->
				<div class="form-group">
					<label>确认密码：</label>
					<input type="password" data-toggle="tooltip" data-placement="right" class="form-control" value="" name="cpassword" minlength="8" placeholder="Pa55w0rd" title="必须和密码相符" required>
				</div>
				</br><span class="form_break"></br></span>

				<!--Email-->
				<div class="form-group">
					<label>电邮：</label>
					<input type="email" data-toggle="tooltip" data-placement="right" class="form-control" value="<?php echo $email;?>" name="email" placeholder="example@email.com" title="必须是符合的电邮" required>
				</div>
				</br><span class="form_break"></br></span>

				<!--Security Question-->
				<div class="form-group">
					<label>安全问题：</label>
					<?php include "list_squestion.php";?>
				</div>
				</br><span class="form_break"></br></span>

				<!--Security Answer-->
				<div class="form-group">
					<label>安全答案：</label>
					<input type="text" data-toggle="tooltip" data-placement="right" class="form-control" value="<?php echo $sanswer;?>" name="sanswer" placeholder="答案" titile="别让他人知道您的答案" required>
				</div>
				</br><span class="form_break"></br></span>

				<!--submit button-->
				<div class="form-group" style="padding-top:2%">
					<button class="form-control" value="action" name="action" type="submit"><i class="icon-save icon-large"></i>&nbsp;提交</button>
				</div>
			</form>
			
			<?php
				$action = isset($_POST['action']) ? $_POST['action'] : NULL;
				//save to db
				if($action!=NULL){
					$username = $_POST["username"];
				    $password = $_POST["password"];
					$cpassword = $_POST["cpassword"];
					$email = $_POST['email'];
					$squestion = $_POST['squestion'];
					$sanswer = $_POST['sanswer'];

					//for checking the username if existed in db
					$user=mysqli_query($conn,"SELECT username FROM user WHERE username='$username'")or die(mysqli_error($conn));
					$un=mysqli_fetch_assoc($user);
					//checking the username if existed in db
					if($un!=NULL){
						$msg="用户名已存在！请用别的用户名。\\n";
					}
					//for checking the email if existed in db
					$mail=mysqli_query($conn,"SELECT email FROM user WHERE email='$email'")or die(mysqli_error($conn));
					$em=mysqli_fetch_assoc($mail);
					//checking the email if existed in db
					if($em!=NULL){
						$msg=$msg."电邮已注册！请登入或用别的电邮。\\n";
					}
					//checking password same
					if($password!=$cpassword){
						$msg=$msg."密码不一致！";
					}
					if($msg==NULL){
						$sql="INSERT INTO user (username, password, email, security_question, security_answer) 
							VALUES('$username', '$cpassword', '$email', '$squestion', '$sanswer')";
						mysqli_query($conn,$sql)or die(mysqli_error($conn));
						echo "<script>alert('注册成功！'); location.href='index.php';</script>";
					}
					else{
						echo "<script>alert('".$msg."');</script>";
					}/*end ifelse check password*/
				}
			?>
		</div>	
	</div>			
	<?php
		include("footer.php");
	?>
</body>
</html>