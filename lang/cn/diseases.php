<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" conetent="text/html; charset=UTF-8">
	<?php
		$_SESSION['pages']="diseases.php";
		$page_title="diseases";
		include("menu.php");
	?>
	<title>疾病 - SabahTCM</title> 
</head>
<body>
	<div id="body">
		<div id="main">
		</br>
			<div class="sidebar">
				<h3 style="text-align:center" id="search">疾病种类</h3>
				<!--Start listing all herbs-->
				<ul id="list">		
				<?php 							
					$disease_query=mysqli_query($conn,"SELECT disease_cn FROM herb_info GROUP BY disease_cn")or die(mysqli_error($conn));
					while($row=mysqli_fetch_array($disease_query)){
						$disease=$row['disease_cn'];
				?>
						<li><a href="diseases.php?disease=<?php echo $disease;?>"><?php echo $disease;?><i class="pull-right col-lg-4 icon-expand icon-medium">&nbsp;详情</i></a></li>
				<?php 
					}/*end while listing*/
				?>
				</ul>
				<!--end listing-->
			</div><!--sidebar div-->
			</br>
			</br>
			
			<div class="content">	
				<?php 
					$disease=isset($_GET['disease'])?$_GET['disease']:NULL;
					$herb=isset($_GET['herb'])?$_GET['herb']:NULL;
					/*if no disease is selected, print comment*/
					if($disease==NULL){
						echo "请选择疾病";
					}

					/*else retrieve db*/
					else{	
						/*breadcrumb*/
						echo "<b>疾病&nbsp;>&nbsp;".$disease."</b>";
						/*get local_name from herb_list*/
						if($herb==NULL){
							/*if no herb is selected yet, print list*/
							/*breadcrumb*/
							echo "</br></br>";
							$herb_id_show=mysqli_query($conn,"SELECT herb_id FROM herb_info WHERE disease_cn='$disease'")or die(mysqli_error($conn));
							while($data=mysqli_fetch_array($herb_id_show)){
								$herb_id=$data['herb_id'];

								$herb_show=mysqli_query($conn,"SELECT local_name_cn FROM herb_list WHERE herb_id='$herb_id'")or die(mysqli_error($conn));
								while($data2=mysqli_fetch_array($herb_show)){
									$herb=$data2['local_name_cn'];
								}
				?>
								<!--print list of local_name-->
								<p style="padding-bottom:2px"><li style="display:inline-block"><a href="diseases.php?disease=<?php echo $disease;?>&amp;herb=<?php echo $herb;?>"><?php echo $herb;?></a></li></p>	
								</br>
								<!--done print list-->
				<?php
					 		}/*end while listing*/
						}/*end if herb null*/
						/*else retrieve db get information*/
						else{
							/*breadcrumb*/
							echo "<b>&nbsp;>&nbsp;".$herb."</b></br></br>";	
							/*get herb_list*/
							$herb_list_information=mysqli_query($conn,"SELECT * FROM herb_list WHERE local_name_cn='$herb' ")or die(mysqli_error($conn));
							while($data1=mysqli_fetch_array($herb_list_information)){
								$herb_id=$data1['herb_id'];
								$herb_name=$data1['local_name_cn'];
								$other_name=$data1['other_name_cn'];
								$sci_name=$data1['scientific_name'];
								$family=$data1['family_cn'];
								$image=$data1['image'];
							}/* end while fetch herb_list*/	
				?>
							<!--print herb_list-->
							<h3 class="first"><?php echo $herb_name;?></h3>
							</br>
							<img id="herbImg" alt="<?php echo $herb_name;?>" width="30%" height="auto" style="float:right; margin:5% 0px 0px 5%; max-height: 200px; object-fit: cover;" src="../../pics/<?php echo $image;?>" onclick="enlarge();"/>

							<!-- The Modal -->
							<div id="enlargeImg">
								<!--Close button-->
							  	<span class="closeImg">&times;</span>  	
							  	<!--Content-->
							  	<img id="bigImg">
							  	<!--Caption-->
							  	<div id="caption"></div>
							</div>

							<p style="padding-bottom:2px"><b>名称：</b><?php echo $herb_name;?></p>
							<p style="padding-bottom:2px"><b>别称：</b><?php echo $other_name;?></p>
							<p style="padding-bottom:2px"><b>学名：</b><i><?php echo $sci_name;?></i></p>	
							<p style="padding-bottom:2px"><b>科别：</b><?php echo $family;?></p>	
							</br> 
							<!--done print herb_list-->
				<?php
							/*get herb_info*/
							$herb_info_show=mysqli_query($conn,"SELECT * FROM herb_info WHERE herb_id='$herb_id' AND disease_cn='$disease'")or die(mysqli_error($conn));
							while($data3=mysqli_fetch_array($herb_info_show)){
								$info_id=$data3['info_id'];
								$part=$data3['usage_part_cn'];
								$function=$data3['function_cn'];
								$disease=$data3['disease_cn'];
							}/* end while fetch herb_info*/
				?>
							<!--print herb_info-->
							<p style="padding-bottom:4px"><b>药用部位：</b><?php echo $part;?></p>
							<p style="padding-bottom:4px"><b>功效：</b><?php echo $function;?></p>
							<p style="padding-bottom:4px"><b>主治：</b><?php echo $disease;?></p>	
							<hr>
							
							<p><a href="diseases.php?disease=<?php echo $disease;?>" class="btn btn-info"><i class="icon-arrow-left icon-large"></i>&nbsp;回去</a></p>
				<?php	
						}/*end else selected herb*/	
					}/*end else selected disease*/
				?>			
			</div><!--end content div-->
		</div>
		</br></br>
	</div><!--end body div-->
	<?php
		include("footer.php");
	?>
</body>
</html>