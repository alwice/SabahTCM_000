<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" conetent="text/html; charset=UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php
		$_SESSION['pages']="search_forum.php";
		$page_title="forum";
		include("menu.php");
	?>
	<title>Search Forum - SabahTCM</title>
</head>

<body>
	<div id="breadcrumb">
		<a href="index.php"><i class="icon-home icon-large"></i>&nbsp;Home</a>&nbsp;&nbsp;>
		<a href="forum.php"><i class="icon-question icon-large"></i>&nbsp;Forum</a>&nbsp;&nbsp;>
		<a href="search_forum.php"><i class="icon-question icon-large"></i>&nbsp;Search Forum</a>&nbsp;&nbsp;	
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
			<?php
				$submit=isset($_POST['submit'])?$_POST['submit']:NULL;
				$top=isset($_POST['search_topic'])?$_POST['search_topic']:NULL;
				if($submit!=NULL || isset($_SESSION['search_topic'])){
					$_SESSION['search_topic']=isset($top)?$top:$_SESSION['search_topic'];
					$kw=$_SESSION['search_topic'];
					$sql="SELECT * FROM topic WHERE topic LIKE '%$kw%' AND isReview=1";
					$query=mysqli_query($conn,$sql) or die(mysqli_error($conn));
			?>
					<table id="forum" width="100%" border="1" align="center" cellpadding="3" cellspacing="1">
						<thead><tr>
							<th width="40%" onclick="sortTable(0)">Topic&nbsp;<i class="icon-sort icon-small"></th>
							<th width="10%" onclick="sortTable(1)">Category<span class="break"></br></span>&nbsp;<i class="icon-sort icon-small"></th>
							<th width="10%" onclick="sortTable(2)">Replies<span class="break"></br></span>&nbsp;<i class="icon-sort icon-small"></th>
							<!--column of create&reply of dekstop-->
							<th class="forum_site" width="20%" colspan="2" onclick="sortTable(4)">Created By&nbsp;<i class="icon-sort icon-small"></th>
							<th class="forum_site" width="20%" colspan="2"  onclick="sortTable(6)">Last Replied By&nbsp;<i class="icon-sort icon-small"></th>
							<!--column of create&reply of mobile-->
							<th class="forum_phone" width="20%" onclick="sortTable(4)">Created By&nbsp;<i class="icon-sort icon-small"></th>
							<th class="forum_phone" width="20%" onclick="sortTable(6)">Last Replied By&nbsp;<i class="icon-sort icon-small"></th>
						</tr></thead><tbody>
			<?php
						while($rows=mysqli_fetch_array($query)){
							$topic_id=$rows['topic_id'];
							$topic=$rows['topic'];
							$reply=$rows['reply'];
							$topic_user_id=$rows['user_id'];
							$topic_time=$rows['time_topic'];
							$topic_category=$rows['category'];
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
								$ans_user_show=mysqli_query($conn,"SELECT username FROM user WHERE user_id='$comment_user_id' ")or die(mysqli_error($conn));
								while($catch3=mysqli_fetch_assoc($ans_user_show)){
									$comment_user=$catch3['username'];
								}
							}
			?>
							<tr style="background-color: #FFFFFF">
								<td>&nbsp;<?php echo $topic;?><span class="break"></br></span>&nbsp;<a href="topic_view.php?id=<?php echo $topic_id;?>"><i class="icon-signin icon-large"></i></a><BR></td>
								<td align="center"><?php echo $topic_category; ?></td>
								<td align="center"><?php echo $reply; ?></td>
								<!--column of create&reply of dekstop-->
								<td class="forum_site" width="10%" align="center"><?php echo $topic_user;?></td>
								<td class="forum_site" width="10%" align="center"><?php echo $topic_time;?></td>
								<td class="forum_site" width="10%" align="center"><?php echo $comment_user;?></td>
								<td class="forum_site" width="10%" align="center"><?php echo $comment_time;?></td>
								<!--column of create&reply of mobile-->
								<td class="forum_phone"align="center"><?php echo $topic_user.'</br>'.$topic_time;?></td>
								<td class="forum_phone" align="center"><?php echo $comment_user.'</br>'.$comment_time;?></td>
							</tr>
			<?php
						}/*end while list*/
						mysqli_close($conn);
			?>
						</tbody><tfoot style="background-color: #E6E6E6"><tr>
							<td colspan="7">&nbsp;</td>
						</tr></tfoot>
					</table>
					</br>
			<?php
				}
			?>
		</div>
	</div>
	<?php
		include ("footer.php");
	?>
</body>
</html>