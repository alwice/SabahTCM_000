<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" conetent="text/html; charset=UTF-8">
	<?php
		$_SESSION['pages']="add_topic.php";
		$page_title="forum";
		include("menu.php");
	?>
	<title>Add Topic - SabahTCM</title>
</head>
<body>
	<div id="breadcrumb">
		<a class="btn btn-home" href="index.php"><i class="icon-home icon-large"></i>&nbsp;Home</a>&nbsp;&nbsp;>
		<a class="btn btn-home" href="forum.php"><i class="icon-question icon-large"></i>&nbsp;Forum</a>&nbsp;&nbsp;>
		<?php 
			if($_SESSION['category']=="Question"){
		?>
				<a class="btn btn-home" href="topic.php?category=Question"><i class="icon-question icon-large"></i>&nbsp;Question</a>&nbsp;&nbsp;>
				<a class="btn btn-home" href="add_topic.php"><i class="icon-question icon-large"></i>&nbsp;Add Question</a>&nbsp;&nbsp;
		<?php
			}/*end breadcrumb Question*/
			elseif($_SESSION['category']=="Opinion and Suggestion"){
		?>
				<a class="btn btn-home" href="topic.php?category=Opinion and Suggestion"><i class="icon-question icon-large"></i>&nbsp;Opinion and Suggestion</a>&nbsp;&nbsp;>
				<a class="btn btn-home" href="add_topic.php"><i class="icon-question icon-large"></i>&nbsp;Add Topic</a>&nbsp;&nbsp;
		<?php
			}/*end breadcrumb Opinion and Suggestion*/
		?>
	</div>
	</br>
	<div id="body">
        <div style="background:lightblue" class="alert alert-info">Add Topic</div>
		</br>	 
		<div class="sidebar">	 
			<p><a href="topic.php?category=<?php echo $_SESSION['category'];?>" class="btn btn-info"><i class="icon-arrow-left icon-large"></i>&nbsp;Back</a></p>
		</div>
	
		<div id="home" style="width:600px">
			<div id="hd">Please Insert Details Below</div>	
			<form class="form-inline" method="POST" action="" enctype="multipart/form-data">
				<br><br>
				<input type="hidden" name="user_id" value="<?php echo $_SESSION['userID']; ?>">	
				<input type="hidden" name="category" value="<?php echo $_SESSION['category']; ?>">
				<!--Topic-->
				<div class="form-group">
					<label style="padding-left: 93px">Topic:</label>
					<input style="width:350px" type="text" class="form-control" name="topic"  placeholder="Main Topic" required/>
				</div>
				<br><br>
				<!--Topic Describtion-->
				<div class="form-group">
					<label  style="padding-left: 80px">Details:</label>
					<textarea style="width:350px; height:160px" type="text-box" class="form-control" name="topic_details" placeholder="Details of Topic" required ></textarea>
				</div>
				<br><br>
				
				<div class="control-group">
					<div class="controls" style="padding-left: 250px" >
					<button name="submit" type="submit" class="btn btn-save"><i class="icon-save icon-large"></i>&nbsp;Save</button>
					</div>
				</div>
		    </form>					
		</div>	
		</br>	
    </div>
    </br></br>
    <?php 
    	if(isset($_POST['submit'])){
    		$user_id=$_POST['user_id'];
			$category=$_POST['category'];
			$topic=$_POST['topic'];
			$topic_details=$_POST['topic_details'];
			date_default_timezone_set('Asia/Kuala_Lumpur');
			$datetime=date("Y/m/d H:i:s");
						
			//Writes the information to the database
			$sql="INSERT INTO topic (topic, topic_details, user_id, category, time_topic)
				VALUES ('$topic','$topic_details','$user_id','$category','$datetime')";		
			mysqli_query($conn,$sql)or die(mysqli_error($conn));
			 
			echo "<script>alert('Information Saved Successful.');</script>";
			if($category=="Question"){
				echo "<script>location.href='topic.php?category=Question';</script>";
			}
			elseif($category=="Opinion and Suggestion"){
				echo "<script>location.href='topic.php?category=Opinion and Suggestion';</script>";
			}
    	}
	?>	
	<?php
		include ("footer.php");
	?>
</body>
</html>