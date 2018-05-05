<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" conetent="text/html; charset=UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php
		$_SESSION['pages']="add_topic.php";
		$page_title="forum";
		include("menu.php");
	?>
	<title>发表课题 - SabahTCM</title>
</head>
<body>
	<div id="breadcrumb">
		<a href="index.php"><i class="icon-home icon-large"></i>&nbsp;首页</a>&nbsp;&nbsp;>
		<a href="forum.php"><i class="icon-question icon-large"></i>&nbsp;论坛</a>&nbsp;&nbsp;>
		<?php 
			if($_SESSION['category_cn']=="问题"){
		?>
				<a href="topic.php?category=问题"><i class="icon-question icon-large"></i>&nbsp;问题</a>&nbsp;&nbsp;>
				<a href="add_topic.php"><i class="icon-question icon-large"></i>&nbsp;提问</a>&nbsp;&nbsp;
		<?php
			}/*end breadcrumb 问题*/
			elseif($_SESSION['category_cn']=="意见和建议"){
		?>
				<a href="topic.php?category=意见和建议"><i class="icon-question icon-large"></i>&nbsp;意见和建议</a>&nbsp;&nbsp;>
				<a href="add_topic.php"><i class="icon-question icon-large"></i>&nbsp;发表话题</a>&nbsp;&nbsp;
		<?php
			}/*end breadcrumb 意见和建议*/
		?>
	</div>
	
	<div id="body">
        <div style="background:lightblue" class="alert alert-info">发表课题</div>
		</br>	 
		<div class="sidebar">	 
			<p><a href="topic.php?category=<?php echo $_SESSION['category_cn'];?>" class="btn btn-info"><i class="icon-arrow-left icon-large"></i>&nbsp;回去</a></p>
		</div>
	
		<div id="small_window">
			<div id="hd">请填以下详情</div>		
			
			</br><span class="form_break"></br></span>
			<form id="topic" class="form-inline" method="POST" action="" enctype="multipart/form-data">
				<input type="hidden" name="user_id" value="<?php echo $_SESSION['userID']; ?>">	
				<input type="hidden" name="category" value="<?php echo $_SESSION['category']; ?>">
				<!--Topic-->
				<div class="form-group">
					<label>课题：</label>
					<input type="text" class="form-control" name="topic" placeholder="主题" required/>
				</div>
				</br><span class="form_break"></br></span>
				<!--Topic Describtion-->
				<div class="form-group">
					<label>详情：</label>
					<textarea type="text-box" class="form-control" name="topic_details" placeholder="课题详细内容" required/></textarea>
				</div>
				</br><span class="form_break"></br></span>
				<p>课题只有在被管理员审核后才会呈现在论坛里。</p>
				</br>
				<!--submit button-->
				<div class="controls">
					<button name="submit" type="submit" class="btn btn-save"><i class="icon-save icon-large"></i>&nbsp;存档</button>
				</div>
		    </form>					
		</div>		
    </div>
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
			 
			echo "<script>alert('资料储存成功。');</script>";
			if($_SESSION['category_cn']=="问题"){
				echo "<script>location.href='topic.php?category=问题';</script>";
			}
			elseif($_SESSION['category_cn']=="意见和建议"){
				echo "<script>location.href='topic.php?category=意见和建议';</script>";
			}
    	}
	?>	
	<?php
		include ("footer.php");
	?>
</body>
</html>