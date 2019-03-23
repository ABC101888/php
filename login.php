<?php
	session_start();
	include ('login_action.php');
?>

<html>
<head>
	<title>Index Page</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<meta charset="utf-8">
	<meta charset=""/>
	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="stylesheet" type="text/css" href="signup.css">
</head>
<body>
	<div class="topnav">
	  	<a href="index.php?#home">Home</a>
	  	<a href="#contact">Contact</a>
	  	<a href="index.php?#about">About Us</a>
		<a href="login.php" style="float:right">Login</a>
		<a href="signup.php" style="float:right">Sign Up</a>
	</div>
	<br>
	<form method="POST" action="login_action.php">
		<div class="container">
			<h1>Login</h1>
			<hr>
			<label for="email"><b>Username</b></label>
			<input type="text" placeholder="Enter Username" name="username" value="<?php if(isset($_POST['username'])){echo $_POST['username'];}?>">
			<br>
			<?php if (isset($name_error)): ?>
				<span><?php echo "<font color='red'>".$name_error."</font>"; ?></span>
			<?php endif ?>
			<?php echo "<font color='red'>".$output['username']."</font>";?>
			<br>

			<label for="psw"><b>Password</b></label>
			<input type="text" placeholder="Enter Password" name="password">
			<br>
			<?php if (isset($pass_error)): ?>
				<span><?php echo "<font color='red'>".$pass_error."</font>"; ?></span>
			<?php endif ?>
			<?php echo "<font color='red'>".$output['password']."</font>";?>
			<br/>
			
			<hr>
			<p>By having an account you agree to our <a href="#">Terms & Privacy</a>.</p>

			<input type="submit" name="submit" value="Sign In" class="registerbtn">
		</div>
	
		<div class="container signin">
			<p>Don't have an account? <a href="signup.php">Register</a>.</p>
		</div>
	</form>

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

<?php
      session_destroy(); 
?>