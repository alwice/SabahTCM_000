<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" conetent="text/html; charset=UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php
		$_SESSION['pages']="add_herbs.php";
		$page_title="herbs";
		include("menu.php");
	?>
	<title>Add Herbs - SabahTCM</title>
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
					$sci_name_gs=$data1['scientific_gen_spec'];
					$sci_name_var=$data1['scientific_var'];
					$sci_name_cv=$data1['scientific_cv'];
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
					$sci_name_gs=$data1['scientific_gen_spec'];
					$sci_name_var=$data1['scientific_var'];
					$sci_name_cv=$data1['scientific_cv'];
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
	
	<div id="body">
		</br><span class="nav_break"></br></br></br></br></br></span>
		
        <div style="background:lightblue" class="alert alert-info">Add Herb</div>
		</br>	 
		<div class="sidebar">	 
			<p><a href="herbs.php" class="btn btn-info"><i class="icon-arrow-left icon-large"></i>&nbsp;Back</a></p>
		</div>
	
		<div id="small_window">
			<div id="hd">Please fills the herb's information below</div>	
			</br><span class="form_break"></br></span>	
	
			<form id="herb" class="form-inline" method="POST" action="add_herbs_save.php" enctype="multipart/form-data">
				<input type="hidden" name="mode" value="<?php echo $mode;?>">
				<input type="hidden" name="info_id" value="<?php echo $info_id;?>">		
				<input type="hidden" name="herb_id" value="<?php echo $herb_id;?>">
				
				<!--Scientific Name-->
				<fieldset><legend>Scientific Name</legend>
					<!--Genus & Species-->
					<div class="form-group">
						<label>Genus & Species:</label>
						<input type="text" data-toggle="tooltip" data-placement="right" title="Fillin the Genus species of Herb" class="form-control" value="<?php if(isset($sci_name_gs)) echo $sci_name_gs;?>" name="sci_name_gs" placeholder="Herbs' Scientific Genus species Name" required autofocus/>
					</div>
					<!--Variety-->
					<div class="form-group">
						<label>Variety:</label>
						<input type="text" data-toggle="tooltip" data-placement="right" title="Fillin the Variety of Herb (May leave blank)" class="form-control" value="<?php if(isset($sci_name_var)) echo $sci_name_var;?>" name="sci_name_var" placeholder="Herbs' Scientific Variety Name"/>
					</div>
					<!--Variety / Cultivar-->
					<div class="form-group">
						<label>Cultivar:</label>
						<input type="text" data-toggle="tooltip" data-placement="right" title="Fillin the Cultivar of Herb" class="form-control" value="<?php if(isset($sci_name_cv)) echo $sci_name_cv;?>" name="sci_name_cv" placeholder="Herbs' Scientific Cultivar Name"/>
					</div>
				</fieldset>
				</br><span class="form_break"></br></span>
					
				<!--Local Name-->
				<fieldset><legend>Local Name</legend>	
					<!--Local Name in EN-->			
					<div class="form-group">
						<label>Local-English:</label>
						<input type="text" data-toggle="tooltip" data-placement="right" title="Fillin Only One Local Name" class="form-control" value="<?php if(isset($herb_name)) echo $herb_name;?>" name="herb_name" placeholder="Herbs' Local Name" />
					</div>
					<!--Local Name in CN-->
					<div class="form-group">
						<label>Local-Chinese:</label>
						<input type="text" data-toggle="tooltip" data-placement="right" title="Fillin Only One Local Name in CN" class="form-control" value="<?php if(isset($herb_name_cn)) echo $herb_name_cn;?>" name="herb_name_cn" placeholder="Herbs' Local Name in CN" />
					</div>
				</fieldset>
				</br><span class="form_break"></br></span>
			
				<!--Other Name-->
				<fieldset><legend>Other Name</legend>	
					<!--Other Name in EN-->			
					<div class="form-group">
						<label>Other-English:</label>
						<input type="text" data-toggle="tooltip" data-placement="right" title="Fillin The Other Names" class="form-control" value="<?php if(isset($other_name)) echo $other_name;?>" name="other_name" placeholder="Herbs' Other Name" />
					</div>
					<!--Other Name in CN-->
					<div class="form-group">
						<label>Other-Chinese:</label>
						<input type="text" data-toggle="tooltip" data-placement="right" title="Fillin The Other Names in CN" class="form-control" value="<?php if(isset($other_name_cn)) echo $other_name_cn;?>" name="other_name_cn" placeholder="Herbs' Other Name in CN" />
					</div>
				</fieldset>
				</br><span class="form_break"></br></span>
				
				<!--Family-->
				<fieldset><legend>Family</legend>	
					<!--Family in EN-->			
					<div class="form-group">
						<label>Family-English:</label>
						<input type="text" data-toggle="tooltip" data-placement="right" title="Fillin the Family" class="form-control" value="<?php if(isset($family)) echo $family;?>" name="family" placeholder="Herbs's Family" />
					</div>
					<!--Family in CN-->
					<div class="form-group">
						<label>Family-Chinese:</label>
						<input type="text" data-toggle="tooltip" data-placement="right" title="Fillin the Family in CN" class="form-control" value="<?php if(isset($family_cn)) echo $family_cn;?>" name="family_cn" placeholder="Herbs's Family in CN" />
					</div>
				</fieldset>
				</br><span class="form_break"></br></span>

				<!--Usage Part-->
				<fieldset><legend>Part of Usage</legend>	
					<!--Usage Part in EN-->	
					<div class="form-group">
						<label>Part-English:</label>
						<input type="text" data-toggle="tooltip" data-placement="right" title="Fillin Only One Part of Usage" class="form-control" value="<?php if(isset($part)) echo $part;?>" name="part" placeholder="Herb's Usage Part" />
					</div>
					<!--Usage Part in CN-->
					<div class="form-group">
						<label>Part-Chinese:</label>
						<input type="text" data-toggle="tooltip" data-placement="right" title="Fillin Only One Part of Usage in CN" class="form-control" value="<?php if(isset($part_cn)) echo $part_cn;?>" name="part_cn" placeholder="Herb's Usage Part in CN" />
					</div>
				</fieldset>
				</br><span class="form_break"></br></span>

				<!--Function-->
				<fieldset><legend>Expertise Function</legend>	
					<!--Function in EN-->	
					<div class="form-group">
						<label>Function-English:</label>
						<input type="text" data-toggle="tooltip" data-placement="right" title="Fillin Only One Expertise Function" class="form-control" value="<?php if(isset($function)) echo $function;?>" name="function" placeholder="Herb's Function" />
					</div>
					<!--Function in CN-->
					<div class="form-group">
						<label>Function-Chinese:</label>
						<input type="text" data-toggle="tooltip" data-placement="right" title="Fillin Only One Expertise Function in CN" class="form-control" value="<?php if(isset($function_cn)) echo $function_cn;?>" name="function_cn" placeholder="Herb's Function in CN" />
					</div>
				</fieldset>
				</br><span class="form_break"></br></span>

				<!--Disease-->
				<fieldset><legend>Disease</legend>	
					<!--Disease in EN-->	
					<div class="form-group">
						<label>Disease-English:</label>
						<input type="text" data-toggle="tooltip" data-placement="right" title="Fillin Only One Type of Disease" class="form-control" name="disease" value="<?php if(isset($disease)) echo $disease;?>" placeholder="Disease Treat" >
					</div>
					<!--Disease in CN-->
					<div class="form-group">
						<label>Disease-Chinese</label>
						<input type="text" data-toggle="tooltip" data-placement="right" title="Fillin Only One Type of Disease in CN" class="form-control" name="disease_cn" value="<?php if(isset($disease_cn)) echo $disease_cn;?>" placeholder="Disease Treat in CN" />
					</div>
				</fieldset>
				</br><span class="form_break"></br></span>

				<!--Image-->
				<fieldset><legend>Image</legend>	
					<div class="form-group">
						<?php
							$dir = '../../../pics';
							if(isset($image) && $image != null){
							 echo '<img style="margin: 0% 0% 0% 45%;" width="30%" height="auto" src="'. $dir. '/'. $image. '"  /> </br></br>';
							}
						?>
						<label>Image:</label>	
						<input class="form-control" style=" padding-left: 200;" type="file" name="image" multiple>
					</div>
				</fieldset>
				</br><span class="form_break"></br></span>
				<!--Save, update & delete-->
				<div class="control-group">
					<div class="controls" >
					<?php
						if(isset($mode) && $mode == 1){
           					$m=$_GET['m'];
           			?>
           					<input type="hidden" name="m" value="<?php echo $m;?>">
           			<?php		
							if($m==2){
					?>
			  					<button type="submit" class="btn btn-save" value="Add" onClick="this.form.action='add_herbs_save.php?add_id=<?php echo $herb_id;?>'"><i class="icon-save icon-large"></i>&nbsp;Add</button>
					<?php	
							}/*end if add data m2*/
				            else if($m==3){	
				    ?>
			  					<button type="submit" class="btn btn-save" value="Update"><i class="icon-save icon-large"></i>&nbsp;Update</button>
					<?php	
							}/*end elseif update m=3*/
							else if($m==4){
					?>
								Delete record?
					            <button type="submit" class="btn btn-save" onClick="this.form.action='delete_herbs.php?info_id=<?php echo $info_id;?>'">&nbsp;Yes</button>
					            <button type="submit" class="btn btn-save" onClick="this.form.action='herbs.php'">&nbsp;No</button>
					            <input type="hidden" name="m" value="<?php echo $m;?>" formaction="delete_herbs.php">
					<?php	
							} /*end else delete m=4*/
						}/*end if-else add&update&delete*/
						else{ 
					?>
							<button name="submit" type="submit" class="btn btn-save"><i class="icon-save icon-large"></i>&nbsp;Save</button>
					<?php	
						}/*end else save*/
					?>					
					</div>
				</div>
	   		</form>					
		</div>
    </div>
	<?php
		include("footer.php");
	?>
</body>
</html>