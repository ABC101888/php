<?php 
	ini_set("display_errors","on");
error_reporting(E_ALL);
	include ('connect.php');

    $output = array();

	if(isset($_POST['submit']))
	{
		validate_input();
		
		$username = $_POST['username'];
		$password = $_POST['password'];	
				
		$sql_u = "SELECT username FROM users WHERE username='$username'";
		$res_u = mysqli_query($con, $sql_u);
		$sql_p = "SELECT password FROM users WHERE password='$password'";
		$res_p = mysqli_query($con, $sql_p);
		
		if(count($output) == 0)
		{
			if (mysqli_num_rows($res_u) != 1) 
			{
				$name_error = "User doesn't exist!"; 
			}
			elseif(mysqli_num_rows($res_p) != 1)
			{
				$pass_error = "Incorrect Password!"; 
			}
			else
			{
				ob_start();	
				header('Location: http://www.example.com/');
				exit;
			}
		}
	}

	function validate_input()
		{
            global $output;
            /*Validation for name field */
			$username = $_POST['username'];
            if (isset($_POST['username']) && !preg_match('/([a-zA-Z0-9\!\#\$\%\&\'\*\+\-\=\?\^\_\`\{\|\}\~\@\.\[\]]+)/', $username)) 
			{
                $output['username'] = 'Username is invalid.';
            }
            /*Validation for phone number field */
            $password = $_POST['password'];
            if ((is_null($_POST['password'])) || (!preg_match('/([a-zA-Z0-9\!\#\$\%\&\'\*\+\-\=\?\^\_\`\{\|\}\~\@\.\[\]]+)/', $password))) 
            {
                $output['password'] = 'Password is invalid!';
            }
        }
?>
