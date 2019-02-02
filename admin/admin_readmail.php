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

if(isset($_REQUEST['goback']))
{
header('location:admin_inbox.php');
}

$msgid = $_REQUEST['msg'];
$msg_query = mysqli_query($con, "select * from email where id  = '$msgid'");
$msg_result = mysqli_fetch_array($msg_query);
$sender_id = $msg_result['sender_id'];


$search_sender_category = mysqli_query($con,"select * from all_emails where id = '$sender_id'");
$category_check = mysqli_fetch_array($search_sender_category);
$category = $category_check['category'];
if($category =="faculty")
			{ $get_query = mysqli_query($con,"select * from faculty where id = '$sender_id'");
			  $get_result = mysqli_fetch_array($get_query);
			  $sender_name = $get_result['Name'];
			}
else if($category =="student")
			{ $get_query = mysqli_query($con,"select * from register where id = '$sender_id'");
			  $get_result = mysqli_fetch_array($get_query);
			  $sender_name = $get_result['Name'];
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
          <li ><a href="home.php" class="m1">Home Page</a></li>
          <li class="current"><a href="admin_inbox.php" class="m2">Inbox</a></li>
          <li><a href="admin_sentmail.php" class="m3">Sent Mail</a></li>
          <li><a href="admin_groupsentmail.php" class="m4">Group Sent</a></li>
           <li class="last"><a href="?log=out" class="m5">Logout</a></li>
        </ul>
      </nav>
	   <?php $query = mysqli_query($con, "select Name from register where Email = '$email'  ");
	   $result = mysqli_fetch_array($query);
	   
	   ?> 
      <form action="#" id="search-form">
       
        <div class="rowElem">
              <font style="color :  #000; font-size: 20px; font-family: monospace ; margin-bottom: 6px; background: url(images/divider1.gif) repeat-x left bottom;  ">  
                  Welcome </font>
                  <font style="color :  #990099; font-size: 20px;font-family: monospace ;  margin-bottom: 6px; background: url(images/divider1.gif) repeat-x left bottom; ">    <?php echo $result['Name'];?>  </font> 
          </div>
         
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
        <li><span><a href="admin_sentmail.php">Sent Mail
		<?php 
		$query = mysqli_query($con, "select Email from  register where Email = '$email'");
		$result = mysqli_fetch_array($query);
		$email = $result['Email'];
		$query=mysqli_query($con,"select * from  email where sender='$email' and groupmail = '0'");
		$count=mysqli_num_rows($query);
		echo "(".$count.")";
		
		?>
		
		
		</a></span></li>
        <li><span><a href="admin_groupsentmail.php">Group Sent 
		<?php 
		$query = mysqli_query($con, "select Email from  register where Email = '$email'");
		$result = mysqli_fetch_array($query);
		$email = $result['Email'];
		$query=mysqli_query($con,"select * from  email where sender ='$email'  and groupmail = '1'");
		$count=mysqli_num_rows($query);
		echo "(".$count.")";
		
		?>
		
		
		</a></span></li>
         
      </ul>
      <form action="#" id="newsletter-form">
         
      </form>
      
    </aside>
    <section id="content">
       
      <div class="inside"> 
         
        
          <div class="table-users">
              <div class="header"><?php echo $sender_name ;?></div><br>
              <form id="contacts-form" method = "post">
      
           
      
            <div class="field">
              <label>Subject :</label>
		<h5 style="color:#FF9900""> <?php echo $msg_result['subject'] ;?></h5>
            </div>
            
              
            <div class="field extra">
              <label>Your Message:</label>
               <textarea disabled cols="1" rows="1" name ="message" ><?php echo $msg_result['message'];?>  </textarea> 
            </div>
            <div class="alignright"><input type ="submit" name = "goback" value ="Go Back"></div>
        
        </form>
 
</div>
 
  
		  
		  
		  
		  
		   
       
      </div>
    </section>
  </div>
</div>
<footer>
  <div class="footerlink">
    <p class="lf">Copyright &copy; 2018 <a href="#">SiteName</a> - All Rights Reserved</p>
    <p class="rf">Developed by <a href="http://www.templatemonster.com/">Harsh Gupta</a></p>
    <div style="clear:both;"></div>
  </div>
</footer>
<script type="text/javascript"> Cufon.now(); </script>
<!-- END PAGE SOURCE -->
</body>
</html>
