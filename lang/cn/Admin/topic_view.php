<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" conetent="text/html; charset=UTF-8">
	<?php
		$_SESSION['topic_id']=$_GET['id'];
		$id=$_SESSION['topic_id'];
		$_SESSION['pages']="topic_view.php?id=$id";
		$page_title="forum";
		include("menu.php");
		$catch_topic=mysqli_query($conn,"SELECT topic FROM topic WHERE topic_id='$id'")or die(mysqli_error($conn));
		while($catch=mysqli_fetch_assoc($catch_topic)){
			$topic=$catch['topic'];
		}
	
		if($_SESSION['category_cn']=="问题"){
	?>
			<title>问题 - SabahTCM</title>
	<?php
		}/*end title 问题*/
		elseif($_SESSION['category_cn']=="意见和建议"){
	?>
			<title>意见和建议 - SabahTCM</title>
	<?php
		}/*end title 意见和建议*/
	?>
</head>
<body>
	<div id="breadcrumb">
		<a class="btn btn-home" href="index.php"><i class="icon-home icon-large"></i>&nbsp;首页</a>&nbsp;&nbsp;>
		<a class="btn btn-home" href="forum.php"><i class="icon-question icon-large"></i>&nbsp;论坛</a>&nbsp;&nbsp;>
		<?php 
			if($_SESSION['category_cn']=="问题"){
		?>
				<a class="btn btn-home" href="topic.php?category=问题"><i class="icon-question icon-large"></i>&nbsp;问题</a>&nbsp;&nbsp;>
		<?php
			}/*end breadcrumb 问题*/
			elseif($_SESSION['category_cn']=="意见和建议"){
		?>
				<a class="btn btn-home" href="topic.php?category=意见和建议"><i class="icon-question icon-large"></i>&nbsp;意见和建议</a>&nbsp;&nbsp;>
		<?php
			}/*end breadcrumb 意见和建议*/
		?>
		<a class="btn btn-home" href="topic_view.php?id=<?php echo $id;?>"><i class="icon-question icon-large"></i>&nbsp;<?php echo $topic;?></a>&nbsp;&nbsp;
	</div>
	<div>
		<form style="text-align: right;" class="form-inline" action="search_forum.php" method="post">
			<div class="form-group">
				<input style="width:300px" type="text" data-toggle="tooltip" data-placement="right" class="form-control" name="search_topic" placeholder="搜索课题" title="搜索有关课题">
				<button style="background-color:skyblue;" class="form-control" type="submit" name="submit" value="submit"><i style="color:white;" class="icon-search icon-large"></i></button>
			</div>
		</form>
	</div>
	</br>

	<div id="body">
		<div class="sidebar">	 
			<p><a href="topic.php?category=<?php echo $_SESSION['category_cn'];?>" class="btn btn-info"><i class="icon-arrow-left icon-large"></i>&nbsp;回去</a>
				<a class="pull-right btn btn-danger" style="color:white" href="delete_topic.php?id=<?php echo $id;?>"><i class="icon-trash icon-large"></i>&nbsp;删除</a></p>
		</div>
		<div class="content" style="margin-right: 15%">
			<?php
				//topic part
				$topic_show=mysqli_query($conn,"SELECT * FROM topic WHERE topic_id='$id'")or die(mysqli_error($conn));	
				while($data=mysqli_fetch_array($topic_show)){
					$topic_id=$data['topic_id'];
					$topic=$data['topic'];
					$topic_user_id=$data['user_id'];
					$topic_details=$data['topic_details'];
					$topic_time=$data['time_topic'];

					$topic_user_show=mysqli_query($conn,"SELECT username FROM user WHERE user_id='$topic_user_id'")or die(mysqli_error($conn));
					while($catch1=mysqli_fetch_assoc($topic_user_show)){
						$topic_user=$catch1['username'];
					}
				}
			?>
			<table width="50%" border="1" align="center" cellpadding="0" cellspacing="1"><tr><td>
				<table width="100%" border="1" bordercolor="#FFFFFF" cellpadding="3" cellspacing="1" bordercolor="1" style="background-color: #F8F7F1">
					<col width='80'>
					<tr>
						<td colspan=3><strong><?php echo $topic;?></strong></td>
					</tr>
					<tr>
						<td colspan=3><?php echo $topic_details;?></td>
					</tr>
					<tr>
						<td><strong>创建者</strong></td>
						<td>:</td>
						<td><?php echo $topic_user;?></td>
					</tr>
					<tr>
						<td><strong>日期、时间</strong></td>
						<td>:</td>
						<td><?php echo $topic_time;?></td>
					</tr>
				</table>
			</td></tr></table>
			<hr>
			<?php
				//comment part
				$comment_show=mysqli_query($conn,"SELECT * FROM comment WHERE topic_id='$id' AND isReview=1")or die(mysqli_error($conn));
				while($data1=mysqli_fetch_array($comment_show)){
					$comment_id=$data1['comment_id'];
					$comment_user_id=$data1['user_id'];
					$comment=$data1['comment'];
					$comment_time=$data1['time_comment'];
					$comment_user_show=mysqli_query($conn,"SELECT username FROM user WHERE user_id='$comment_user_id' ")or die(mysqli_error($conn));
					while($catch2=mysqli_fetch_assoc($comment_user_show)){
						$comment_user=$catch2['username'];
					}
			?>
					<table width="50%" border="1" align="center" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC"><tr><td>
						<table width="100%" border="1" cellpadding="3" bordercolor="#FFFFFF" cellspacing="1" style="background-color: #F8F7F1">
							<tr><col width='80'>
								<td><strong>回复</strong></td>
								<td>:</td>
								<td><?php echo $comment;?></td>
							</tr>
							<tr>
								<td><strong>回应者</strong></td>
								<td>:</td>
								<td><?php echo $comment_user; ?></td>
							</tr>
							<tr>
								<td><strong>日期、时间</strong></td>
								<td>:</td>
								<td><?php echo $comment_time;?></td>
							</tr>
						</table>
					</td></tr></table>
			<?php
				}/*end while show answer*/
				mysqli_close($conn);
			?>
			<?php 
					if($_SESSION['category_cn']=="问题"){
			?>
					<div class="content" style="background:none; margin-right">
						<a class="btn btn-info pull-right" href="add_comment.php?id=<?php echo $id;?>"><i class="icon-plus icon-large"></i>&nbsp;回答</a>
					</div>
			<?php
				}/*end add topic 问题*/
				else if($_SESSION['category_cn']=="意见和建议"){
			?>
					<div class="content" style="background:none; margin-right">
						<a class="btn btn-info pull-right" href="add_comment.php?id=<?php echo $id;?>" ><i class="icon-plus icon-large"></i>&nbsp;发表评论</a>
					</div>
			<?php
				}/*end add topic 意见和建议*/
			?>
		</div>
		</br>
	</div>
	<?php
		include ("footer.php");
	?>
</body>
</html>