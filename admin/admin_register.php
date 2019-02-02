<?php
include_once('../config.php');
$phone = $_SESSION['phone'];
	
if(isset($_SESSION['phone']) =='')
{
header('location:../login.php');
}

if(isset($_REQUEST['chk']))
{
$mail  = $_REQUEST['chk'];
$query = mysqli_query($con, "select * from tbl_register where  email = '$mail'");
$result = mysqli_fetch_array($query);
$image = $result['image'];

}

if(isset($_REQUEST['register']))
{

$mail = $_REQUEST['email'];
$newroll = $_REQUEST['rollno'];
$newenroll = $_REQUEST['enrollno'];
$newdate = $_REQUEST['date'];
if(mysqli_query($con, "UPDATE tbl_register set rollno = '$newroll'  , enrollno = '$newenroll' , date = '$newdate' , verified = '1' where email = '$mail'") or die(mysqli_error()))
	{
	?> <script>alert("Student Registered Successfully..!!");</script><?php
	}
	else
	{
	?> <script>alert("Please Try Again Later..!!");</script><?php
	}
}




?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="css/reset.css" type="text/css" media="all">
<link rel="stylesheet" href="css/style.css" type="text/css" media="all">
<script type="text/javascript" src="js/jquery-1.4.2.min.js" ></script>
<script type="text/javascript" src="js/cufon-yui.js"></script>
<script type="text/javascript" src="js/cufon-replace.js"></script>
<script type="text/javascript" src="js/Myriad_Pro_300.font.js"></script>
<script type="text/javascript" src="js/Myriad_Pro_400.font.js"></script>
<script type="text/javascript" src="js/script.js"></script>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body> 
<h2>Student's <span>Information</span></h2>
        <form id="contacts-form" ><div align = right position = relative><img src = "../<?php echo $image;?>" alt = "" height = 200 width = 250 align = right></img></div>
          <fieldset>
          <div class="field">
              <label>Student's Name: </label>
              <input type="text" type="text" value="<?php echo $result['fname']." ". $result['lname'];?>" name = "name" readonly="readonly"/>
          </div>
            <div class="field">
              <label>Student's E-mail:</label>
              <input type="email" value="<?php echo $result['email'];?>" name = "email" readonly="readonly"/>
            </div>
			<div class="field">
              <label>Student's Roll No:</label>
              <input type="text" value="" name = "rollno" />
            </div>
			<div class="field">
              <label> Enrollment No:</label>
              <input type="text" value ="" name = "enrollno" />
            </div>
			<div class="field">
              <label>Date of Registration:</label>
              <input type= "text" value= "" name = "date" />
            </div>
            <div class="field">
			  <label>Student's Contact:</label>
              <input type="text" value="<?php echo $result['phone'];?>" name = "contact" readonly="readonly"/>
            </div>
			<div class = "field">
              <label>Student's Address:</label>
              <input type="text" value="<?php echo $result['address'];?>" name = "address" readonly="readonly"/>
            </div><br>
			<div align = right>
              
              <input type="submit" value = "Register Student" name = "register" >
            </div>
           
           
          </fieldset>
        </form>        
</body>
</html>
