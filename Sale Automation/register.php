<?php
require_once("database connection.php");
//session_start();

  if(isset($_POST['register']))
  {
	  echo 'working now';
	  if(empty($_POST['new_User_Id']) || empty($_POST['email_Id']) || empty($_POST['password_register']))
	  {
		header("location:login.php?Empty=please fill in the blanks");
      }
      else{
		  $query="INSERT INTO clients (username, email_id, password)
          VALUES ('".$_POST['new_User_Id']."', '".$_POST['email_Id']."', '".$_POST['password_register']."')";
		  $result=mysqli_query($conn, $query);
		  header("location:homepage.html");
		  
		  
		
	  } 
  }
  else{
	  echo 'not working now';
  }

?>