<?php
require_once('database connection.php');
session_start();



if(isset($_POST['add'])){
    if(isset($_SESSION['cart'])){
        $item_array_id = array_column($_SESSION['cart'],$column="product_id");
        
        if(in_array($_POST['product_id'],$item_array_id)){
            echo"<script> alert('Product is already added in the cart!!!')</script>";
            echo"<script>window.location = 'index.php'</script>";
        }else{
            $count = count($_SESSION['cart']);
            $item_array = array(
                'product_id'=>$_POST['product_id']
            );
            $_SESSION['cart'][$count] = $item_array;
            
        }
    }
    else{
        $item_array = array(
            'product_id'=>$_POST['product_id']
        );
        $_SESSION['cart'][0] = $item_array;
        
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>

    <!--Font Awesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!--Bootstrap CDN-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

    <link rel="stylesheet" href="style.css">
</head>
<body>
 

<?php require_once("header.php") ?>
<div class="container">
    <div class="row text-center py-5">
        <?php
        $sql = "select * from products";
        $result = mysqli_query($conn,$sql);
        $data = mysqli_num_rows($result);

        if($data>0){
            while($row = mysqli_fetch_assoc($result)){
                $pic = $row['product_picture'];
                $name = $row['product_name'];
                $info = $row['info'];
                $price =$row['price'];
                $id = $row['id'];
?>
                <div class="col-md-3 col-sm-6 my-3 my-md-0">
                    <form action="index.php" method="post">
                    <div class="card shadow">
                        <div>
                            <img src="./product image/<?php echo $pic ?>" alt="image1" class="img-fluid card-img-top">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $name ?></h5>
                            <h6>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="far fa-star"></i>
                            </h6>
                            <p class="card-text">
                                <?php echo $info?>
                            </p>
                            <h5>
                                <span class="price"><?php echo $price?>Tk</span>
                            </h5>
                            <button type="submit" class="btn btn-warning my-3" name="add">Add to Cart <i class="fas fa-shopping-cart"></i></button>
                            <input type="hidden" name="product_id" value="<?php echo $id?>">
                        </div>
                    </div>
                    </form>
            </div><?php
            }
        }

        
        ?>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>
