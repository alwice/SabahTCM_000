<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" conetent="text/html; charset=UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php
		$_SESSION['pages']="images.php";
		$page_title="images";
		include("menu.php");
		include("compareImages.php");
	?>
	<title>Images - SabahTCM</title> 
</head>
<body>
	<div id="body">
		<div id="main">
			</br> 
			</br>
			<div class="content" style="margin-right: 15%">
				<h3>Search Herb</h3>
				</br>
				<div style="background:lightblue; width:80%; text-align: center">
				*****  Please make sure file uploaded is in format of .JPG or .PNG  *****
				</div>
				</br>
				
				<?php
					if(!isset($_POST['upload'])) //function for clearing temp image file
					{
						//delete the all compared file 
						$files = glob('../../../upload/*'); // get all file names
						foreach($files as $file){ // iterate files
							if(is_file($file))
						    unlink($file); // delete file
						}
					}
		
					if(isset($_POST['upload'])){
						$file_name= $_FILES['file']['name'];
						$file_type= $_FILES['file']['type'];
						$file_size= $_FILES['file']['size'];
						$file_tem_loc= $_FILES['file']['tmp_name'];
						$file_store= "../../../upload/".$file_name;
					
						if(move_uploaded_file($file_tem_loc,$file_store)){
				?>
							<div style="background:lightgreen; width:130px;">
								<p style="color:black;text-align: center">Image Uploaded</p>
							</div>
							</br>
				<?php
						}/*end if move*/ 
						else{
				?>
						<div style="background:red; width:220px;">
							<p style="color:white; text-align: center">Please Choose Image File First</p>
						</div>
						</br>
				<?php
						}/*end else if move*/
					}/*end if upload*/
				?>	
					
				<form action="" method="POST" enctype="multipart/form-data">
					<label>Please select image file : </label>
					<input style="display:inline" type="file" name="file" accept=".jpg,.png"/>
					<button style="float:right;" name="upload" type="submit" class="btn btn-info"><i class="icon-upload icon-large"></i>&nbsp;Upload Image</button>
				</form>
				</br></br>
				<?php
					$folder = "../../../upload/";
					if (is_dir($folder)){
						if($open = opendir ($folder)){
							while(($file = readdir($open)) != false){
								if ($file =='.' || $file =='..') continue;
									echo '<img id="herbImg" style="display:block; margin-left:auto; margin-right:auto; object-fit:cover;" src="../../../upload/'.$file.'" width="30%" height="auto" onclick="enlarge();"/>';
									echo '<div id="enlargeImg"> 
											<span class="closeImg">&times;</span>
											<img id="bigImg">
											<div id="caption"></div>
							  			</div>';
								$picUpload = $folder . $file;
								$image1 = $picUpload; //name for uploaded image			
								$herb_information=mysqli_query($conn,"SELECT * FROM herb_list")or die(mysqli_error($conn));
							
								while($data1=mysqli_fetch_array($herb_information)){
									$herbs_id=$data1['herb_id'];
									$herb_name=$data1['local_name'];
									$image=$data1['image'];
									$folderHerb="../../../pics/";
									$picDatabase= $folderHerb . $image;	
									$image2 = $picDatabase; // itteration comparision for all the image in database
								
									$compareMachine = new compareImages($image1);
									$diff = $compareMachine->compareWith($image2);
									If($diff<22){
				?>
										<p>Herb Found</p>
										Herb Name:
										<a href="herbs.php?id=<?php echo $herbs_id;?>&amp;herb=<?php echo $herb_name;?>"><?php echo $herb_name;?>&nbsp;&nbsp;&nbsp;<i class="icon-expand icon-medium">&nbsp; Detail</i></a>
										</br>	
				<?php
										break;
									}/*end <11*/		
								}/*end while fetch data*/
								// Displying the herb do not found
								If(isset($diff) && $diff>22){
				?>
									<p>Herb Not Found</p>
				<?php			
								}/*end If >11*/
							}/*end while readdir*/	
							closedir($open);
						}/*end if opendir*/
					}/*end is_dir*/	
				?>	
			</div>
		</div>	
	</div>
	<?php
		include("footer.php");
	?>
</body>
</html>