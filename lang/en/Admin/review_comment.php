<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" conetent="text/html; charset=UTF-8">
	<?php
		$_SESSION['topic_id']=$_GET['id'];
		$id=$_SESSION['topic_id'];
		$_SESSION['pages']="review_comment.php?id=".$id;
		$page_title="forum";
		include("menu.php");
		$catch_topic=mysqli_query($conn,"SELECT topic FROM topic WHERE topic_id='$id'")or die(mysqli_error($conn));
		while($catch=mysqli_fetch_assoc($catch_topic)){
			$topic=$catch['topic'];
		}
	?>
	<title>Review Comment - SabahTCM</title>
</head>
<body>
	<div id="breadcrumb">
		<a class="btn btn-home" href="index.php"><i class="icon-home icon-large"></i>&nbsp;Home</a>&nbsp;&nbsp;>
		<a class="btn btn-home" href="forum.php"><i class="icon-question icon-large"></i>&nbsp;Forum</a>&nbsp;&nbsp;>
		<a class="btn btn-home" href="review_topic.php"><i class="icon-question icon-large"></i>&nbsp;Review Topic</a>&nbsp;&nbsp;>
		<a class="btn btn-home" href="review_comment.php?id=<?php echo $id;?>"><i class="icon-question icon-large"></i>&nbsp;<?php echo $topic;?></a>&nbsp;&nbsp;
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
			<p><a href="review_topic.php" class="btn btn-info"><i class="icon-arrow-left icon-large"></i>&nbsp;Back</a></p>
		</div>
		<div class="content" style="margin-right: 15%">
			<?php
				//topic part
				$question_show=mysqli_query($conn,"SELECT * FROM topic WHERE topic_id='$id'")or die(mysqli_error($conn));	
				while($data=mysqli_fetch_array($question_show)){
					$topic_id=$data['topic_id'];
					$topic=$data['topic'];
					$topic_user_id=$data['user_id'];
					$topic_details=$data['topic_details'];
					$topic_time=$data['time_topic'];
					$topic_review=$data['isReview'];

					$topic_user_show=mysqli_query($conn,"SELECT username FROM user WHERE user_id='$topic_user_id' ")or die(mysqli_error($conn));
					while($catch1=mysqli_fetch_assoc($topic_user_show)){
						$topic_user=$catch1['username'];
					}
				}
			?>
			<table width="50%" border="1" align="center" cellpadding="0" cellspacing="1" bg
			color="#CCCCCC"><tr><td>
				<table width="100%" border="1" bordercolor="#FFFFFF" cellpadding="3" cellspacing="1" bordercolor="1" style="background-color: #F8F7F1">
					<col width='80'>
					<tr>
						<td colspan=3><strong><?php echo $topic;?></strong></td>
					</tr>
					<tr>
						<td colspan=3><?php echo $topic_details;?></td>
					</tr>
					<tr>
						<td><strong>By</strong></td>
						<td>:</td>
						<td><?php echo $topic_user;?></td>
					</tr>
					<tr>
						<td><strong>Date/time</td>
						<td>:</td>
						<td></strong><?php echo $topic_time;?></td>
					</tr>
				</table>
				<?php 
					if($topic_review==0){
				?>
						<table width="100%" style="background-color: #F8F7F1"><tr>
							<td width="80%"><a class="btn btn-info pull-right" href="review_forum.php?tid=<?php echo $topic_id;?>&amp;mode=1"><i class="icon-ok icon-large"></i>&nbsp;Approve</a></td>
							<td width="20%"><a class="btn btn-info pull-right" href="review_forum.php?tid=<?php echo $topic_id;?>&amp;mode=2"><i class="icon-remove icon-large"></i>&nbsp;Reject</a></td>
						</tr></table>
				<?php 
					}
				?>
			</td></tr></table>
			<hr>
			<?php
				//comment part
				$comment_show=mysqli_query($conn,"SELECT * FROM comment WHERE topic_id='$id' and isReview=0")or die(mysqli_error($conn));
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
					<table width="50%" border="1" align="center" cellpadding="0" cellspacing="1" bgcolor="#F8F7F1"><tr><td>
						<table width="100%" border="1" cellpadding="3" bordercolor="#FFFFFF" cellspacing="1" style="background-color: #F8F7F1">
							<tr><col width='80'>
								<td><strong>Respond</strong></td>
								<td>:</td>
								<td><?php echo $comment;?></td>
							</tr>
							<tr>
								<td><strong>By</strong></td>
								<td>:</td>
								<td><?php echo $comment_user; ?></td>
							</tr>
							<tr>
								<td><strong>Date/Time</strong></td>
								<td>:</td>
								<td><?php echo $comment_time;?></td>
							</tr>
						</table>
						<table width="100%" style="background-color: #F8F7F1"><tr>
							<td width="80%"><a class="btn btn-info pull-right" href="review_forum.php?cid=<?php echo $comment_id;?>&amp;mode=1"><i class="icon-ok icon-large"></i>&nbsp;Approve</a></td>
							<td width="20%"><a class="btn btn-info pull-right" href="review_forum.php?cid=<?php echo $comment_id;?>&amp;mode=2"><i class="icon-remove icon-large"></i>&nbsp;Reject</a></td>
						</tr></table>
					</td></tr></table>
			<?php
				}/*end while show answer*/
				mysqli_close($conn);
			?>
		</div>
		</br>
	</div>
	<?php
		include ("footer.php");
	?>
</body>
</html>