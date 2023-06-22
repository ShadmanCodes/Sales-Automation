<?php
require_once('database connection.php');
require_once('header.php');


$sql = "select * from employee";
$result = mysqli_query($conn,$sql);
$data = mysqli_num_rows($result);
?>



<html>
	<head>
		<title>Query tables! </title>
	</head>
	<body>

		<!--employee table-->
		<table align="center" border="4" style="width: 1000;">
			<tr>
				<th align="center" colspan="9" style="line-height: 4;"><big>Employee Table</big></th>
			</tr>
			<tr>
				<th>Id</th>
				<th>Name</th>
				<th>Email</th>
				<th>Password</th>
				<th>Phone</th>
				<th>Post</th>
				<th>Address</th>
				<th>Salary</th>
				<th>Age</th>
			</tr>				

<?php
if($data>0){
	while($row = mysqli_fetch_assoc($result)){
?>
			<tr>
				<td><?php echo $row['Id'] ?></td>
				<td><?php echo $row['Name'] ?></td>
				<td><?php echo $row['email'] ?></td>
				<td><?php echo $row['Password'] ?></td>
				<td><?php echo $row['Phone'] ?></td>
				<td><?php echo $row['post'] ?></td>
				<td><?php echo $row['Address'] ?></td>
				<td><?php echo $row['salary'] ?></td>
				<td><?php echo $row['age'] ?></td>
			</tr>
		

<?php
	}
}else{
	echo"No result found";
}
?>	
	</table><br><br>


<?php

$sql = "select * from admin where Admin_Id<12";
$result = mysqli_query($conn,$sql);
$data = mysqli_num_rows($result);
?>

	<table align="center" border="4" style="width: 1000;">
			<tr>
				<th align="center" colspan="6" style="line-height: 4;"><big>Admin Table</big></th>
			</tr>
			<tr>
				<th>Admin_Id</th>
				<th>Name</th>
				<th>Phone</th>
				<th>Post</th>
				<th>Email</th>
				<th>Password</th>
			</tr>				

<?php
if($data>0){
	while($row = mysqli_fetch_assoc($result)){
?>
			<tr>
				<td><?php echo $row['Admin_Id'] ?></td>
				<td><?php echo $row['name'] ?></td>
				<td><?php echo $row['Phone'] ?></td>
				<td><?php echo $row['post'] ?></td>
				<td><?php echo $row['email'] ?></td>
				<td><?php echo $row['Password'] ?></td>
			</tr>
<?php
	}
}else{
	echo"No result found";
}
?>	
		</table>
		
	</body>
</html>
<?php require_once('footer.php'); ?>