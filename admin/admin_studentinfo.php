 <?php
session_start();
include_once('config.php');
$email = $_SESSION['email'];

 
if(isset($_REQUEST['log']) == 'out')
	{
	session_destroy();
	header('location:admin_login.php');
	}

if(isset($_SESSION['email']) =='')
{
header('location:admin_login.php');
}

if(isset($_REQUEST['id']))
{
$id1 = $_REQUEST['id'];
$id_query = mysqli_query($con, "select * from register where id  = '$id1'");
$id_result = mysqli_fetch_array($id_query);
 	 
}

if(isset($_REQUEST['approve']))
{ 
$id1 = $_REQUEST['h'];

if(mysqli_query($con, "update registered_students set Approved = '1', Approved_By = (select id from faculty where email= '$email') where id = '$id1'"))
	{
	?> <script>alert("Student Approved");</script><?php
		header('location:admin_home.php');
	}
	else
	{
	}
}	

?>
 
<!DOCTYPE html>
<html lang="en">
<head>
<title>Student's Site</title>
<meta charset="utf-8">
<link rel="stylesheet" href="css/reset.css" type="text/css" media="all">
<link rel="stylesheet" href="css/style.css" type="text/css" media="all">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
 <link rel="stylesheet" href="css/tablestyle.css">
<script type="text/javascript" src="js/jquery-1.4.2.min.js" ></script>
<script type="text/javascript" src="js/cufon-yui.js"></script>
<script type="text/javascript" src="js/cufon-replace.js"></script>
<script type="text/javascript" src="js/Myriad_Pro_300.font.js"></script>
<script type="text/javascript" src="js/Myriad_Pro_400.font.js"></script>
<script type="text/javascript" src="js/script.js"></script>
<!--[if lt IE 7]>
<link rel="stylesheet" href="css/ie6.css" type="text/css" media="screen">
<script type="text/javascript" src="js/ie_png.js"></script>
<script type="text/javascript">ie_png.fix('.png, footer, header nav ul li a, .nav-bg, .list li img');</script>
<![endif]-->
<!--[if lt IE 9]><script type="text/javascript" src="js/html5.js"></script><![endif]-->
</head>


  
<body id="page1">
<!-- START PAGE SOURCE -->
<div class="wrap">
  <header>
    <div class="container">
      <h1><a href="#">Student's site</a></h1>
      <nav>
        <ul>
          <?php include('header.php'); ?>
        </ul>
      </nav>
	  <?php $query = mysqli_query($con, "select Name from faculty where Email = '$email'  ");
	   $result = mysqli_fetch_array($query);
	   
	   ?> 
	  
	  
      <form action="#" id="search-form">
         
          <div class="rowElem">
              <font style="color :  #000; font-size: 20px; font-family: monospace ; margin-bottom: 6px; background: url(images/divider1.gif) repeat-x left bottom;  ">  
                  Welcome </font>
                  <font style="color :  #990099; font-size: 20px;font-family: monospace ;  margin-bottom: 6px; background: url(images/divider1.gif) repeat-x left bottom; ">   <?php echo $result['Name'];?> </font>          </div>
      </form>
    </div>
  </header>
  <div class="container">
    <aside>
        <div><marquee behavior=" "><h3 style="color:green">
                   <?php   echo $result['Name'];  ?>
               
               </h3></marquee></div>
      <h3>Categories</h3>
      <ul class="categories">
        <li><span><a href="admin_sendmailto.php"  id = " "> Compose </a></span></li>
		<li><span><a href="admin_inbox.php">Inbox 
		<?php 
		$query = mysqli_query($con, "select Email from  register where Email = '$email'");
		$result = mysqli_fetch_array($query);
		$email = $result['Email'];
		$query=mysqli_query($con,"select * from  email where receiver='$email' ");
		$count=mysqli_num_rows($query);
		echo "(".$count.")";
		
		?>
		
		
		</a></span></li>
        <li><span><a href="#">Starred</a></span></li>
        <li><span><a href="#">Draft</a></span></li>
        <li><span><a href="sentmail.php">Sent Mail
		<?php 
		$query = mysqli_query($con, "select Email from  register where Email = '$email'");
		$result = mysqli_fetch_array($query);
		$email = $result['Email'];
		$query=mysqli_query($con,"select * from  email where sender='$email' and groupmail = '0'");
		$count=mysqli_num_rows($query);
		echo "(".$count.")";
		
		?>
		
		
		</a></span></li>
        <li><span><a href="groupsentmail.php">Group Sent 
		<?php 
		$query = mysqli_query($con, "select Email from  register where Email = '$email'");
		$result = mysqli_fetch_array($query);
		$email = $result['Email'];
		$query=mysqli_query($con,"select * from  email where sender='$email'  and groupmail = '1'");
		$count=mysqli_num_rows($query);
		echo "(".$count.")";
		
		?>
		
		
		</a></span></li>
         
      </ul>
      <form  id="newsletter-form">
         
      </form>
      
    </aside>
    <section id="content">
        <div id="banner">
        <h2>Student's Mail Box<span> <br><span>Interconnecting Peoples..</span></span></h2>
      </div>
      <div class="inside"> 
         
        
          
   		<h2>Student's <span>Information</span></h2>
        <form id="contacts-form" action="#"><!--div align = right position = relative><img src =  "images/bg.jpg" height = 200 width = 250 align = right></img></div-->
          <fieldset>
          <div class="field">
              <label>Name : </label>
              <input type="text" type="text" value="<?php echo $id_result['Name'];?>" name = "name" readonly="readonly"/>
          </div>
            <div class="field">
              <label> E-mail :</label>
              <input type="email" value="<?php echo $id_result['Email'];?>" name = "email" readonly="readonly"/>
            </div>
			<div class="field">
              <label>Stream :</label>
              <input type="text" value="<?php echo $id_result['Stream'];?>" name = "rollno" readonly="readonly"/>
            </div>
			<div class="field">
              <label>Department :</label>
              <input type="text" value="<?php echo $id_result['Department'];?>" name = "enrollno" readonly="readonly"/>
            </div>
			<div class="field">
              <label>Semester :</label>
              <input type="text" value="<?php echo $id_result['Semester'];?>" name = "date" readonly="readonly"/>
            </div>
            <div class="field">
			  <label>ID :</label>
              <input type="text" value="<?php echo $id_result['id'];?>" name = "contact" readonly="readonly"/>
            </div>
			
			<input type = "submit" value = "Approve Student" name = "approve">
		  <div class = "field">
            <label></label>
			</div>
           
           <input type = "text" value = <?php echo $id1; ?> name = "h" hidden>
          </fieldset>
        </form>        	  
	<?php 
	

?>  	
  
      
</div>
      
      
  
    
 
</div>
		  

		  
		   
       
      </div>
    </section>
  </div>
</div>
<footer>
  <div class="footerlink">
    <p class="lf">Copyright &copy; 2018 <a href="index.php">Student's Site</a> - All Rights Reserved</p>
   <p class="rf">Developed by <a href="http://www.harsh-gupta.tk" target="blank">Harsh Gupta</a></p>
    <div style="clear:both;"></div>
  </div>
</footer>
<script type="text/javascript"> Cufon.now(); </script>
<!-- END PAGE SOURCE -->
</body>
</html>
