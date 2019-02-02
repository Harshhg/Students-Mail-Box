<?php
include_once('config.php');
session_start();
$email = $_SESSION['email'];
	
if(isset($_SESSION['email']) =='')
{
header('index.php');
}
if(isset($_REQUEST['log']) == 'out')
	{
	session_destroy();
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
          <li class="current"><a href="sentmail.php" class="m3">Sent Mail</a></li>
          <li><a href="groupsentmail.php" class="m4">Group Sent</a></li>
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
   		<div class="header">Sent Mail</div>
 <div class ="scrollit">
   <table cellspacing="0">  
      <tr>
         <th><b>Picture</b> </th>
         <th><b>Name</b></th>
         <th><b>Email</b></th>
          <th><b>Subject</b></th>
         <th><b>Message</b></th>
      <form>
    <th><b>  <input type = 'submit' value = 'Trash' name = 'bt' ></b></th>
	 </tr>
	<?php 
 $query=mysqli_query($con,"select * from  email where sender='$email' order by id desc");
while($result1=mysqli_fetch_array($query))
{
	$id=$result1['id'];
	$receiver_id=$result1['receiver_id'];
	$message = $result1['message'];
	$subject = $result1['subject'];
	
	$search_receiver_category = mysqli_query($con,"select * from all_emails where id = '$receiver_id'");
	$category_check = mysqli_fetch_array($search_receiver_category);
	$category = $category_check['category'];
	
	 if($category =="faculty")
			{ $get_query = mysqli_query($con,"select * from faculty where id = '$receiver_id'");
			  $get_result = mysqli_fetch_array($get_query);
			  $receiver_name = $get_result['Name'];
			  $receiver_email = $get_result['Email'];
			  $receiver_dept = 'Faculty - ' . $get_result['Department'];
  			  $receiver_sem =  "";
			
?>
       
    
	 <tr style="background-color: #ccffcc">  
         <td><img src="images/group.jpg"alt=""/></td>
         <td><b> <?php echo($receiver_name);?> </b></td>
           <td><?php echo($receiver_email);?><br>(<?php echo($receiver_dept);?> )</td>
          <td><b><?php echo($subject);?></b></td>
             <td> <a href = "readsentmail.php ?msg=<?php echo $id;?>" >View Mail </a></td> 
         <td><input type ="checkbox" name ="c1[]" value="<?php echo $id ?>"> </td>
       </tr>
	  
	  <?php

	}

else if($category =="student")
			{ $get_query = mysqli_query($con,"select * from register where id = '$receiver_id'");
			  $get_result = mysqli_fetch_array($get_query);
			  $receiver_name = $get_result['Name'];
			  $receiver_email = $get_result['Email'];
			  $receiver_dept = $get_result['Department'];
  			  $receiver_sem = $get_result['Semester'];
			
?>
      
<tr> 
         <td><img src="images/group.jpg"alt=""/></td>
          <td><b> <?php echo($receiver_name);?> </b></td>
           <td><?php echo($receiver_email);?><br>(<?php echo($receiver_dept);?> - <?php echo($receiver_sem);?>)</td>
          <td><b><?php echo($subject);?></b></td>
            <td> <a href = "readsentmail.php ?msg=<?php echo $id;?>" >View Mail </a></td> 
         <td><input type ="checkbox" name ="c1[]" value="<?php echo $id ?>"> </td>
       </tr>
     
<?php

}


} 
?>
     
 
 
       
   </table></div>
      
      
</div>
          </div>
   
      
  
    
 
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
