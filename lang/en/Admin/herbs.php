<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" conetent="text/html; charset=UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php
		$_SESSION['pages']="herbs.php";
		$page_title="herbs";
		include("menu.php");
	?>
	<title>Herbs - SabahTCM</title>
</head>
<body>
	<div id="body">
		<div id="main">
		</br>
			<div class="sidebar">
				<h3 style="text-align:center" id="search">Herbs Type</h3>
				<!--Start listing all herbs-->
				<ul id="list">		
				<?php 							
					$herb_query=mysqli_query($conn,"SELECT * FROM herb_list ORDER BY local_name")or die(mysqli_error($conn));
			
					while($row=mysqli_fetch_array($herb_query)){
						$herbs_id=$row['herb_id'];
						$herb_name=$row['local_name'];
				?>
						<li><a href="herbs.php?id=<?php echo $herbs_id;?>&amp;herb=<?php echo $herb_name;?>"><?php echo $herb_name;?><i class="pull-right col-lg-4 icon-expand icon-medium">&nbsp;Details</i></a></li>
				<?php 
					}/*end while listing*/
				?>
				</ul>
				<!--end listing-->
			</div><!--sidebar div-->
			
			<a class="btn btn-info pull-right" href="add_herbs.php"><i class="icon-plus icon-large"></i>&nbsp;Add Herbs</a>
			</br> 
			</br>
			
			<div class="content">
				<?php 
					$id=isset($_GET['id'])?$_GET['id']:NULL;
					if($id==NULL){
						echo "Please Choose Herb";
					} 
					/*else retrieve db*/
					else{
						/*get herb_list*/
						$herb_list_information=mysqli_query($conn,"SELECT * FROM herb_list WHERE herb_id='$id' ")or die(mysqli_error($conn));
			
						while($data1=mysqli_fetch_array($herb_list_information)){
							$list_id=$data1['herb_id'];
							$herb_name=$data1['local_name'];
							$other_name=$data1['other_name'];
							$sci_name=$data1['scientific_name'];
							$family=$data1['family'];
							$image=$data1['image'];
						}
				?>
						<!--selection m5=-All m2=+dt-->
						<a class="pull-right" style="color:darkblue" href="delete_herbs.php?list_id=<?php echo $list_id;?>&amp;m=5"><i class="icon-trash icon-large"></i>Delete Herb</a>&nbsp;&nbsp;&nbsp;
						<h3 class="first"><?php echo $herb_name;?></h3>
						<a class="pull-right" style="color:darkblue" href="add_herbs.php?list_id=<?php echo $list_id;?>&amp;m=2"><i class="icon-plus icon-large"></i>Add Herb's Record</a>&nbsp;&nbsp;&nbsp;
						</br>

						<!--print herb_list-->
						<img id="herbImg" alt="<?php echo $herb_name;?>" width="30%" height="auto" style="float:right; margin:5% 0px 0px 5%; max-height: 200px; object-fit: cover;" src="../../../pics/<?php echo $image;?>" onclick="enlarge();"/>

						<!-- The Modal -->
						<div id="enlargeImg">
							<!--Close button-->
						  	<span class="closeImg">&times;</span>  	
						  	<!--Content-->
						  	<img id="bigImg">
						  	<!--Caption-->
						  	<div id="caption"></div>
						</div>

						<p style="padding-bottom:1%"><b> Local Name: </b><?php echo $herb_name;?></p>
						<p style="padding-bottom:1%"><b> Other Name: </b><?php echo $other_name;?></p>
						<p style="padding-bottom:1%"><b> Scientific Name: </b><i><?php echo $sci_name;?></i></p>	
						<p style="padding-bottom:1%"><b> Family: </b><?php echo $family;?></p>
						</br> 
						<!--done print herb_list-->
				<?php 
						/*get herb_info*/
						$herb_info_show=mysqli_query($conn,"SELECT * FROM herb_info WHERE herb_id='$id' ")or die(mysqli_error($conn));
						while($data=mysqli_fetch_array($herb_info_show)){
							$info_id=$data['info_id'];
							$part=$data['usage_part'];
							$function=$data['function'];
							$disease=$data['disease'];
				?>
							<!--print herb_info-->
							<p style="padding-bottom:1%"><b> Part of Use: </b><?php echo $part;?></p>
							<p style="padding-bottom:1%"><b> Expertise Function: </b><?php echo $function;?></p>
							<p style="padding-bottom:1%"><b> Disease: </b><?php echo $disease;?>	
							<!--selection m3=ud, m4=-dt-->
							<a class="pull-right" style="color:darkblue" href="add_herbs.php?info_id=<?php echo $info_id;?>&amp;m=3"><i class="icon-edit icon-large"></i>Update</a></p>
							<a class="pull-right" style="color:darkblue" href="add_herbs.php?info_id=<?php echo $info_id;?>&amp;m=4"><i class="icon-trash icon-large"></i>Delete Record</a>&nbsp;&nbsp;&nbsp;
							<hr>				
				<?php 		
						} /* end while print herb_info*/
					} /*end else selected herb*/
				?>
			</div><!--end content div-->
		</div><!--end div-->
	</div><!--end body div-->
	<?php
		include("footer.php");
	?>
</body>
</html>