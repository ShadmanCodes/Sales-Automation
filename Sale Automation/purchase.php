<?php

session_start();
require_once("database connection.php");




?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delivery details</title>

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
                <h6>Your Delivery Details</h6>
                <hr>
                

                <?php
                 echo "This is your current task ".$_SESSION['user'].":";?>
                <p class="space"> </p>
                 <h6>Products to be delivered:</h6>
                 <?php
                    $sql = "SELECT order_id, address, total_amount FROM orders
                            where delivery_man_name = '".$_SESSION['user']."'";
                    $result = mysqli_query($conn,$sql);
                    $row = mysqli_fetch_assoc($result);
                    //'".$row['order_id']."'   '".$row['address']."'   '".$row['total_amount']."'

                    $sql1 = "SELECT product_id FROM orderid_with_productid
                            where order_id = '".$row['order_id']."'";
                    $result1 = mysqli_query($conn,$sql1);

                  while($row1 = mysqli_fetch_assoc($result1)){
                        $query11 = "select product_name,product_picture, quantity,price from products
                                    where id = '".$row1['product_id']."'";
                        $result11 = mysqli_query($conn, $query11);
                        $row11 = mysqli_fetch_assoc($result11); 

                       
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
            <?php  }?>
               
        <div class="col-md-4 offset-md-1 border rounded mt-5 bg-white" style="height: 450px;">
            <div class="pt-4">
                <h6>Price Details:</h6>
                <hr>
                <div class="row price-details">
                    <div class="col-md-6">
                        <h6>Total Price:</h6>
                        <h6>Delivery Charges</h6>
                        <hr>
                        <h6>Amount Payable:</h6>
                        <hr>
                        <h6>Address Details:</h6>
                    </div>
                    <div class="col-md-6">
                        <h6><?php
                            echo $row['total_amount'];
                        ?>Tk</h6> <h6></h6>
                        <h6 class="text-success">FREE</h6>
                        <h6></h6>
                        <hr>
                        <h6><?php
                            echo $row['total_amount'];
                        ?>Tk</h6>
                        <hr>
                        <h6><?php
                            echo $row['address'];
                        ?></h6>
                        <form class="input-group" action="receipt.php" method="post">
                            <div class="form-group"> 
                                <hr>
                                <button type="submit" name="start" class="btn btn-danger">Start Delivery</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>