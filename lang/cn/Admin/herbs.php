<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" conetent="text/html; charset=UTF-8">
	<?php
		$_SESSION['pages']="herbs.php";
		$page_title="herbs";
		include("menu.php");
	?>
	<title>草药 - SabahTCM</title>
</head>
<body>
	<div id="body">
		<div id="main">
		</br>
			<div class="sidebar">
				<h3 style="text-align:center" id="search">草药类型</h3>
				<!--Start listing all herbs-->
				<ul id="list">		
				<?php 							
					$herb_query=mysqli_query($conn,"SELECT * FROM herb_list ORDER BY local_name_cn")or die(mysqli_error($conn));
			
					while($row=mysqli_fetch_array($herb_query)){
						$herbs_id=$row['herb_id'];
						$herb_name=$row['local_name_cn'];
				?>
						<li><a href="herbs.php?id=<?php echo $herbs_id;?>&amp;herb=<?php echo $herb_name;?>"><?php echo $herb_name;?><i class="pull-right col-lg-4 icon-expand icon-medium">&nbsp;详情</i></a></li>
				<?php 
					}/*end while listing*/
				?>
				</ul>
				<!--end listing-->
			</div><!--sidebar div-->
			
			<a class="btn btn-info pull-right" href="add_herbs.php"><i class="icon-plus icon-large"></i>&nbsp;增加草药</a>
			</br> 
			</br>
			
			<div class="content">
				<?php 
					if(isset($_GET['list_id'])){
						$list_id=$_GET['list_id'];
						/*get herb_list*/
						$herb_list_information=mysqli_query($conn,"SELECT * FROM herb_list WHERE herb_id='$list_id'")or die(mysqli_error($conn));
						while($data1=mysqli_fetch_array($herb_list_information)){
							$herb_id=$data1['herb_id'];
							$herb_name=$data1['local_name_cn'];
							$other_name=$data1['other_name_cn'];
							$sci_name=$data1['scientific_name'];
							$family=$data1['family_cn'];
							$image=$data1['image'];
						}
				?>
						<!--print herb_list-->
						<h3 class="first"><?php echo $herb_name;?></h3>
						</br>
						<p><img style="width:235px; height:235px; float:right;margin:0px 0px 0px 10px" src="../../../pics/<?php echo $image;?>"></p>
						<p style="padding-bottom:4px"><b> 名称：</b><?php echo $herb_name;?></p>
						<p style="padding-bottom:4px"><b> 别称：</b><i><?php echo $other_name;?></i></p>
						<p style="padding-bottom:4px"><b> 学名：</b><i><?php echo $sci_name;?></i></p>
						<p style="padding-bottom:4px"><b> 科别：</b><?php echo $family;?></p>
						</br> 
						<!--done print herb_list-->
				<?php 
						/*get herb_info*/
						$herb_info_show=mysqli_query($conn,"SELECT * FROM herb_info WHERE herb_id='$list_id' ")or die(mysqli_error($conn));
						while($data=mysqli_fetch_array($herb_info_show)){
							$info_id=$data['info_id'];
							$part=$data['usage_part_cn'];
							$function=$data['function_cn'];
							$disease=$data['disease_cn'];
				?>
							<!--print herb_info-->
							<p style="padding-bottom:4px" ><b> 药用部位：</b><?php echo $part;?></p>
							<p style="padding-bottom:4px"><b> 功效：</b><?php echo $function;?></p>
							<p style="padding-bottom:4px"><b> 主治：</b><?php echo $disease;?>				
							<hr>

				<?php 		
						} /*end while herb_info*/
				?>
						删除草药？
						<form class="form-inline" method="POST" action="delete_herbs.php" enctype="multipart/form-data">
							<button type="submit" class="btn btn-save" onClick="this.form.action='delete_herbs.php?list_id=<?php echo $_GET['list_id']; ?>'">&nbsp;是</button>
					        <button type="submit" class="btn btn-save" onClick="this.form.action='herbs.php'">&nbsp;否</button>
					        <input type="hidden" name="m" value="<?php echo $_GET['m']; ?>">
					    </form>
				<?php
					}/*end if delete herbs*/
					else{
						$id=isset($_GET['id'])?$_GET['id']:NULL;
						if($id==NULL){
							echo "请选择草药";
						} 
						/*else retrieve db*/
						else{
							/*get herb_list*/
							$herb_list_information=mysqli_query($conn,"SELECT * FROM herb_list WHERE herb_id='$id' ")or die(mysqli_error($conn));
				
							while($data1=mysqli_fetch_array($herb_list_information)){
								$list_id=$data1['herb_id'];
								$herb_name=$data1['local_name_cn'];
								$other_name=$data1['other_name_cn'];
								$sci_name=$data1['scientific_name'];
								$family=$data1['family_cn'];
								$image=$data1['image'];
							}
				?>
							<!--selection m5=-All m2=+dt-->
							<a class="pull-right" style="color:darkblue" href="delete_herbs.php?list_id=<?php echo $list_id;?>&amp;m=5"><i class="icon-trash icon-large"></i>删除药草</a>&nbsp;&nbsp;&nbsp;
							<h3 class="first"><?php echo $herb_name;?></h3>
							<a class="pull-right" style="color:darkblue" href="add_herbs.php?list_id=<?php echo $list_id;?>&amp;m=2"><i class="icon-plus icon-large"></i>增加草药记录</a>&nbsp;&nbsp;&nbsp;
							</br>

							<!--print herb_list-->
							<p><img style="width:235px; height:235px; float:right;margin:10px 0px 0px 5px" src="../../../pics/<?php echo $image;?>"></p>
							<p style="padding-bottom:4px"><b> 名称：</b><?php echo $herb_name;?></p>
							<p style="padding-bottom:4px"><b> 别称：</b><?php echo $other_name;?></p>
							<p style="padding-bottom:4px"><b> 学名：</b><i><?php echo $sci_name;?></i></p>	
							<p style="padding-bottom:4px"><b> 科别：</b><?php echo $family;?></p>
							</br> 
							<!--done print herb_list-->
				<?php 
							/*get herb_info*/
							$herb_info_show=mysqli_query($conn,"SELECT * FROM herb_info WHERE herb_id='$id' ")or die(mysqli_error($conn));
							while($data=mysqli_fetch_array($herb_info_show)){
								$info_id=$data['info_id'];
								$part=$data['usage_part_cn'];
								$function=$data['function_cn'];
								$disease=$data['disease_cn'];
				?>
								<!--print herb_info-->
								<p style="padding-bottom:4px"><b> 药用部位：</b><?php echo $part;?></p>
								<p style="padding-bottom:4px"><b> 功效：</b><?php echo $function;?></p>
								<p style="padding-bottom:4px"><b> 主治：</b><?php echo $disease;?>	
								<!--selection m3=ud, m4=-dt-->
								<a class="pull-right" style="color:darkblue" href="add_herbs.php?info_id=<?php echo $info_id;?>&amp;m=3"><i class="icon-edit icon-large"></i>更新</a></p>
								<a class="pull-right" style="color:darkblue" href="add_herbs.php?info_id=<?php echo $info_id;?>&amp;m=4"><i class="icon-trash icon-large"></i>删除记录</a>&nbsp;&nbsp;&nbsp;
								<hr>				
				<?php 		
							} /* end while print herb_info*/
						} /*end else selected herb*/
					}/*end else(normal)*/
				?>
			</div><!--end content div-->
		</div><!--end div-->
		</br></br>
	</div><!--end body div-->
	<?php
		include("footer.php");
	?>
</body>
</html>