<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" conetent="text/html; charset=UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php 
		$_SESSION['pages']="login.php";
		include("menu.php");
	?>
	<title>Login - SabahTCM</title>
</head>
<body>
	<div id="body">
		</br><span class="nav_break"></br></br></br></br></br></span>
		<div class="sidebar">	 
			<p><a href="index.php" class="btn btn-info"><i class="icon-arrow-left icon-large"></i>&nbsp;Back</a></p>
		</div>
		<div id="small_window">
			<div id="hd">User Login</div>
			</br><span class="form_break"></br></span>
			<form id="login" class="form-inline" method="POST" enctype="multipart/form-data">

				<!--Username-->
				<div class="form-group">
					<label for="inputEmail">Username: </label>
					<input class="form-control" type="text" name="username" id="username" placeholder="Username" title="Fillin your username" required>
				</div>
				</br><span class="form_break"></br></span>

				<!--Password-->
				<div class="form-group">
					<label for="inputPassword">Password: </label>
					<input class="form-control" type="password" name="password" id="password" placeholder="Password" title="Fillin your password" required>
				</div>
				</br><span class="form_break"></br></span>

				<a href="forgotPassword.php" style="margin-left: 60%">Forgot Password</a>
				<a href="signup.php" style="margin-left: 60%">Sign Up</a>

				<!--submit button-->
				<div class="form-group" style="padding-top:2%">
					<button class="form-control" id="login" name="submit" type="submit"><i class="icon-signin icon-large"></i>&nbsp;Login</button>
				</div>
			</form>

				<?php
					if(isset($_POST['submit'])){
						$username = $_POST['username'];
						$password = $_POST['password'];
						$query = "SELECT * FROM user WHERE username='$username' AND password='$password'";
						$result = mysqli_query($conn,$query)or die(mysqli_error($conn));
						$num_row=mysqli_num_rows($result);
						$row=mysqli_fetch_array($result);
						if($num_row>0) {	
							$_SESSION['username']=$row['username'];
							$_SESSION['userID']=$row['user_id'];
							$_SESSION['isAdmin']=$row['isAdmin'];
							mysqli_close($conn);

							if($_SESSION['isAdmin']==1){
							$url='admin';
							echo '<META HTTP-EQUIV=REFRESH CONTENT="1; '.$url.'">';
							}
							else{
								$url='index.php';
								echo '<META HTTP-EQUIV=REFRESH CONTENT="1; '.$url.'">';
							}
						}
						else{ 
				?>
							<div style="background:#fcac99" class="form-group alert alert-danger">Access Denied</div>		
				<?php
						}/*end of else denied*/
					}/*end of if submit*/
				?>
			
		</div>
	</div>				
	<?php
		include("footer.php");
	?>
</body>
</html>