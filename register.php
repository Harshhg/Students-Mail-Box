<?php

include_once('config.php');

if(isset($_REQUEST['submit']))
{
	$name = $_REQUEST['fullname'];
	$email = $_REQUEST['email'];
	$password = $_REQUEST['password'];
	$DOBdd = $_REQUEST['DOBdd'];
	$DOBmm = $_REQUEST['DOBmm'];
	$DOByy = $_REQUEST['DOByy'];
	$gender = $_REQUEST['gender'];
	$stream = $_REQUEST['stream'];
	$department = $_REQUEST['department'];
	$semester = $_REQUEST['semester'];
	 
	$date = $DOBdd."-".$DOBmm."-".$DOByy;
	/*echo($date);
	$image=$_FILES['image']['name'];
	$tmpimage=$_FILES['image']['tmp_name'];
	$path="image/".$image;
	
	
	    move_uploaded_file($tmpimage,$path);*/
		
		$query= mysqli_query($con, "select * from all_emails where Email = '$email' " );
		$rows = mysqli_num_rows($query);
		if($rows>0)
		{
					?> <script>alert("Already Registered");   </script><?php 
				 
				
		}
		else
		{	
				$query= mysqli_query($con, "INSERT INTO all_emails values('$email','', 'student')");
				$query= mysqli_query($con, "select * from all_emails where Email = '$email' " );
				$result = mysqli_fetch_array($query);
				$id = $result['id'];
				if(mysqli_query($con, "INSERT INTO `register`(`Name`, `Email`, `Password`, `DOB`, `Gender`, `Stream`, `Department`, `Semester`, `id`) VALUES ('$name', '$email', '$password', '$date', '$gender', '$stream', '$department', '$semester', '$id' )  " ))
				{
					$get_id = mysqli_query($con,"SELECT id from register where email = '$email'");
					$get_id_result = mysqli_fetch_array($get_id);
					$id = $get_id_result['id'];
					if(mysqli_query($con, " INSERT INTO registered_students values('$id' , '0' ,'0') "))
	    				{?> <script>alert("Successfully Registered!");  window.open('index.php');</script><?php }
	  			}
	  		else
	  		{
	  	?> <script>alert("Please Try again Later..");</script><?php 
	  	}
	
	}

}

?>
 
<!DOCTYPE html>
<!DOCTYPE html>
<html lang="en" >

<head>
  <meta charset="UTF-8">
  <title>Sign Up Form</title>
  
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">

  <link rel='stylesheet' href='http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>

      <link rel="stylesheet" href="css/regstyle.css">

      <style>
       body 
       {
  
     background: url('images/bg.jpg') no-repeat 0% 87% fixed;
        }
      </style>
</head>

<body>

  
<div class="container">
 <form  method="post" enctype="multipart/form-data">
    <div class="row">
      <h4>Profile Details</h4>
      <div class="input-group input-group-icon">
        <input type="text" placeholder="Full Name" name ="fullname"/>
        <div class="input-icon"><i class="fa fa-user"></i></div>
      </div>
      <div class="input-group input-group-icon">
        <input type="email" placeholder="Email Adress" name ="email"/>
        <div class="input-icon"><i class="fa fa-envelope"></i></div>
      </div>
      <div class="input-group input-group-icon">
        <input type="password" placeholder="Password" name ="password"/>
        <div class="input-icon"><i class="fa fa-key"></i></div>
      </div>
    </div>
    <div class="row">
      <div class="col-half">
        <h4>Date of Birth</h4>
        <div class="input-group">
          <div class="col-third">
            <input type="text" placeholder="DD" name ="DOBdd"/>
          </div>
          <div class="col-third">
            <input type="text" placeholder="MM" name ="DOBmm"/>
          </div>
          <div class="col-third">
            <input type="text" placeholder="YYYY" name ="DOByy"/>
          </div>
        </div>
      </div>
      <div class="col-half">
        <h4>Gender</h4>
        <div class="input-group">
          <input type="radio" name="gender" value="male" id="gender-male"/>
          <label for="gender-male">Male</label>
          <input type="radio" name="gender" value="female" id="gender-female"/>
          <label for="gender-female">Female</label>
        </div>
      </div>
    </div>
    <div class="row">
      <h4>Department</h4>
      <div class="input-group">
        <input type="radio" name="stream" value="cs" id="payment-method-card" checked="true"/>
        <label for="payment-method-card"><span><i class="fa fa-cc-visa"></i>Computer Science</span></label>
        <input type="radio" name="stream" value="others" id="payment-method-paypal"/>
        <label for="payment-method-paypal"> <span><i class="fa fa-cc-paypal"></i>Others</span></label>
      </div>
      <div class="input-group input-group-icon">
        <input type="text" placeholder="Enter Your Department" name ="department"/>
        <div class="input-icon"><i class="fa fa-credit-card"></i></div>
      </div>
      <div class="col-half">
        <div class="input-group input-group-icon">
          
          <select name ="semester">
            <option>Semester</option>
                         <option value ="I">I</option>
			<option value ="II">II</option>
			<option value ="III">III</option>
			<option value ="IV">IV</option>
			<option value ="V">V</option>
			<option value ="VI">VI</option>
          </select>
           
        </div>
      </div>
    </div>
    <div class="row">
      <h4>Terms and Conditions</h4>
      <div class="input-group">
        <input type="checkbox" id="terms"/>
        <label for="terms">I accept the terms and conditions for signing up to this service, and hereby confirm I have read the privacy policy.</label>
		
      </div><input type = "Submit" name = "submit" />
    </div>
  </form><br><a href = "index.php">  <center>Already have an account? Click to login </center></a>
</div>
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

  

    <script  src="js/index.js"></script>




</body>

</html>
