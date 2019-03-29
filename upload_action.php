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
		
		$ingredients = "<pre>";
		$ingredients .= $_POST['ingredients'];
		$ingredients .= "</pre>";
		
		$directions = "<pre>";
		$directions .= $_POST['directions'];
		$directions .= "</pre>";

		if(count($output) == 0)
        {
			$userID = $_SESSION['userID'];
			
			$check = getimagesize($_FILES["image"]["tmp_name"]);
			if($check !== false)
			{
				$image = $_FILES['image']['tmp_name'];
				$imgContent = addslashes(file_get_contents($image));
			}
			
			$title = filter_var($_POST['title'], FILTER_DEFAULT);
			$cat = filter_var($_POST['category'], FILTER_DEFAULT);
			$desc1 = filter_var($desc, FILTER_DEFAULT);
			$ingredients1 = filter_var($ingredients, FILTER_DEFAULT);
			$directions1 = filter_var($directions, FILTER_DEFAULT);
			$prep = filter_var($_POST['prep'], FILTER_DEFAULT);
			$cook = filter_var($_POST['cook'], FILTER_DEFAULT);
			$serve = filter_var($_POST['serve'], FILTER_SANITIZE_NUMBER_INT);
		
			$title1 = mysqli_real_escape_string($con, $title);
			$cat1 = mysqli_real_escape_string($con, $cat);
			$desc2 = mysqli_real_escape_string($con, $desc1);
			$ingredients2 = mysqli_real_escape_string($con, $ingredients1);
			$directions2 = mysqli_real_escape_string($con, $directions1);
			$prep1 = mysqli_real_escape_string($con, $prep);
			$cook1 = mysqli_real_escape_string($con, $cook);
			$serve1 = mysqli_real_escape_string($con, $serve);
			$view = mysqli_real_escape_string($con, $_POST['view']);

			$sql = "INSERT INTO recipes (recipeID, image, recipeTitle, recipeDesc, ingredients, directions, prepTime, cookTime, servings, view, r_catID, r_userID) VALUES ('$recipeID', '$imgContent', '$title1','$desc2','$ingredients2','$directions2','$prep1','$cook1','$serve1', '$view', '$cat1', '$userID')";
			
			$results = mysqli_query($con, $sql);
			
			header("Location: index_login.php");
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
		
		$title = $_POST['title'];
		if (isset($_POST['title']) && !preg_match('/([a-zA-Z0-9\s\&\'\-\/\|\~\:\[\]\(\)]+)/', $title)) 
		{
			$output['title'] = 'Title is invalid.';
        }
		
		$desc = $_POST['desc'];
		if ((is_null($_POST['desc'])) || (!preg_match('/(([a-zA-Z0-9\s\!\#\$\%\&\'\*\+\-\=\?\^\_\`\{\|\}\~\@\.\[\]\/\:\;\,])+)/', $desc))) 
        {
			$output['desc'] = 'Invalid Description!';
        }
		
		$ingredients = $_POST['ingredients'];
		if ((is_null($_POST['ingredients'])) || (!preg_match('/(([a-zA-Z0-9\s\!\#\$\%\&\'\*\+\-\=\?\^\_\`\{\|\}\~\@\.\[\]\/\:\;\,])+)/', $ingredients))) 
        {
			$output['ingredients'] = 'Entered ingredients are invalid!';
        }
		
		$directions = $_POST['directions'];
		if ((is_null($_POST['directions'])) || (!preg_match('/(([a-zA-Z0-9\s\!\#\$\%\&\'\*\+\-\=\?\^\_\`\{\|\}\~\@\.\[\]\/\:\;\,])+)/', $directions))) 
        {
			$output['directions'] = 'Entered directions are invalid!';
        }
		
		$prep = $_POST['prep'];
		if (isset($_POST['prep']) && !preg_match('/([a-zA-Z0-9\s\&\-\+\|\~\(\)]+)/', $prep)) 
		{
			$output['prep'] = 'Entered prep time is invalid.';
        }

		$cook = $_POST['cook'];
		if (isset($_POST['cook']) && !preg_match('/([a-zA-Z0-9\s\&\-\+\|\~\(\)]+)/', $cook)) 
		{
			$output['cook'] = 'Entered cook time is invalid.';
        }
		
		$serve = $_POST['serve'];
		if (isset($_POST['serve']) && !preg_match('/([0-9\s\-]+)/', $serve)) 
		{
			$output['serve'] = 'Entered serving size is invalid.';
        }
		
		if($_POST['category'] == "N/A")
        {
			$output['category'] = "Please select Category!";
        }
	}
?>