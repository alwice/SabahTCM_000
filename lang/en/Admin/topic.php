<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" conetent="text/html; charset=UTF-8">
	<?php
		$_SESSION['category']=$_GET['category'];

		if($_GET['category']=="Question"){
			$_SESSION['category_cn']="问题";
	?>
			<title>Question - SabahTCM</title>
	<?php
		}/*end title Question*/
		elseif($_GET['category']=="Opinion and Suggestion"){
			$_SESSION['category_cn']="意见和建议";
	?>
			<title>Opinion and Suggestion - SabahTCM</title>
	<?php
		}/*end title Opinion and Suggestion*/
	
		$cat=$_SESSION['category_cn'];
		$_SESSION['pages']="topic.php?category=$cat";
		$page_title="forum";
		include("menu.php");
	?>
</head>

<body>
	<div id="breadcrumb">
		<a class="btn btn-home" href="index.php"><i class="icon-home icon-large"></i>&nbsp;Home</a>&nbsp;&nbsp;>
		<a class="btn btn-home" href="forum.php"><i class="icon-question icon-large"></i>&nbsp;Forum</a>&nbsp;&nbsp;>
		<?php 
			if($_GET['category']=="Question"){
		?>
			<a class="btn btn-home" href="topic.php?category=Question"><i class="icon-question icon-large"></i>&nbsp;Question</a>&nbsp;&nbsp;
		<?php
			}/*end breadcrumb Question*/
			elseif($_GET['category']=="Opinion and Suggestion"){
		?>
				<a class="btn btn-home" href="topic.php?category=Opinion and Suggestion"><i class="icon-question icon-large"></i>&nbsp;Opinion and Suggestion</a>&nbsp;&nbsp;
		<?php
			}/*end breadcrumb Opinion and Suggestion*/
		?>	
	</div>
	<div>
		<form style="text-align: right;" class="form-inline" action="search_forum.php" method="post">
			<div class="form-group">
				<input style="width:300px" type="text" data-toggle="tooltip" data-placement="right" class="form-control" name="search_topic" placeholder="Search Topic" title="Search Related Topic">
				<button style="background-color:skyblue;" class="form-control" type="submit" name="submit" value="submit"><i style="color:white;" class="icon-search icon-large"></i></button>
			</div>
		</form>
	</div>

	<div id="body">	
		<div class="sidebar">	 
			<p><a href="forum.php" class="btn btn-info"><i class="icon-arrow-left icon-large"></i>&nbsp;Back</a></p>
		</div>

		<?php 
			if($_GET['category']=="Question"){
		?>
				<div class="content" style="background:none; margin-right">
					<a class="btn btn-info pull-right"  href="add_topic.php" ><i class="icon-plus icon-large"></i>&nbsp;Add Question</a>
					</br>
					</br>
				</div>
		<?php
			}/*end add topic Question*/
			elseif($_GET['category']=="Opinion and Suggestion"){
		?>
				<div class="content" style="background:none; margin-right">
					<a class="btn btn-info pull-right"  href="add_topic.php" ><i class="icon-plus icon-large"></i>&nbsp;Add Topic</a>
					</br>
					</br>
				</div>
		<?php
			}/*end add topic Opinion and Suggestion*/
		?>
		</br>
	
		<div class="content" style="margin-right: 15%">
			<?php 
				$category=$_GET['category'];
				$_SESSION['category']=$category;
				$topic_query=mysqli_query($conn,"SELECT * FROM topic WHERE category='$category' AND isReview=1 ORDER BY latest_reply_time DESC")or die(mysqli_error($conn));
			?>
				<table id="forum" width="95%" border="1" align="center" cellpadding="3" cellspacing="1">
					<thead style="background-color: #E6E6E6"><tr>
						<th width="50%" style="text-align: center;" onclick="sortTable(0)"><strong>Topic</strong></th>
						<th width="5%" style="text-align: center;"><strong>Replies</strong></th>
						<th width="20%" colspan="2" style="text-align: center;" onclick="sortTable(3)"><strong>Created By</strong></th>
						<th width="20%" colspan="2" style="text-align: center;" onclick="sortTable(5)"><strong>Last Replied By</strong></th>	
					</tr></thead><tbody>
			<?php
					while($rows=mysqli_fetch_array($topic_query)){
						$topic_id=$rows['topic_id'];
						$topic=$rows['topic'];
						$reply=$rows['reply'];
						$topic_user_id=$rows['user_id'];
						$topic_time=$rows['time_topic'];
						//catch question user
						$topic_user_show=mysqli_query($conn,"SELECT username FROM user WHERE user_id='$topic_user_id'")or die(mysqli_error($conn));
						while($catch1=mysqli_fetch_assoc($topic_user_show)){
							$topic_user=$catch1['username'];
						}
						//catch latest reply
						$comment_show=mysqli_query($conn,"SELECT MAX(time_comment), user_id FROM comment WHERE topic_id='$topic_id' ")or die(mysqli_error($conn));
						while($catch2=mysqli_fetch_assoc($comment_show)){
							$comment_time=$catch2['MAX(time_comment)'];
							$comment_user_id=$catch2['user_id'];
						}
						//catch answer user
						if($comment_time==NULL){
							$comment_user="-";
						}
						else{
							$comment_user_show=mysqli_query($conn,"SELECT username FROM user WHERE user_id='$comment_user_id' ")or die(mysqli_error($conn));
							while($catch3=mysqli_fetch_assoc($comment_user_show)){
								$comment_user=$catch3['username'];
							}
						}
			?>
						<tr style="background-color: #FFFFFF">
							<td>&nbsp;&nbsp;<?php echo $topic;?>&nbsp;&nbsp;<a href="topic_view.php?id=<?php echo $topic_id;?>"><i class="icon-signin icon-large"></i></a><BR></td>
							<td align="center"><?php echo $reply; ?></td>
							<td width="10%" align="center"><?php echo $topic_user;?></td>
							<td width="10%" align="center"><?php echo $topic_time;?></td>
							<td width="10%" align="center"><?php echo $comment_user;?></td>
							<td width="10%" align="center"><?php echo $comment_time;?></td>
						</tr>
			<?php
					}/*end while list*/
					mysqli_close($conn);
			?>
					</tbody><tfoot style="background-color: #E6E6E6"><tr>
						<td colspan="6">&nbsp;</td>
					</tr></tfoot>
				</table>
				</br></br>
		</div>
	</div>
	<?php
		include ("footer.php");
	?>
</body>
</html>