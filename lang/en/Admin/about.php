<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" conetent="text/html; charset=UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php
		$_SESSION['pages']="about.php";
		$page_title="information";
		include("menu.php");
	?>
	<title>About Us - SabahTCM</title>
</head>
<body>
	<div id="breadcrum">
		<a class="btn btn-home" href="index.php"><i class="icon-home icon-large"></i>&nbsp;Home</a>&nbsp;&nbsp;>
		<a class="btn btn-home" href="contact.php"><i class="icon-question icon-large"></i>&nbsp;About Us</a>&nbsp;&nbsp;
	</div>
	</br>

	<div id="body">
		<div class="content" style="text-align:justify; padding-left:5px">	
			<h3>About Us</h3>
			<p>This website is for Final Year Project (FYP) of Faculty of Computing and Informatics (FCI) in Universiti Malaysia Sabah (UMS) only, in partial fulfilment of the requirements for the Degree of Bachelor of Computer Science with Honours.</p>
			<p>The main purpose of FYP is let the students to understand and apply the theoretical knowledge, also to derive, apply and adapt solutions from the discipline specific knowledge to a realistic problem solving context that related to computer science.</p>
			<p>Sabah Traditional Chinese Medicine Database (SabahTCM) is a data collection that store the information about the traditional Chinese medicine/herbs that found in Sabah state. Besides, this Site also provided some information about the usage of herbs in summary and the picture.</p>
			<br/>
			<h3>Contact Us</h3>
			<p>Developer: Neoh Yee Jin&nbsp;<i style="padding-left: 64px" class="icon-envelope icon-large"></i>&nbsp;alwice@hotmail.com</p>
			<o>Supervisor: Dr. Aslina Baharum&nbsp;<i style="padding-left: 10px" class="icon-envelope icon-large"></i>&nbsp;aslina@ums.edu.my</p>
		</div>
	</div>
	<?php
		include ("footer.php");
	?>
</body>
</html>