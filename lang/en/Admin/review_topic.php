<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" conetent="text/html; charset=UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php
		$_SESSION['pages']="review_topic.php";
		$page_title="forum";
		include("menu.php");
	?>
	<title>Review Topic - SabahTCM</title>
</head>
<body>
	<div id="breadcrumb">
		<a href="index.php"><i class="icon-home icon-large"></i>&nbsp;Home</a>&nbsp;&nbsp;>
		<a href="forum.php"><i class="icon-question icon-large"></i>&nbsp;Forum</a>&nbsp;&nbsp;>
		<a href="review_topic.php"><i class="icon-question icon-large"></i>&nbsp;Review Topic</a>&nbsp;&nbsp;
	</div>
	<div id="forum_search">
		<form class="form-inline" action="search_forum.php" method="post">
			<input type="text" data-toggle="tooltip" data-placement="right" class="form-control" name="search_topic" placeholder="Search Topic" title="Search Related Topic">
			<button class="form-control" type="submit" name="submit" value="submit"><i class="icon-search icon-large"></i></button>
		</form>
	</div>
	
	<div id="body">
		<div class="sidebar">	 
			<p><a href="forum.php" class="btn btn-info"><i class="icon-arrow-left icon-large"></i>&nbsp;Back</a></p>
		</div>

		<div class="content">
			<table id="forum" width="100%" border="1" align="center" cellpadding="3" cellspacing="1">
				<thead><tr>
					<th width="40%" onclick="sortTable(0)">Topic<span class="break"></br></span>&nbsp;<i class="icon-sort icon-small"></th>
					<th width="10%" onclick="sortTable(1)">Category<span class="break"></br></span>&nbsp;<i class="icon-sort icon-small"></th>
					<!--column of create&reply of dekstop-->
					<th class="forum_site" width="20%" colspan="2" onclick="sortTable(3)">Created By&nbsp;<i class="icon-sort icon-small"></th>
					<th class="forum_site" width="20%" colspan="2"  onclick="sortTable(5)">Last Replied By&nbsp;<i class="icon-sort icon-small"></th>
					<th class="forum_site" width="5%" onclick="sortTable(6)">Replies&nbsp;<i class="icon-sort icon-small"></th>
					<th class="forum_site" width="5%" onclick="sortTable(7)">Unreview&nbsp;<i class="icon-sort icon-small"></th>
					<!--column of create&reply of mobile-->
					<th class="forum_phone" width="20%" onclick="sortTable(3)">Created By&nbsp;<i class="icon-sort icon-small"></th>
					<th class="forum_phone" width="20%" onclick="sortTable(5)">Last Replied By&nbsp;<i class="icon-sort icon-small"></th>
					<th class="forum_phone" width="10%" onclick="sortTable(7)">Replies<span class="break"></br></span>/<span class="break"></br></span>Unreview<span class="break"></br></span>&nbsp;<i class="icon-sort icon-small"></th>
				</tr></thead><tbody>
			<?php
				$question_show=mysqli_query($conn,"SELECT * FROM topic WHERE isReview!=2")or die(mysqli_error($conn));	
				while($data=mysqli_fetch_array($question_show)){
					$topic_id=$data['topic_id'];
					$topic=$data['topic'];
					$reply=$data['reply'];
					$topic_user_id=$data['user_id'];
					$topic_details=$data['topic_details'];
					$topic_time=$data['time_topic'];
					$topic_category=$data['category'];
					$topic_review=$data['isReview'];
					//catch question user
					$topic_user_show=mysqli_query($conn,"SELECT username FROM user WHERE user_id='$topic_user_id'")or die(mysqli_error($conn));
					while($catch1=mysqli_fetch_assoc($topic_user_show)){
						$topic_user=$catch1['username'];
					}
					//catch latest reply
					$comment_show=mysqli_query($conn,"SELECT MAX(time_comment), user_id FROM comment WHERE topic_id='$topic_id'")or die(mysqli_error($conn));
					while($catch2=mysqli_fetch_assoc($comment_show)){
						$comment_time=$catch2['MAX(time_comment)'];
						$comment_user_id=$catch2['user_id'];
					}
					//catch answer user
					if($comment_time==NULL){
						$comment_user="-";
					}
					else{
						$ans_user_show=mysqli_query($conn,"SELECT username FROM user WHERE user_id='$comment_user_id'")or die(mysqli_error($conn));
						while($catch3=mysqli_fetch_assoc($ans_user_show)){
							$comment_user=$catch3['username'];
						}
					}
					//catch unreviewed comment
					$comment_review=mysqli_query($conn,"SELECT count(comment_id) AS unreviewed FROM comment WHERE topic_id='$topic_id' AND isReview=0")or die(mysqli_error($conn));
					while($catch4=mysqli_fetch_assoc($comment_review)){
						$unreviewed=$catch4['unreviewed'];
					}
					/*check either the topic/comment need review or not*/
					if($topic_review==0 || $unreviewed>0){
			?>
						<tr style="background-color: #FFFFFF">
							<td>&nbsp;<?php echo $topic;?><span class="break"></br></span>&nbsp;<a href="review_comment.php?id=<?php echo $topic_id;?>"><i class="icon-signin icon-large"></i></a><BR></td>
							<td align="center"><?php echo $topic_category; ?></td>
							<!--column of create&reply of dekstop-->
							<td class="forum_site" width="10%" align="center"><?php echo $topic_user;?></td>
							<td class="forum_site" width="10%" align="center"><?php echo $topic_time;?></td>
							<td class="forum_site" width="10%" align="center"><?php echo $comment_user;?></td>
							<td class="forum_site" width="10%" align="center"><?php echo $comment_time;?></td>
							<td class="forum_site" width="5%" align="center"><?php echo $reply;?></td>
							<td class="forum_site" width="5%" align="center"><?php echo $unreviewed;?></td>
							<!--column of create&reply of mobile-->
							<td class="forum_phone"align="center"><?php echo $topic_user.'</br>'.$topic_time;?></td>
							<td class="forum_phone" align="center"><?php echo $comment_user.'</br>'.$comment_time;?></td>
							<td class="forum_phone" align="center"><?php echo $reply.'/'.$unreviewed;?></td>
						</tr>
			<?php
					}/*end check review needed*/
				}/*end while list*/
				mysqli_close($conn);
			?>
				</tbody><tfoot style="background-color: #E6E6E6"><tr>
					<td colspan="8">&nbsp;</td>
				</tr></tfoot>
			</table>		
		</div>
	</div>
	<?php
		include ("footer.php");
	?>
</body>
</html>