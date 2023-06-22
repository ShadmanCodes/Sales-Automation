<?php
require_once("database connection.php");

  if(isset($_POST['Login']))
  {
	  echo 'working now';
	  if(empty($_POST['username']) || empty($_POST['password']))
	  {
		header("location:login.php?Empty=please fill in the blanks");
      }
      else{
		  $query="select * from Admin where Name='".$_POST['username']."' and Password='".$_POST['password']."'";
		  $query2 = "select * from clients where username = '".$_POST['username']."' and password = '".$_POST['password']."'";
		  $result=mysqli_query($conn, $query);
		  $result2=mysqli_query($conn,$query2);
		  if(mysqli_fetch_assoc($result)){
			session_start();
			  $_SESSION['user']= $_POST['username'];
			  header("location:homepage.html");
		  }
		  elseif(mysqli_fetch_assoc($result2)){
			session_start();
			  $_SESSION['user']= $_POST['username'];
			  header("location:homepage.html");
		  }
		  else{
			  header("location:login.php?Invalid=please enter correct information");
		  }
	  } 
  }
  else{
	  echo 'not working now';
  }

?>