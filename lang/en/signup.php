<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" conetent="text/html; charset=UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php
		$_SESSION['pages']="signup.php";
		include ("menu.php");
	?>
	<title>SignUp - SabahTCM</title>
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
			<p><a href="login.php" class="btn btn-info"><i class="icon-arrow-left icon-large"></i>&nbsp;Back</a></p>
		</div>
		<div id="small_window">
			<div id="hd">Sign Up</div>
			</br><span class="form_break"></br></span>
			<form id="signup" class="form-inline" method="POST" action="" enctype="multipart/form-data">
				<!--Username-->
				<div class="form-group">
					<label>Username:</label>
					<input type="text" data-toggle="tooltip" data-placement="right" class="form-control" value="<?php echo $username;?>" name="username" minlength="8" placeholder="Username" title="Must contain at least 8 characters" required>
				</div>
				</br><span class="form_break"></br></span>
				
				<!--Password-->
				<div class="form-group">
					<label>Password:</label>
					<input type="password" data-toggle="tooltip" data-placement="right" class="form-control" value="" name="password"  placeholder="Pa55w0rd" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 characters" required>
				</div>
				</br><span class="form_break"></br></span>
				
				<!--Password-->
				<div class="form-group">
					<label>Reenter Password:</label>
					<input type="password" data-toggle="tooltip" data-placement="right" class="form-control" value="" name="cpassword" minlength="8" placeholder="Pa55w0rd" title="Must match with Password" required>
				</div>
				</br><span class="form_break"></br></span>
				
				<!--Email-->
				<div class="form-group">
					<label>Email:</label>
					<input type="email" data-toggle="tooltip" data-placement="right" class="form-control" value="<?php echo $email;?>" name="email" placeholder="example@email.com" title="Must valid email" required>
				</div>
				</br><span class="form_break"></br></span>
				
				<!--Security Question-->
				<div class="form-group">
					<label>Security Question:</label>
					<?php include "list_squestion.php";?>
				</div>
				</br><span class="form_break"></br></span>
				
				<!--Security Answer-->
				<div class="form-group">
					<label>Security Answer:</label>
					<input type="text" data-toggle="tooltip" data-placement="right" class="form-control" value="<?php echo $sanswer;?>" name="sanswer" placeholder="answer" title="Don't let other know your answer" required>
				</div>
				</br><span class="form_break"></br></span>
				
				<!--submit button-->
				<div class="form-group" style="padding-top:20px">
					<button class="form-control" value="action" name="action" type="submit"><i class="icon-save icon-large"></i>&nbsp;Submit</button>
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
						$msg="The Username was Existed! Please create Another Username.\\n";
					}
					//for checking the email if existed in db
					$mail=mysqli_query($conn,"SELECT email FROM user WHERE email='$email'")or die(mysqli_error($conn));
					$em=mysqli_fetch_assoc($mail);
					//checking the email if existed in db
					if($em!=NULL){
						$msg=$msg."The Email was Registered! Please proceed to Login or use Different Email.\\n";
					}
					//checking password same
					if($password!=$cpassword){
						$msg=$msg."The password are not match!";
					}
					if($msg==NULL){
						$sql="INSERT INTO user (username, password, email, security_question, security_answer) 
							VALUES('$username', '$cpassword', '$email', '$squestion', '$sanswer')";
						mysqli_query($conn,$sql)or die(mysqli_error($conn));
						echo "<script>alert('Sign Up Successful!!'); location.href='index.php';</script>";
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