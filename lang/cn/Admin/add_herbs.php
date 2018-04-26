<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" conetent="text/html; charset=UTF-8">
	<?php
		$_SESSION['pages']="add_herbs.php";
		$page_title="herbs";
		include("menu.php");
	?>
	<title>增加草药 - SabahTCM</title>
</head>
<body>
	<?php
		if(isset($_GET['m']))/*m2,m3,m4*/{
			/*m3=ud, m4=-dt*/
			if(($_GET['m']==3)||($_GET['m']==4)){
				$info_id=$_GET['info_id'];
				/*get herb_info*/
				$herb_info_show=mysqli_query($conn,"SELECT * FROM herb_info WHERE info_id='$info_id'")or die(mysqli_error($conn));
				while($data=mysqli_fetch_array($herb_info_show)){
					$herb_id=$data['herb_id'];
					$part=$data['usage_part'];
					$function=$data['function'];
					$disease=$data['disease'];
					$part_cn=$data['usage_part_cn'];
					$function_cn=$data['function_cn'];
					$disease_cn=$data['disease_cn'];
				}
				/*get herb_list*/
				$herb_list_information=mysqli_query($conn,"SELECT * FROM herb_list WHERE herb_id='$herb_id'")or die(mysqli_error($conn));
				while($data1=mysqli_fetch_array($herb_list_information)){
					$sci_name=$data1['scientific_name'];
					$image=$data1['image'];
					$herb_name=$data1['local_name'];
					$other_name=$data1['other_name'];
					$family=$data1['family'];
					$herb_name_cn=$data1['local_name_cn'];
					$other_name_cn=$data1['other_name_cn'];
					$family_cn=$data1['family_cn'];	
				}
			}/*end fetch herb_info&&herb_list if m3&&m4*/
			/*m2=+dt-*/
			else if($_GET['m']==2){
				$herb_id=$_GET['list_id'];
				/*get herb_list*/
				$herb_list_information=mysqli_query($conn,"SELECT * FROM herb_list WHERE herb_id='$herb_id'")or die(mysqli_error($conn));
				while($data1=mysqli_fetch_array($herb_list_information)){
					$sci_name=$data1['scientific_name'];
					$image=$data1['image'];
					$herb_name=$data1['local_name'];
					$other_name=$data1['other_name'];
					$family=$data1['family'];
					$herb_name_cn=$data1['local_name_cn'];
					$other_name_cn=$data1['other_name_cn'];
					$family_cn=$data1['family_cn'];	
				}
			}/*end fetch herb_list if m2*/
			$mode=1;/*set mode=1*/
		}/*end ifset m2,m3,m4*/
	?>
	</br>

	<div id="body">
        <div style="background:lightblue" class="alert alert-info">增加草药</div>
		</br>	 
		<div class="sidebar">	 
			<p><a href="herbs.php" class="btn btn-info"><i class="icon-arrow-left icon-large"></i>&nbsp;回去</a></p>
		</div>
	
		<div id="home" style="width:700px">
			<div id="hd">请填以下的草药资料</div>
	
			<form class="form-inline" method="POST" action="add_herbs_save.php" enctype="multipart/form-data">
				<input type="hidden" name="mode" value="<?php echo $mode;?>">
				<input type="hidden" name="info_id" value="<?php echo $info_id;?>">		
				<input type="hidden" name="herb_id" value="<?php echo $herb_id;?>">
				<br><br>
						
				<!--Scientific Name-->
				<div class="form-group">
					<label style="padding-left: 132px">学名：</label>
					<input style="width:350px" type="text" data-toggle="tooltip" data-placement="right" title="请填上学名" class="form-control" value="<?php if(isset($sci_name)) echo $sci_name;?>" name="sci_name" placeholder="草药学名" required>
				</div>
				<br><br>

				<!--Local Name-->
				<div class="form-group">
					<label style="padding-left: 70px">名称（英文）：</label>
					<input style="width:350px" type="text" data-toggle="tooltip" data-placement="right" title="请填一个英文名称而已" class="form-control" value="<?php if(isset($herb_name)) echo $herb_name;?>" name="herb_name" placeholder="英文草药名称" />
				</div>
				<br><br>
				<!--Local Name in Chinese-->
				<div class="form-group">
					<label style="padding-left: 132px">名称：</label>
					<input style="width:350px" type="text" data-toggle="tooltip" data-placement="right" title="请填一个名称而已" class="form-control" value="<?php if(isset($herb_name_cn)) echo $herb_name_cn;?>" name="herb_name_cn" placeholder="草药名称" />
				</div>
				<br><br>

				<!--Other Name-->
				<div class="form-group">
					<label style="padding-left: 70px">别称（英文）：</label>
					<input style="width:350px" type="text" data-toggle="tooltip" data-placement="right" title="请填上英文别名" class="form-control" value="<?php if(isset($other_name)) echo $other_name;?>" name="other_name" placeholder="英文草药别名" />
				</div>
				<br><br>
				<!--Other Name in Chinese-->
				<div class="form-group">
					<label style="padding-left: 132px">别称：</label>
					<input style="width:350px" type="text" data-toggle="tooltip" data-placement="right" title="请填上别名" class="form-control" value="<?php if(isset($other_name_cn)) echo $other_name_cn;?>" name="other_name_cn" placeholder="草药别名" />
				</div>
				<br><br>
				
				<!--Family-->
				<div class="form-group">
					<label style="padding-left: 70px">科别（英文）：</label>
					<input style="width:350px" type="text" data-toggle="tooltip" data-placement="right" title="请填上英文科别" class="form-control" value="<?php if(isset($family)) echo $family;?>" name="family" placeholder="英文草药科别" />
				</div>
				<br><br>
				<!--Family in Chinese-->
				<div class="form-group">
					<label style="padding-left: 132px">科别：</label>
					<input style="width:350px" type="text" data-toggle="tooltip" data-placement="right" title="请填上科别" class="form-control" value="<?php if(isset($family_cn)) echo $family_cn;?>" name="family_cn" placeholder="草药科别" />
				</div>
				<br><br>

				<!--Usage Part-->
				<div class="form-group">
					<label style="padding-left: 40px">药用部位（英文）：</label>
					<input style="width:350px" type="text" data-toggle="tooltip" data-placement="right" title="请填一个英文药用部位而已" class="form-control" value="<?php if(isset($part)) echo $part;?>" name="part" placeholder="英文草药药用部位" />
				</div>
				<br><br>
				<!--Usage Part in Chinese-->
				<div class="form-group">
					<label style="padding-left: 102px">药用部位：</label>
					<input style="width:350px" type="text" data-toggle="tooltip" data-placement="right" title="请填一个药用部位而已" class="form-control" value="<?php if(isset($part_cn)) echo $part_cn;?>" name="part_cn" placeholder="草药药用部位" />
				</div>
				<br><br>

				<!--Function-->
				<div class="form-group">
					<label style="padding-left: 70px">功效（英文）：</label>
					<input style="width:350px" type="text" data-toggle="tooltip" data-placement="right" title="请填一个英文功效而已" class="form-control" value="<?php if(isset($function)) echo $function;?>" name="function" placeholder="英文草药功效" />
				</div>
				<br><br>
				<!--Function in Chinese-->
				<div class="form-group">
					<label style="padding-left: 132px">功效：</label>
					<input style="width:350px" type="text" data-toggle="tooltip" data-placement="right" title="请填一个功效而已" class="form-control" value="<?php if(isset($function_cn)) echo $function_cn;?>" name="function_cn" placeholder="草药功效" />
				</div>
				<br><br>

				<!--Disease-->
				<div class="form-group">
					<label style="padding-left: 70px">主治（英文）：</label>
					<input style="width:350px" type="text" data-toggle="tooltip" data-placement="right" title="请填一个英文主治而已" class="form-control" name="disease" value="<?php if(isset($disease)) echo $disease;?>" placeholder="英文主治疾病" />
				</div>
				<br><br>
				<!--Disease in Chinese-->
				<div class="form-group">
					<label style="padding-left: 132px">主治：</label>
					<input style="width:350px" type="text" data-toggle="tooltip" data-placement="right" title="请填一个主治而已" class="form-control" name="disease_cn" value="<?php if(isset($disease_cn)) echo $disease_cn;?>" placeholder="主治疾病" />
				</div>
				<br><br>

				<!--Image-->
				<div class="form-group">
					<?php
						$dir = '../../../pics';
						if(isset($image) && $image != null){
						 echo '<img style="width:150px; height:150px;margin:0px 40px 0px 250px" src="'. $dir. '/'. $image. '"  /> </br></br>';
						}
					?>
					<label style="padding-left: 132px" >图片：</label>	
					<input class="form-control"  style="padding-left: 200;width:350px;" type="file" name="image" multiple>
				</div>
				<br><br>
				<!--Save, update & delete-->
				<div class="control-group">
					<div class="controls" style="padding-left: 300px" >
					<?php
						if(isset($mode) && $mode == 1){
           					$m=$_GET['m'];
           			?>
           					<input type="hidden" name="m" value="<?php echo $m;?>">
           			<?php		
							if($m==2){
					?>
			  					<button type="submit" class="btn btn-save" value="Add" onClick="this.form.action='add_herbs_save.php?add_id=<?php echo $herb_id;?>'"><i class="icon-save icon-large"></i>&nbsp;增加</button>
					<?php	
							}/*end if add data m2*/
				            else if($m==3){	
				    ?>
			  					<button type="submit" class="btn btn-save" value="Update"><i class="icon-save icon-large"></i>&nbsp;更新</button>
					<?php	
							}/*end elseif update m=3*/
							else if($m==4){
					?>
								删除记录？
					            <button type="submit" class="btn btn-save" onClick="this.form.action='delete_herbs.php?info_id=<?php echo $info_id;?>'">&nbsp;是</button>
					            <button type="submit" class="btn btn-save" onClick="this.form.action='herbs.php'">&nbsp;否</button>
					            <input type="hidden" name="m" value="<?php echo $m;?>" formaction="delete_herbs.php">					
					<?php	
							} /*end else delete m=4*/
						}/*end if-else add&update&delete*/
						else{ 
					?>
							<button name="submit" type="submit" class="btn btn-save"><i class="icon-save icon-large"></i>&nbsp;储存</button>
					<?php	
						}/*end else save*/
					?>					
					</div>
				</div>
	   		</form>					
		</div>
		</br></br>		
    </div>
	<?php
		include("footer.php");
	?>
</body>
</html>