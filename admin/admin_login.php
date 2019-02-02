<?php

include_once('../config.php');
if(isset($_REQUEST['submit']))
{
$email = $_REQUEST['email'];
$password = $_REQUEST['password'];
$query= mysqli_query($con, "select * from faculty where Email = '$email'  and Password = '$password' " );
$rows = mysqli_num_rows($query);
if($rows>0)
	{
		$result = mysqli_fetch_array($query);
		$id = $result['id'];
		$query_check= mysqli_query($con, "select * from registered_faculty where id = '$id' and Approved = '1'" );
		$rows = mysqli_num_rows($query_check);

		if($rows>0)
			{
					session_start();
					$_SESSION['email'] = $email;
					header('location:admin_home.php');
			
			}
		else
		{
			header('location:../pending.php');
		}
	}
	else
	{
		?> <script>alert("Invalid UserName or Password");</script><?php
	}

}

?>

<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Login form using HTML5 and CSS3</title>
  
  
  
      <link rel="stylesheet" href="css/style3.css">

  
</head>

<body>
 
<div class="container">
	<section id="content">
		<form action="">
			<h1>Admin Login </h1>
			<div>
				<input type="text" placeholder="Email / Phone" required="" id="username" name = "email"/ >
			</div>
			<div>
				<input type="password" placeholder="Password" required="" id="password" name = "password"/>
			</div>
			<div>
				<input type="submit" value="Log in"  name = "submit"/>
				<a href="../index.php">Login as Student</a>
					</div>
		</form>
		<!-- form -->
		<div class="button">
			
		</div><!-- button -->
	</section><!-- content -->
</div><!-- container -->
</body>
  
    <script  src="js/index.js"></script>


</html>
