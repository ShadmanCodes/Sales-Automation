<?php
require_once("database connection.php");
session_start();

$query10 = "SELECT product_id FROM orderid_with_productid
            WHERE order_id = '".$_SESSION['id']."'";
$result10 = mysqli_query($conn, $query10);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receipt</title>

    <!--Font Awesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!--Bootstrap CDN-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

    <link rel="stylesheet" href="style.css">
</head>
<body class="bg-light">
    <?php// require_once('header.php')?>

<div class="container-fluid">
    <div class="row px-5">
        <div class="col-md-7">
            <div class="Delivery">
                <h6>Orderlist:</h6>
                <hr>

<?php  $count = 0;
while($row10 = mysqli_fetch_assoc($result10)){
    $query11 = "select product_name,product_picture, quantity,price from products
                where id = '".$row10['product_id']."'";
    $result11 = mysqli_query($conn, $query11);
    $row11 = mysqli_fetch_assoc($result11); 

    if($row11['quantity']>0){
    
    $query12 = "update products
                set quantity= quantity- 1
                where id = '".$row10['product_id']."'";

    $result12 = mysqli_query($conn, $query12);
   
        $count++;
   
    ?>

    <div class="boder rounded">
    <div class="row bg-white">
        <div class="col-md-3 pl-0">
            <img src="./product image/<?php echo $row11['product_picture'] ?>" alt="image1" class="img-fluid">
        </div>
        <div class="col-md-6">
            <h5 class="pt-2"><?php echo $row11['product_name'] ?></h5>
            
            <h5 class="pt-2"><?php echo $row11['price'] ?></h5>
            
        </div>
        
        
    </div>
    </div>
<?php  

}else{echo " Sorry This Product is not available!!!!";}

}if($count>0){
echo "Your products is on the way!!!!!"; 

}

if (isset($_POST['start'])){
      
               
    echo "Your Deliveryman ".$_SESSION['user']." has started";
    echo "<br>";

    echo "You can track his location by clicling the following link:";
    ?>
    <a href="track.html">Track Deliverymen</a>
<?php


}?>