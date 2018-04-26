<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" conetent="text/html; charset=UTF-8">
</head>
<body>
<?php
	include('db_conn.php'); 
	$id=$_GET['id'];

	//deleting the row from table
	$result=mysqli_query($conn,"DELETE FROM topic WHERE topic_id=$id");
	$result2=mysqli_query($conn,"DELETE FROM comment WHERE topic_id=$id");

	echo "<script>alert('课题删除成功！'); location.href='topic.php?category=".$_SESSION['category_cn']."' </script>";
?>
</body>