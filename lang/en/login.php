<!DOCTYPE html>
<html>
<head>
	<?php 
		$_SESSION['pages']="login.php";
		include("menu.php");
	?>
	<title>Login - SabahTCM</title>
</head>
<body>
	</br>
	<div id="body">
	</br>
		<div class="sidebar">	 
			<p><a href="index.php" class="btn btn-info"><i class="icon-arrow-left icon-large"></i>&nbsp;Back</a></p>
		</div>
		<div id="home" style="width:500px">
			<div>
				<div id="hd">
					<p>User Login</p>
				</div>
				<form class="form-inline" method="POST">
					<div class="form-group">
						<label style="padding: 45px 5px 10px 85px;" for="inputEmail">Username</label>
						<input class="form-control" type="text" name="username" id="username" placeholder="Username" required>
					</div>
					
					<div class="form-group">
						<label style="padding: 10px 9px 10px 85px;" for="inputPassword">Password</label>
						<input class="form-control" type="password" name="password" id="password" placeholder="Password" required>
					</div>
					</br>
					</br><a href="forgotPassword.php" style="margin-left: 300px">Forgot Password</a>
					<div class="form-group" style="padding-top:20px">
						<button class="form-control" id="login" name="submit" type="submit" class="btn" style="margin-left: 200px;"><i class="icon-signin icon-large"></i>&nbsp;Login</button>
					</div>
					
					<?php
						if(isset($_POST['submit'])){
							// session_start();
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
								$url='Admin';
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
				</form>
			</div>
		</div>
		</br></br>
	</div>				
	<?php
		include("footer.php");
	?>
</body>
</html>