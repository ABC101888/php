<?php
	if (isset($_POST['submit']))
	{
		if(count($output) == 0)
        {
				$id = $_GET['id'];
				$cookbook = $_POST['cookbook'];
			
				$recipeID = mysqli_real_escape_string($con, $id);
				$bookID = mysqli_real_escape_string($con, $cookbook);

				$sql = "INSERT INTO cookbook_has_recipes (cookBook_bookID, recipes_recipeID) VALUES ('$bookID', '$recipeID')";
				
				$results = mysqli_query($con, $sql);
				
				header("Location: recipe_login.php?id=".$id);
				exit();
		}
	}
?>

						