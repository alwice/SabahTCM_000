<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" conetent="text/html; charset=UTF-8">
</head>
<body>
<?php
	include('db_conn.php'); 
	$m = isset($_POST['m']) ? $_POST['m'] : $_GET['m'] ;
	if($m==4){
		$id_info=$_GET['info_id'];
		$sql="DELETE FROM herb_info WHERE info_id='$id_info'";
		mysqli_query($conn,$sql)or die(mysqli_error($conn));
		echo "<script>alert('草药资料删除成功'); location.href='herbs.php' </script>";
	}/*end delete data m=4*/

	else if($m==5){
		$del_id=$_GET['list_id'];
		$sql2="DELETE FROM herb_list WHERE herb_id='$del_id'";
		mysqli_query($conn,$sql2)or die(mysqli_error($conn));
		$sql3="DELETE FROM herb_info WHERE herb_id='$del_id'";
		mysqli_query($conn,$sql3)or die(mysqli_error($conn));	
		echo "<script>alert('草药删除成功'); location.href='herbs.php' </script>";
	}
?>
</body>