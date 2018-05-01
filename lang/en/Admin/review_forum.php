<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" conetent="text/html; charset=UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<?php
	include("db_conn.php");
	$topic_id=isset($_GET['tid'])?$_GET['tid']:NULL;
	$comment_id=isset($_GET['cid'])?$_GET['cid']:NULL;
	$mode=$_GET['mode'];
	$id=isset($_SESSION['topic_id'])?$_SESSION['topic_id']:NULL;

	if($topic_id!=NULL){
		$sql="UPDATE topic SET isReview='$mode' WHERE topic_id='$topic_id'";
		mysqli_query($conn,$sql)or die(mysqli_error($conn));
		echo "<script>alert('Topic is Reviewed!'); location.href='review_topic.php'</script>";
	}

	else if($comment_id!=NULL){
		$sql2="UPDATE comment SET isReview='$mode' WHERE comment_id='$comment_id'";
		mysqli_query($conn,$sql2)or die(mysqli_error($conn));
		echo "<script>alert('Comment is Reviewed!'); location.href='review_comment.php?id=".$id."'</script>";
	}
?>
</body>
</html>
