<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" conetent="text/html; charset=UTF-8">
	<?php
		$_SESSION['pages']="images.php";
		$page_title="images";
		include("menu.php");
		include("compareImages.php");
	?>
	<title>图片 - SabahTCM</title> 
</head>
<body>
	<div id="body">
		<div id="main">
			</br> 
			</br>
			<div class="content" style="margin-right: 15%">
				<h3>搜索药草</h3>
				</br>
				<div style="background:lightblue; width:80%; text-align: center;">
				*****  请确认上传文档格式是 .JPG 或者 .PNG  *****
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
								<p style="color:black;text-align: center">图片上传成功</p>
							</div>
							</br>
				<?php
						}/*end if move*/ 
						else{
				?>
						<div style="background:red; width:220px;">
							<p style="color:white; text-align: center">请先选择图片文档</p>
						</div>
						</br>
				<?php
						}/*end else if move*/
					}/*end if upload*/
				?>	
					
				<form action="" method="POST" enctype="multipart/form-data">
					<label>请选择图片文档： </label>
					<input style="display:inline" type="file" name="file" accept=".jpg,.png"/>
					<button style="float:right;" name="upload" type="submit" class="btn btn-info"><i class="icon-upload icon-large"></i>&nbsp;上传图片</button>
				</form>
				</br></br>
				<?php
					$folder = "../../../upload/";
					if (is_dir($folder)){
						if($open = opendir ($folder)){
							while(($file = readdir($open)) != false){
								if ($file =='.' || $file =='..') continue;
									echo '<img style="margin-left:220px" src="../../../upload/'.$file. '" width="350" height="350" >';
								$picUpload = $folder . $file;
								$image1 = $picUpload; //name for uploaded image			
								$herb_information=mysqli_query($conn,"SELECT * FROM herb_list")or die(mysqli_error($conn));
							
								while($data1=mysqli_fetch_array($herb_information)){
									$herbs_id=$data1['herb_id'];
									$herb_name=$data1['local_name_cn'];
									$image=$data1['image'];
									$folderHerb="../../../pics/";
									$picDatabase= $folderHerb . $image;	
									$image2 = $picDatabase; // itteration comparision for all the image in database
								
									$compareMachine = new compareImages($image1);
									$diff = $compareMachine->compareWith($image2);
									If($diff<22){
				?>
										<p>草药查获</p>
										草药名：
										<a  href="herbs.php?id=<?php echo $herbs_id;?>&amp;herb=<?php echo $herb_name;?>"><?php echo $herb_name; ?>&nbsp;&nbsp;&nbsp;<i class="icon-expand icon-medium">&nbsp; 详情</i></a>
										</br>	
				<?php
										break;
									}/*end <11*/		
								}/*end while fetch data*/
								// Displying the herb do not found
								If(isset($diff) && $diff>22){
				?>
									<p>草药查询失败</p>
				<?php			
								}/*end If >11*/
							}/*end while readdir*/	
							closedir($open);
						}/*end if opendir*/
					}/*end is_dir*/	
				?>	
				</br></br>
			</div>
		</div>	
		</br></br>
	</div>
	<?php
		include("footer.php");
	?>
</body>
</html>