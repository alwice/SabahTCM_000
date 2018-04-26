<!DOCTYPE html>
<html>
<head>
	<?php
		$_SESSION['pages']="about.php";
		$page_title="information";
		include("menu.php");
	?>
	<title>关于我们 - SabahTCM</title>
</head>
<body>
	<div id="breadcrum">
		<a class="btn btn-home" href="index.php"><i class="icon-home icon-large"></i>&nbsp;首页</a>&nbsp;&nbsp;>
		<a class="btn btn-home" href="contact.php"><i class="icon-question icon-large"></i>&nbsp;关于我们</a>&nbsp;&nbsp;
	</div>
	</br>

	<div id="body">
		<div class="content" style="text-align:justify; padding-left:5px">	
			<h3>关于我们</h3>
			<p>本站仅用于马来西亚沙巴大学（UMS）计算机与信息学院（FCI）的结业项目（FYP）运作。此站是为了履行部分的计算机科学荣誉学士学位的需求。</p>
			<p>FYP的主要目的是为了让学生能够明白及应用理论上的知识，并且能够从学科特定的知识导源，应用和调整解决方案于解决有关计算机科学的现实环境问题。</p>
			<p>Sabah Traditional Chinese Medicine Database (SabahTCM)是一个储存有关能够在沙巴州找寻的传统中草药的资讯的资料收集站。本站也提供一些有关草药用处的摘点和图片。</p>
			<br/>
			<h3>联系我们</h3>
			<p>开发者：Neoh Yee Jin&nbsp;<i style="padding-left: 47px" class="icon-envelope icon-large"></i>&nbsp;alwice@hotmail.com</p>
			<p>监督者：Dr. Aslina Baharum&nbsp;<i style="padding-left: 10px" class="icon-envelope icon-large"></i>&nbsp;aslina@ums.edu.my</p>
		</div>
		</br></br>
	</div>
	<?php
		include ("footer.php");
	?>
</body>
</html>