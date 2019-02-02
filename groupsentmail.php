<?php
session_start();
include_once('config.php');

$email = $_SESSION['email'];

if(isset($_REQUEST['log']) == 'out')
	{
	session_destroy();
	header('location:index.php');
	}

if(isset($_SESSION['email']) =='')
{
header('location:index.php');
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
<style>
    .scrollit {
    overflow: scroll;
    height: 450px;
}

</style>

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
          <li ><a href="inbox.php" class="m2">Inbox</a></li>
          <li><a href="sentmail.php" class="m3">Sent Mail</a></li>
          <li class="current"><a href="groupsentmail.php" class="m4">Group Sent</a></li>
          <li class="last"><a href="?log=out" class="m5">Logout</a></li>
        </ul>
      </nav><?php $query = mysqli_query($con, "select Name from register where Email = '$email'  ");
	   $result = mysqli_fetch_array($query);
	   
	   ?> 
      <form action="#" id="search-form">
         
         <div class="rowElem">
              <font style="color :  #000; font-size: 20px; font-family: monospace ; margin-bottom: 6px; background: url(images/divider1.gif) repeat-x left bottom;  ">  
                  Welcome </font>
                  <font style="color :  #990099; font-size: 20px;font-family: monospace ;  margin-bottom: 6px; background: url(images/divider1.gif) repeat-x left bottom; ">   <?php echo $result['Name'];?> </font> 
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
        <li><span><a href="sendmailto.php"  id = " "> Compose </a></span></li>
		<li><span><a href="inbox.php">Inbox 
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
      <form action="#" id="newsletter-form">
         
      </form>
      
    </aside>
    <section id="content">
       
      <div class="inside"> 
         
         
          <div class="table-users"> 
   		<div class="header">Primary Mail</div>
 <div class ="scrollit">
   <table cellspacing="0">  
      <tr>
         <th><b>Picture</b> </th>
         <th><b>Name</b></th>
         <th><b>Email</b></th>
          <th><b>Subject</b></th>
         <th><b>Message</b></th>
      </tr>
  <?php
/* $query = mysqli_query($con, "select * from register wher Email = '$email'");
$result = mysqli_fetch_array($query);
$email = $result['Email'];
 */


$query=mysqli_query($con,"select * from  email where sender ='$email' and groupmail = '1' order by id desc");
while($result1=mysqli_fetch_array($query))
{
	$receivermail = $result1['receiver'];
	$message = $result1['message'];
	$sub = $result1['subject'];
		 
	$nam = mysqli_query($con, "Select * from register where Email = '$receivermail' ");
	while($result2 = mysqli_fetch_array($nam))
	{$sem = $result2['Semester'];
	$dept = $result2['Department'];
	$nameofreceiver = $result2['Name'];
	 }
 
?>
      
<tr> 
         <td><img src="images/group.jpg"alt=""/></td>
         <td><b> <?php echo($nameofreceiver);?> </b></td>
           <td><?php echo($receivermail);?><br>(<?php echo($dept);?> - <?php echo($sem);?>)</td>
          <td><b><?php echo($sub);?></b></td>
            <td><?php echo($message);?> </td> 
        <!-- <td><input type ="checkbox" name ="c1" value="<%=senderid%>"><a href ="delete">Delete</a></td>-->
       </tr>
      
<?php

}


 
?>
     
 
 
       
   </table></div>
      
      
</div>
          </div>
      <script>
          function fun()
          {}
      </script>
      
  
    
 
</div>
		  
		  
		  
		  
		   
       
      </div>
    </section>
  </div>
</div>
<footer>
  <div class="footerlink">
    <p class="lf">Copyright &copy; 2018 <a href="#">Student's Site</a> - All Rights Reserved</p>
    <p class="rf">Developed by <a href="http://www.harsh-gupta.tk" target="blank">Harsh Gupta</a></p>
    <div style="clear:both;"></div>
  </div>
</footer>
<script type="text/javascript"> Cufon.now(); </script>
<!-- END PAGE SOURCE -->
</body>
</html>
