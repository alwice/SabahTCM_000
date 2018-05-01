<!DOCTYPE html> 
<html>
<head>
	<meta http-equiv="Content-Type" conetent="text/html; charset=UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php
		if(!isset($_SESSION['userID'])){
			echo "<script>location.href='../login.php';</script>";
		}
		$_SESSION['pages']="forum.php";
		$page_title="forum";
		include("menu.php");
	?>
	<title>Forum - SabahTCM</title>
</head>

<body>
	<div id="breadcrumb">
		<a class="btn btn-home" href="index.php"><i class="icon-home icon-large"></i>&nbsp;Home</a>&nbsp;&nbsp;>
		<a class="btn btn-home" href="forum.php"><i class="icon-question icon-large"></i>&nbsp;Forum</a>&nbsp;&nbsp;
	</div>
	<div>
		<form style="text-align: right;" class="form-inline" action="search_forum.php" method="post">
			<div class="form-group">
				<input style="width:300px" type="text" data-toggle="tooltip" data-placement="right" class="form-control" name="search_topic" placeholder="Search Topic" title="Search Related Topic">
				<button style="background-color:skyblue;" class="form-control" type="submit" name="submit" value="submit"><i style="color:white;" class="icon-search icon-large"></i></button>
			</div>
		</form>
	</div>
	</br>
	
	<div id="body">
		</br></br>
		<div class="content" style="margin-right: 15%">
			<form action="" method="get">
				<p><button class="form-control" name="review_topic" value="review_topic" type="submit" style="margin-left" formaction="review_topic.php">Review Topic</button></p>
				<?php
					$cat=mysqli_query($conn,"SELECT * FROM category")or die(mysqli_error($conn));
					while($row=mysqli_fetch_array($cat)){
						$category_id=$row['category_id'];
						$category=$row['category'];
				?>
						<p><button class="form-control" name="category" value="<?php echo $category;?>" type="submit" style="margin-left" formaction="topic.php"><?php echo $category;?></button></p>
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