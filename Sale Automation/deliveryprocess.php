<?php
require_once("database connection.php");

  if(isset($_POST['login']))
  {
	  echo 'working now';
	  if(empty($_POST['username']) || empty($_POST['password']))
	  {
		header("location:login.php?Empty=please fill in the blanks");
      }
      else{
		  $query="select * from deliveryman where Name='".$_POST['username']."' and Password='".$_POST['password']."'";
		  
		  $result=mysqli_query($conn, $query);
		  
		  if(mysqli_fetch_assoc($result)){
			session_start();
			  $_SESSION['user']= $_POST['username'];
			  header("location:purchase.php");
		  }
		  else{
			  header("location:logindelivery.html?Invalid=please enter correct information");
		  }
	  } 
  }
  else{
	  echo 'not working now';
  }

?>