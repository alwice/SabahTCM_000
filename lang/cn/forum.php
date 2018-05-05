<!DOCTYPE html> 
<html>
<head>
	<meta http-equiv="Content-Type" conetent="text/html; charset=UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php
		if(!isset($_SESSION['userID'])){
			echo "<script>location.href='login.php';</script>";
		}
		$_SESSION['pages']="forum.php";
		$page_title="forum";
		include("menu.php");
	?>
	<title>论坛 - SabahTCM</title>
</head>

<body>
	<div id="breadcrumb">
		<a href="index.php"><i class="icon-home icon-large"></i>&nbsp;首页</a>&nbsp;&nbsp;>
		<a href="forum.php"><i class="icon-question icon-large"></i>&nbsp;论坛</a>&nbsp;&nbsp;
	</div>
	<div id="forum_search">
		<form class="form-inline" action="search_forum.php" method="post">
			<input type="text" data-toggle="tooltip" data-placement="right" class="form-control" name="search_topic" placeholder="搜索课题" title="搜索有关课题">
			<button class="form-control" type="submit" name="submit" value="submit"><i class="icon-search icon-large"></i></button>
		</form>
	</div>
	</br>
	
	<div id="body">
		</br></br>
		<div class="content">
			<form action="" method="get">
				<?php
					$cat=mysqli_query($conn,"SELECT * FROM category")or die(mysqli_error($conn));
					while($row=mysqli_fetch_array($cat)){
						$category_id=$row['category_id'];
						$category_cn=$row['category_cn'];
				?>
						<p><button class="form-control" name="category" value="<?php echo $category_cn;?>" type="submit" formaction="topic.php"><?php echo $category_cn;?></button></p>
				<?php
					}
				?>
			</form>
		</div>
	</div>
	<?php
		include ("footer.php");
	?>
</body>
</html>