<?php
	include 'connect.php';

	$output = array();

	$image_err = array();

  	if (isset($_POST['submit']))
	{
		validate_input();
						
		$desc = "<pre>";
		$desc .= $_POST['desc'];
		$desc .= "</pre>";
		
		if(count($output) == 0)
        {
			$userID = $_SESSION['userID'];
			
			$check = getimagesize($_FILES["image"]["tmp_name"]);
			if($check !== false)
			{
				$image = $_FILES['image']['tmp_name'];
				$imgContent = addslashes(file_get_contents($image));
			}
					
			$name = mysqli_real_escape_string($con, $_POST['name']);
			$desc1 = mysqli_real_escape_string($con, $desc);
			$view = mysqli_real_escape_string($con, $_POST['view']);

			$sql = "INSERT INTO cookbook (bookCover, bookName, bookDesc, pvt_p, cb_userID) VAlUES ('$imgContent', '$name','$desc1','$view','$userID')";
			
			$results = mysqli_query($con, $sql);
			
			header("Location: user_profile.php");
			exit();
		}
	}

	function validate_input()
	{
		global $output;
		global $image_err;

		$image_size = $_FILES['image']['size'];
		$image_ext = strtolower(end(explode('.',$_FILES['image']['name'])));

		$extensions = array("jpeg","jpg","png");

		if(in_array($image_ext,$extensions)=== false)
		{
			$image_err['file']="Extension is not allowed, please choose a JPEG or PNG file.";
		}
			
		if($image_size > 16097152)
		{
			$image_err['size']='File size must not exceed 16 MB';
		}
		
		$name = $_POST['name'];
		if (isset($_POST['name']) && !preg_match('/([a-zA-Z0-9\s\&\'\-\/\|\~\:\[\]\(\)]+)/', $name)) 
		{
			$output['name'] = 'Title is invalid.';
        }
		
		$desc = $_POST['desc'];
        if (strlen($_POST['desc']) == 0 || !preg_match('/(.*?)/', $desc))
		{
            $output['desc'] = 'Entered description is invalid!';
		}
	}
?>
?>