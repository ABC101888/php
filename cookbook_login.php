<?php
	include 'connect.php';
	include 'search.php';

	session_start();

	if($_SESSION['logged_in'] !== "login")
	{
		header("Location: login.php");  
	}
?>

<html>
<head>
	<title>Profile Page</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<meta charset="utf-8">
	<meta charset=""/>
	<link rel="stylesheet" type="text/css" href="profile.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css' integrity='sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ' crossorigin='anonymous'>
	<style>
		.card1{
			display:inline-block; 
			height: 250px; 
			width:200px; 
			margin-bottom: 22px; 
			border-radius: 8px; 
			background-color: white; 
			margin-left: 1em; 
			box-shadow: 0 4px 8px 0 grey;
			float:left;
		}

		.card1:hover {
			box-shadow: 0 8px 16px 0 #00bfff;
		}		

		.button {
		  background-color: #00bfff; /* Green */
		  border: none;
		  border-radius: 5px;
		  color: white;
		  text-align: center;
		  text-decoration: none;
		  font-size: 16px;
		  cursor: pointer;
		}

		.button1 {
		  background-color: #008CBA; 
		  color: white; 
		  border: 2px solid #008CBA;
		}

		.button1:hover {
		  background-color: white;
		  color: #00bfff;
		}
	</style>
	
</head>
<body>
	<div class="header">
		<img src="food-background(top).jpg" style="height:25vh; width:100%">
	</div>
	
	<div class="topnav">
	  	<a href="index_login.php">Home</a>
	  	<a href="#contact">Contact</a>
	  	<a href="index_login.php?#about">About Us</a>
		<a href="index.php" style="float:right">Log Off</a>
		<a href="user_profile.php" style="float:right"><?php echo $_SESSION['username'];?></a>
	</div>
	<br>
	
	<form class="search" action=" " align="center" style="margin:auto;">
  		<input type="text" name="search" placeholder="Search..">
		<button type="submit" name="submit">
        	<i class="fa fa-search"></i>
     	</button>
		<?php if(isset($output['search'])){echo "<font color='red'>".$output['search']."</font>";}?>  
	</form>
	
	<div class="row">
      <?php
		$id = $_GET['id'];
		
		$limit = 1; 
		
    	if (isset($_GET["page"])) {  
			$pg = $_GET["page"];  
		}  
    	else {  
      	$pg=1;  
		};   
  
    	$start = ($pg-1) * $limit;   
  
    	$sql = "SELECT * FROM cookbook 
		JOIN cookbook_has_recipes ON cookbook.bookID = cookbook_has_recipes.cookbook_bookID
		JOIN recipes ON cookbook_has_recipes.recipes_recipeID = recipes.recipeID
		WHERE cookbook.bookID ='$id' LIMIT $start, $limit"; 
		
    	$result = mysqli_query($con, $sql);
		
		echo'<br><br>';
		
		while($row = mysqli_fetch_array($result)) 
		{
			echo '<div class="card1"><a href="recipe_login.php?id='.$row['recipeID'].'" style="text-decoration: none">
					<img src="data:image/jpeg;base64,'.base64_encode( $row['image']).'"style="height:150px; width: 140px; transform: translate(15%, 15%); border-radius: 4px; border: 2px double #00bfff" align="center" hspace="10"/>
					<br>
					<br>
					<br>
					<span style="color: black; text-decoration: none; margin-left:30px"><b>'.$row['recipeTitle'].'</b></span>
					<br>
					</a>
					</div>';
		}
      ?>
	</div>

	<li class="pagination"> 
      <?php   
		$id = $_GET['id'];
		
        $sql1 = "SELECT COUNT(*) FROM cookbook 
		JOIN cookbook_has_recipes ON cookbook.bookID = cookbook_has_recipes.cookbook_bookID
		JOIN recipes ON cookbook_has_recipes.recipes_recipeID = recipes.recipeID
		WHERE cookbook.bookID ='$id'";   
		
    	$result1 = mysqli_query($con, $sql);
		
		$row1 = mysqli_fetch_array($result1);
		$total_records = $row1[0];   
          
        // Number of pages required. 
        $total_pages = ceil($total_records / $limit);   
        $pagLink = " ";                         
        for ($i=1; $i<=$total_pages; $i++) { 
          if ($i==$pg) { 
              $pagLink .= "<li class='active'><a href='cookbook_login.php?id=".$id."page=".$i."'>".$i."</a></li>"; 
          }             
          else  { 
              $pagLink .= "<li><a href='cookbook_login.php?id=".$id."page=".$i."'>".$i."</a></li>";   
          } 
        };   
        echo $pagLink;   
      ?> 
      </li> 

	<br><br>
	<span><a href="cookbook_gallery_login.php" style='font-size: 16px; text-decoration: none'><b>Back to Cookbook Gallery</b></a></span>
	
	<div class="footer">
		<div style="text-align:center">
			<h3 id="contact" style="font-size: 24px; margin:8px">Contact Me</h3>
			<p style="font-size: 14px; margin:4px;">University of Pittsburgh</p>
			<p style="font-size: 14px; margin:4px;"> Joc101@pitt.edu</p>
			<span class="footer_text" style="font-size: 10px;">Copyright © 2019 All Rights Reserved. </span>
		</div>
	</div>
		
</body>
</html>