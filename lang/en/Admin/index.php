<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" conetent="text/html; charset=UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php
		$_SESSION['pages']="index.php";
		$page_title="index";
		include("menu.php");
	?>
	<title>Home - SabahTCM</title>
</head>
<body>
	<div id="body">
		</br>
		<div style="border-radius:12px" id="home">
			<div class="sidebar">
				<img src="../../../images/home.jpg" alt="Image">			
			</div>
			<div class="content">
			</br>
				<h1>What is SabahTCM?</h1>
				<p>Sabah Traditional Chinese Medicine Database (SabahTCM) is a data collection that store the information about the traditional Chinese medicine/herbs that found in Sabah state. Besides, this Site also provided some information about the usage of herbs in summary and the picture.</p>
				
				<h1>Can SabahTCM be trusted?</h1>
				<p>Sabah Traditional Chinese Medicine Database (SabahTCM) collected data from validated information. In addition, SabahTCM also verified the data with expertise in Sabah.</p>
				
				<h1>What makes different?</h1>
				<p>Sabah Traditional Chinese Medicine Database (SabahTCM) has the advanced in which it may be review in bilingual (English and Chinese). Besides, Forum is provided for the users and admins to interact and exchange opinion.</p>			
			</div><!--end content div-->
		</div><!--end div-->
	</div><!--end body div-->
	<?php
		include("footer.php");
	?>
</body>
</html>