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

if(isset($_REQUEST['bt']))
{

	foreach($_REQUEST['c1'] as $x)
	{  
		mysqli_query($con,"delete from  register where id = '$x'") ;
		mysqli_query($con,"delete from  registered_students where id = '$x'");
		mysqli_query($con,"delete from  all_emails where id = '$x'");
 	}
     
}
$page = $_SERVER['PHP_SELF'];
$sec = "2";
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="refresh" content="<?php echo $sec?>;URL='<?php echo $page?>'">
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
		$query = mysqli_query($con, "select Email from faculty where Email = '$email'");
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
		$query = mysqli_query($con, "select Email from  faculty where Email = '$email'");
		$result = mysqli_fetch_array($query);
		$email = $result['Email'];
		$query=mysqli_query($con,"select * from  email where sender='$email' and groupmail = '0'");
		$count=mysqli_num_rows($query);
		echo "(".$count.")";
		
		?>
		
		
		</a></span></li>
        <li><span><a href="admin_groupsentmail.php">Group Sent 
		<?php 
		$query = mysqli_query($con, "select Email from  faculty where Email = '$email'");
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
   		<div class="header">Registration Request</div>
 <div class ="scrollit">
  <form>
  <?php
  
   echo "<table> "; 
     echo " <tr>";
	echo "<th><b>Picture</b> </th>";
        echo " <th><b>Name</b></th>";
       echo "  <th><b>Email</b></th>";
        echo "  <th><b>Department</b></th>";
      echo "   <th><b> Message </b></th>";
     echo "   <th><b>  <input type = 'submit' value = 'Trash' name = 'bt'   ></b></th>";
/* $query = mysqli_query($con, "select * from register wher Email = '$email'");
$result = mysqli_fetch_array($query);
$email = $result['Email'];
 */


$query_regid=mysqli_query($con,"select id from registered_students where Approved = '0'");
while($result_regid=mysqli_fetch_array($query_regid))
{
	$reg_id = $result_regid['id'];
	$query_id=mysqli_query($con,"select * from  register where id = '$reg_id'");
	while($result_id=mysqli_fetch_array($query_id))
			{$id=$result_id['id'];
			 $name = $result_id['Name'];
	 		$email = $result_id['Email'];
			$dept = $result_id['Department'];
			$sem = $result_id['Semester'];
 	?>
      
<tr> 
         <td><img src="images/group.jpg"alt=""/></td>
         <td><b> <?php echo($name);?> </b></td>
           <td><?php echo($email);?><br></td>
          <td><b><?php echo($dept);?></b>- <?php echo($sem);?></td>
            <td> <a href = "admin_studentinfo.php?id=<?php echo $id;?>" >View Student </a></td> 
         <td><input type ="checkbox" name ="c1[]" value="<?php echo $id ?>"> </td>
       </tr>
     
<?php
}
}

 
?>
     
   
   </table> 
     
	</form> 
   </div>
      
      
</div>
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
