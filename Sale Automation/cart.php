<?php

session_start();
require_once("database connection.php");

if (isset($_POST['remove'])){
    if ($_GET['action'] == 'remove'){
        foreach ($_SESSION['cart'] as $key => $value){
            if($value["product_id"] == $_GET['id']){
                unset($_SESSION['cart'][$key]);
                echo "<script>alert('Product has been Removed...!')</script>";
                echo "<script>window.location = 'cart.php'</script>";
            }
        }
    }
  }
  


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>

    <!--Font Awesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!--Bootstrap CDN-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

    <link rel="stylesheet" href="style.css">
</head>
<body class="bg-light">
    <?php require_once('header.php')?>
   
<div class="container-fluid">
    <div class="row px-5">
        <div class="col-md-7">
            <div class="shopping-cart">
                <h6>My Cart</h6>
                <hr>
                

                <?php
                if(isset($_SESSION['cart'])){
                    $product_id = array_column($_SESSION['cart'],$column='product_id');
                    $sql = "select * from products";
                    $result = mysqli_query($conn,$sql);
                    $data = mysqli_num_rows($result);
                    $total = 0;
                    if($data>0){
                        while($row = mysqli_fetch_assoc($result)){
                                $pic = $row['product_picture'];
                                $name = $row['product_name'];
                                $price =$row['price'];
                                $id = $row['id'];
                            foreach($product_id as $id){
                                if($row['id'] == $id){
?>                                
                                    <form action="cart.php?action=remove&id= <?php echo $row['id'] ?>" method="post" class='cart-item'>
                                        <div class="boder rounded">
                                            <div class="row bg-white">
                                                <div class="col-md-3 pl-0">
                                                    <img src="./product image/<?php echo $pic ?>" alt="image1" class="img-fluid">
                                                </div>
                                                <div class="col-md-6">
                                                    <h5 class="pt-2"><?php echo $name ?></h5>
                                                    <small class="text-secondary">Seller:dailytuition</small>  
                                                    <h5 class="pt-2"><?php echo $price ?></h5>
                                                    <button type='submit' class='btn btn-warning'>Save for later</button>
                                                    <button type='submit' class='btn btn-danger mx-2' name='remove'>Remove</button>
                                                </div>
                                                <div class="col-md-3 py-5">
                                                    <div>
                                                        <button type="button" class="btn bg-light border rounded-circle"><i class="fas fa-minus"></i></button>
                                                        <input type="text" value="1" class="form-control w-25 d-inline">
                                                        <button type="button" class="btn bg-light border rounded-circle"><i class="fas fa-plus"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>

                
                <?php $total = $total + (int)$price;
                                    }
                                }
                            }
                         }
                    }else{
                        echo"<h5>The cart is Empty!!</h5>";
                    }

                ?>
            </div>
        </div>
        <div class="col-md-4 offset-md-1 border rounded mt-5 bg-white" style="height: 650px;">
            <div class="pt-4">
                <h6>Price Details</h6>
                <hr>
                <div class="row price-details">
                    <div class="col-md-6">
                        <?php
                        if(isset($_SESSION['cart'])){
                            $count = count($_SESSION['cart']);
                            echo"<h6>Price($count items)</h6>";
                        }else{
                            echo"<h6>Price(0 items)</h6>";
                        }
                        ?>
                        <h6>Delivery Charges</h6>
                        <hr>
                        <h6>Amount Payable:</h6>
                        <hr>
                        <h6>Address Details:</h6>
                    </div>
                    <div class="col-md-6">
                        <h6><?php
                            echo $total;
                        ?>Tk</h6>
                        <h6 class="text-success">FREE</h6>
                        <hr>
                        <h6><?php
                            echo $total;
                        ?>Tk</h6>
                        <hr>
                        <h6>Please select Area:</h6>
                        <form id="purchase" class="input-group" action="placedorder.php" method="post">
                            <div class="form-group">
                                <div class="form-check">
                                <input type="radio" class="form-check-input" name="place" id="mirpur" value="Mirpur">
                                <label class="form-check-label" for="mirpur">Mirpur</label>
                                </div>
                                <div class="form-check">
                                <input type="radio" class="form-check-input" name="place" id="gulshan" value="Gulshan">
                                <label class="form-check-label" for="gulshan">Gulshan</label>
                                </div>
                                <div class="form-check">
                                <input type="radio" class="form-check-input" name="place" id="banani" value="Banani">
                                <label class="form-check-label" for="banani">Banani</label>
                                </div>
                                <div class="form-check">
                                <input type="radio" class="form-check-input" name="place" id="baridhara" value="Baridhara">
                                <label class="form-check-label" for="baridhara">Baridhara</label>
                                </div>
                                <div class="form-check">
                                <input type="radio" class="form-check-input" name="place" id="bashundhara" value="Bashundhara">
                                <label class="form-check-label" for="bashundhara">Bashundhara</label>
                                </div>
                                <hr>
                            </div>
                            
                            <div class="form-group">
                                <label for="address">Enter Your Address:</label>
                                <input type="text" name="address" class="form-control" placeholder="Enter your address" required>
                                <hr>
                            </div>
                           
                            <button type="submit" name="buynow" class="btn btn-danger">Buy Now</button>
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