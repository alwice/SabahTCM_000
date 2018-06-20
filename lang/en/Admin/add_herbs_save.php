<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" conetent="text/html; charset=UTF-8">
	</head>
<body>
<?php 
	include("db_conn.php");

	$herb_id=$_POST['herb_id'];
	$info_id=$_POST['info_id'];
	$sci_name_gs=$_POST['sci_name_gs'];
	$sci_name_var=isset($_POST['sci_name_var']) ? $_POST['sci_name_var'] : NULL;	
	$sci_name_cv=$_POST['sci_name_cv'];
					
	$herb_name=isset($_POST['herb_name']) ? $_POST['herb_name'] : NULL;	
	$other_name=isset($_POST['other_name']) ? $_POST['other_name'] : NULL;
	$family=isset($_POST['family']) ? $_POST['family'] : NULL;
	$part=isset($_POST['part']) ? $_POST['part'] : NULL;
	$function=isset($_POST['function']) ? $_POST['function'] : NULL;
	$disease=isset($_POST['disease']) ? $_POST['disease'] : NULL;

	$herb_name_cn=isset($_POST['herb_name_cn']) ? $_POST['herb_name_cn'] : NULL;	
	$other_name_cn=isset($_POST['other_name_cn']) ? $_POST['other_name_cn'] : NULL;
	$family_cn=isset($_POST['family_cn']) ? $_POST['family_cn'] : NULL;
	$part_cn=isset($_POST['part_cn']) ? $_POST['part_cn'] : NULL;
	$function_cn=isset($_POST['function_cn']) ? $_POST['function_cn'] : NULL;
	$disease_cn=isset($_POST['disease_cn']) ? $_POST['disease_cn'] : NULL;
	
	$mode = $_POST['mode'];
	$add_id = isset($_GET['add_id']) ? $_GET['add_id'] : NULL;	
	$m = isset($_POST['m']) ? $_POST['m'] : 0;

	// Upload Picture Algo start
	$target = "../../../pics/";
	$target = $target . basename($_FILES['image']['name']);
	$image=basename($_FILES['image']['name']);
	//Writes the image to the server
	if(move_uploaded_file($_FILES['image']['tmp_name'], $target)){
	    //Tells you if its all ok
	    echo "The file ".basename($_FILES['image']['name'])." has been uploaded, and your information has been added to the directory.";	
		// Upload Picture Algo End			
	} 
	else{
	    //Gives and error if its not
	    echo "Sorry, there was a problem uploading your file.";
	} 
	
	if($mode==1){
		if($m==3){/*update*/
			$sql="UPDATE herb_info SET usage_part='$part', function='$function', disease='$disease', usage_part_cn='$part_cn', function_cn='$function_cn', disease_cn='$disease_cn' WHERE info_id='$info_id'";
			mysqli_query($conn,$sql)or die(mysqli_error($conn));
		
			$sql3="UPDATE herb_list SET scientific_gen_spec='$sci_name_gs', scientific_var='$sci_name_var', scientific_cv='$sci_name_cv', local_name='$herb_name', other_name='$other_name', family='$family', local_name_cn='$herb_name_cn', other_name_cn='$other_name_cn', family_cn='$family_cn' WHERE herb_id='$herb_id'";
			mysqli_query($conn,$sql3)or die(mysqli_error($conn));
			
			if($image!=NULL){
				$sql2="UPDATE herb_list SET image='$image' WHERE local_name='$herb_name'";
				mysqli_query($conn,$sql2)or die(mysqli_error($conn));
			}
			echo "<script>alert('Herb\'s Information Updated.'); location.href='herbs.php' </script>";
		}/*end update m=3*/

		else if($m==2){/*add herb's data*/
			$sql="INSERT INTO herb_info (herb_id, usage_part, function, disease, usage_part_cn, function_cn, disease_cn)
				VALUES('$add_id', '$part', '$function', '$disease', '$part_cn', '$function_cn', '$disease_cn')";
			mysqli_query($conn,$sql)or die(mysqli_error($conn));
			echo "<script>alert('Herb\'s Information Saved.'); location.href='herbs.php' </script>";
		}/*end add herb's data m=2*/
	}

	else{/*insert new mode*/
		/*checking if the scientific name ard exist in db or nt*/
		$sql_sci="SELECT herb_id, local_name FROM herb_list WHERE scientific_gen_spec='$sci_name_gs' AND scientific_var='$sci_name_var' AND scientific_cv='$sci_name_cv'";
		$sql_sci_name=mysqli_query($conn,$sql_sci) or die(mysqli_error($conn));
		while($row=mysqli_fetch_assoc($sql_sci_name)){
			$id=$row['herb_id'];
			$herb=$row['local_name'];
			echo "<script>alert('Herb\'s Scientific Name is existed. Please add record or update record.'); location.href='herbs.php?id=".$id."&herb=".$herb."' </script>";
		}
		
		//Writes the information to the database
		$sql2="INSERT INTO herb_list (scientific_gen_spec, scientific_var, scientific_cv, image, local_name, other_name, family, local_name_cn, other_name_cn, family_cn)
			VALUES('$sci_name_gs', '$sci_name_var', '$sci_name_cv', '$image', '$herb_name', '$other_name', '$family', '$herb_name_cn', '$other_name_cn', '$family_cn')";
		mysqli_query($conn,$sql2)or die(mysqli_error($conn));
		$lastID = mysqli_insert_id($conn);
		/*get the primarykey*/
		
		$sql="INSERT INTO herb_info (herb_id, usage_part, function, disease, usage_part_cn, function_cn, disease_cn)
			VALUES('$lastID', '$part', '$function', '$disease', '$part_cn', '$function_cn', '$disease_cn')";
		mysqli_query($conn,$sql)or die(mysqli_error($conn));
		echo "<script>alert('Herb\'s Information Saved.'); location.href='herbs.php' </script>";
	}/*end insert mode*/
?>	
</body>
</html>