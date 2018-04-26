<!DOCTYPE html>

<html>

<head>

	<meta http-equiv="Content-Type" conetent="text/html; charset=UTF-8">

	<?php

		$_SESSION['category_cn']=$_GET['category'];

		

		if($_GET['category']=="问题"){

			$_SESSION['category']="Question";

	?>

			<title>问题 - SabahTCM</title>

	<?php

		}/*end title Question*/

		else if($_GET['category']=="意见和建议"){

			$_SESSION['category']="Opinion and Suggestion";

	?>

			<title>意见和建议 - SabahTCM</title>

	<?php

		}/*end title Opinion and Suggestion*/



		$cat=$_SESSION['category'];

		$_SESSION['pages']="topic.php?category=$cat";

		$page_title="forum";

		include("menu.php");

	?>

</head>



<body>

	<div id="breadcrumb">

		<a class="btn btn-home" href="index.php"><i class="icon-home icon-large"></i>&nbsp;首页</a>&nbsp;&nbsp;>

		<a class="btn btn-home" href="forum.php"><i class="icon-question icon-large"></i>&nbsp;论坛</a>&nbsp;&nbsp;>

		<?php 

			if($_GET['category']=="问题"){

		?>

			<a class="btn btn-home" href="topic.php?category=问题"><i class="icon-question icon-large"></i>&nbsp;问题</a>&nbsp;&nbsp;

		<?php

			}/*end breadcrumb 问题*/

			elseif($_GET['category']=="意见和建议"){

		?>

				<a class="btn btn-home" href="topic.php?category=意见和建议"><i class="icon-question icon-large"></i>&nbsp;意见和建议</a>&nbsp;&nbsp;

		<?php

			}/*end breadcrumb 意见和建议*/

		?>	

	</div>

	<div>

		<form style="text-align: right;" class="form-inline" action="search_forum.php" method="post">

			<div class="form-group">

				<input style="width:300px" type="text" data-toggle="tooltip" data-placement="right" class="form-control" name="search_topic" placeholder="搜索课题" title="搜索有关课题">

				<button style="background-color:skyblue;" class="form-control" type="submit" name="submit" value="submit"><i style="color:white;" class="icon-search icon-large"></i></button>

			</div>

		</form>

	</div>



	<div id="body">	

		<div class="sidebar">	 

			<p><a href="forum.php" class="btn btn-info"><i class="icon-arrow-left icon-large"></i>&nbsp;回去</a></p>

		</div>



		<?php 

			if($_GET['category']=="问题"){

		?>

				<div class="content" style="background:none; margin-right">

					<a class="btn btn-info pull-right"  href="add_topic.php" ><i class="icon-plus icon-large"></i>&nbsp;提问</a>

					</br>

					</br>

				</div>

		<?php

			}/*end add topic 问题*/

			elseif($_GET['category']=="意见和建议"){

		?>

				<div class="content" style="background:none; margin-right">

					<a class="btn btn-info pull-right"  href="add_topic.php" ><i class="icon-plus icon-large"></i>&nbsp;发表话题</a>

					</br>

					</br>

				</div>

		<?php

			}/*end add topic 意见和建议*/

		?>

		</br>

		</br>



		<div class="content" style="margin-right: 15%">

			<?php 

				$category=$_SESSION['category'];

				$category_cn=$_SESSION['category_cn'];

				$topic_query=mysqli_query($conn,"SELECT * FROM topic WHERE category='$category' ORDER BY latest_reply_time DESC")or die(mysqli_error($conn));

			?>

				<table id="forum" width="95%" border="1" align="center" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">

					<thead><tr>

						<th width="50%" bgcolor="#E6E6E6" style="text-align: center;" onclick="sortTable(0)"><strong>课题</strong></th>

						<th width="5%" bgcolor="#E6E6E6" style="text-align: center;" onclick="sortTable(1)"><strong>回复</strong></th>

						<th width="20%" colspan="2" bgcolor="#E6E6E6" style="text-align: center;" onclick="sortTable(3)"><strong>创建</strong></th>

						<th width="20%" colspan="2" bgcolor="#E6E6E6" style="text-align: center;" onclick="sortTable(5)"><strong>最后回复</strong></th>	

					</tr></thead><tbody>

			<?php

					while($rows=mysqli_fetch_array($topic_query)){

						$topic_id=$rows['topic_id'];

						$topic=$rows['topic'];

						$reply=$rows['reply'];

						$topic_user_id=$rows['user_id'];

						$topic_time=$rows['time_topic'];

						//catch question user

						$topic_user_show=mysqli_query($conn,"SELECT username FROM user WHERE user_id='$topic_user_id' ")or die(mysqli_error($conn));

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

						<tr>

							<td bgcolor="#FFFFFF">&nbsp;&nbsp;<?php echo $topic;?>&nbsp;&nbsp;<a href="topic_view.php?id=<?php echo $topic_id;?>"><i class="icon-signin icon-large"></i></a><BR></td>

							<td align="center" bgcolor="#FFFFFF"><?php echo $reply; ?></td>

							<td width="10%" align="center" bgcolor="#FFFFFF"><?php echo $topic_user;?></td>

							<td width="10%" align="center" bgcolor="#FFFFFF"><?php echo $topic_time;?></td>

							<td width="10%" align="center" bgcolor="#FFFFFF"><?php echo $comment_user;?></td>

							<td width="10%" align="center" bgcolor="#FFFFFF"><?php echo $comment_time;?></td>

						</tr>

			<?php

					}/*end while list*/

					mysqli_close($conn);

			?>

					</tbody><tfoot><tr>

						<td colspan="6" align="right" bgcolor="#E6E6E6">&nbsp;</td>

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