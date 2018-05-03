<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" conetent="text/html; charset=UTF-8">
	<?php
		$_SESSION['pages']="index.php";
		$page_title="index";
		include("menu.php");
	?>
	<meta charset="UTF-8">
	<title>首頁 - SabahTCM</title>
</head>
<body>
	<div id="body">
		</br>
		<div style="border-radius:12px" id="home">
			<div class="sidebar">
				<img src="../../images/home.jpg" alt="Image">	
			</div>
			<div class="content">
			</br>
				<h1>什么是SabahTCM？</h1>
				<p>Sabah Traditional Chinese Medicine Database（SabahTCM）是一个收集着能在沙巴州寻获的传统中草药的资料库。此外，本站也提供些许关于中草药的摘点用处以及照片。</p>
				
				<h1>SabahTCM能信吗？</h1>
				<p>Sabah Traditional Chinese Medicine Database（SabahTCM）的资料来源是以确认内容的可信度的资料。而且，SabahTCM也有与沙巴有关专家审核该资料。</p>
				
				<h1>特别之处</h1>
				<p>Sabah Traditional Chinese Medicine Database（SabahTCM）的特处是让用户能够双语浏览（英文与中文）。此外，论坛是特别设立的，以便用户和管理员们能够交流并且交换意见。</p>
			</div><!--end content div-->
		</div><!--end div-->
		</br></br>
	</div><!--end body div-->
	<?php
		include("footer.php");
	?>
</body>
</html>