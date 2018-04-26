<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" conetent="text/html; charset=UTF-8">
	<?php
		$_SESSION['pages']="add_comment.php";
		$id=$_SESSION['topic_id'];
		$page_title="forum";
		include("menu.php");
		$catch_topic=mysqli_query($conn,"SELECT topic FROM topic WHERE topic_id='$id'")or die(mysqli_error($conn));
		while($catch=mysqli_fetch_assoc($catch_topic)){
			$topic=$catch['topic'];
		}
	?>
	<title>Add Comment - SabahTCM</title>
</head>
<body>
	<div id="breadcrumb">
		<a class="btn btn-home" href="index.php"><i class="icon-home icon-large"></i>&nbsp;Home</a>&nbsp;&nbsp;>
		<a class="btn btn-home" href="forum.php"><i class="icon-question icon-large"></i>&nbsp;Forum</a>&nbsp;&nbsp;>
		<?php 
			if($_SESSION['category']=="Question"){
		?>
				<a class="btn btn-home" href="topic.php?category=Question"><i class="icon-question icon-large"></i>&nbsp;Question</a>&nbsp;&nbsp;>
				<a class="btn btn-home" href="topic_view.php?id=<?php echo $id;?>"><i class="icon-question icon-large"></i>&nbsp;<?php echo $topic;?></a>&nbsp;&nbsp;>
				<a class="btn btn-home" href="add_comment.php?id=<?php echo $id;?>"><i class="icon-question icon-large"></i>&nbsp;Add Answer</a>&nbsp;&nbsp;
		<?php
			}/*end breadcrumb Question*/
			elseif($_SESSION['category']=="Opinion and Suggestion"){
		?>
				<a class="btn btn-home" href="topic.php?category=Opinion and Suggestion"><i class="icon-question icon-large"></i>&nbsp;Opinion and Suggestion</a>&nbsp;&nbsp;>
				<a class="btn btn-home" href="topic_view.php?id=<?php echo $id;?>"><i class="icon-question icon-large"></i>&nbsp;<?php echo $topic;?></a>&nbsp;&nbsp;>
				<a class="btn btn-home" href="add_comment.php?id=<?php echo $id;?>"><i class="icon-question icon-large"></i>&nbsp;Add Comment</a>&nbsp;&nbsp;
		<?php
			}/*end breadcrumb Opinion and Suggestion*/
		?>
	</div>
	</br>

	<div id="body">
        <div style="background:lightblue" class="alert alert-info">Add Comment</div>
		</br>	 
		<div class="sidebar">	 
			<p><a href="topic_view.php?id=<?php echo $id;?>" class="btn btn-info"><i class="icon-arrow-left icon-large"></i>&nbsp;Back</a></p>
		</div>
	
		<div id="home" style="width:600px">
			<div id="hd">Please Insert Details Below</div>
			<form class="form-inline" method="POST" action="" enctype="multipart/form-data">
				<br><br>
				<input type="hidden" name="user_id" value="<?php echo $_SESSION['userID'];?>">	
				<input type="hidden" name="category" value="<?php echo $_SESSION['category'];?>">
				<input type="hidden" name="topic_id" value="<?php echo $id;?>">
				<!--Comment-->
				<div class="form-group">
					<label  style="padding-left: 80px">Comment:</label>
					<textarea style="width:350px; height:160px" type="text-box" class="form-control" name="comment" placeholder="Comment" required ></textarea>
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
    		$topic_id=$_POST['topic_id'];
    		$user_id=$_POST['user_id'];
			$category=$_POST['category'];
			$comment=$_POST['comment'];
			date_default_timezone_set('Asia/Kuala_Lumpur');
			$datetime=date("Y/m/d H:i:s");

			//calculate reply
			$result=mysqli_query($conn,"SELECT count(comment_id) AS reply FROM comment WHERE topic_id='$topic_id'")or die(mysqli_error($conn));
			while($rows=mysqli_fetch_assoc($result)){
				$reply=$rows['reply'];
			}
			// add + 1 to reply number 
				$reply = $reply+1;			
									
			//Writes the information to the database
			$sql="INSERT INTO comment (topic_id, comment, user_id, category, time_comment)
				VALUES ('$topic_id','$comment','$user_id','$category','$datetime')";		
			mysqli_query($conn,$sql)or die(mysqli_error($conn));
			 
			$sql3="UPDATE topic SET reply='$reply' WHERE topic_id='$topic_id'";
			$result3=mysqli_query($conn,$sql3)or die(mysqli_error($conn));
			 
			echo "<script>alert('Information Saved Successful.');</script>";
			echo "<script>location.href='topic_view.php?id=".$topic_id."';</script>";
    	}
	?>	
	<?php
		include ("footer.php");
	?>
</body>
</html>