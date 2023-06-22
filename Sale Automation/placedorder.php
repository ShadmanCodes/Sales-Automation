
<?php
session_start();
require_once("database connection.php");
?>
<?php
if(isset($_POST['buynow']))
                        {
                            if(empty($_POST['place']) || empty($_POST['address']))
                            {
                                header("location:cart.php?Empty=please fill in the blanks");
                            }
                            else{
                            
                                
                                $query4="select No_of_delivery_man FROM place_of_delivery
                                            WHERE Place  = '".$_POST['place']."'";
                                
                                    $result4=mysqli_query($conn, $query4);

                                    $row2 = mysqli_fetch_assoc($result4);

                                        if($row2['No_of_delivery_man']>0){
                                       


                                        $query3="update place_of_delivery
                                            set No_of_delivery_man= No_of_delivery_man- 1
                                            where Place = '".$_POST['place']."'";
                                
                                    $result3=mysqli_query($conn, $query3);

                                    $query5 = "select Areacode FROM place_of_delivery
                                                where Place = '".$_POST['place']."'";
                                    $result5=mysqli_query($conn, $query5);
                                    $row5 = mysqli_fetch_assoc($result5);
                                    // $row5['Areacode']

                                    $query6 = "select DeliveryId, Name FROM deliveryman
                                               WHERE areacode = '".$row5['Areacode']."' AND available = 0";
                                             
                                    $result6=mysqli_query($conn, $query6);
                                    $row6 = mysqli_fetch_assoc($result6);    
                                    //$row6['Name'],$row6['DeliveryId']  

                                    $queryN = "update deliveryman  set available = 1
                                                where DeliveryId =  '".$row6['DeliveryId']."'";
                                    $resultN=mysqli_query($conn, $queryN);
                                    
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
                                                    $total = $total + (int)$price;
                                                        }
                                                    }
                                                }
                                             }
                                        }else{
                                            echo"Not working!!!!";
                                        }
                                    $query7 = "INSERT INTO orders (total_amount, address, delivery_man_name, delivery_man_id)
                                    VALUES ($total, '".$_POST['address']."', '".$row6['Name']."', '".$row6['DeliveryId']."') ";
                                    $result7=mysqli_query($conn, $query7);
                                   // $row7 = mysqli_fetch_assoc($result7);

                                   $query8 = "select order_id from orders 
                                                where delivery_man_id = '".$row6['DeliveryId']."'";
                                    $result8=mysqli_query($conn, $query8);
                                    $row8 = mysqli_fetch_assoc($result8);
                                    // $row8['order_id']


                                    if(isset($_SESSION['cart'])){
                                        $product_id = array_column($_SESSION['cart'],$column='product_id');
                                        $sql = "select * from products";
                                        $result = mysqli_query($conn,$sql);
                                        $data = mysqli_num_rows($result);
                                        if($data>0){
                                            while($row = mysqli_fetch_assoc($result)){
                                                foreach($product_id as $id){
                                                    if($row['id'] == $id){
                                                        $query9 = "INSERT INTO orderid_with_productid (order_id, product_id) VALUES
                                                        ('".$row8['order_id']."','".$row['id']."')";
                                                        $result9 = mysqli_query($conn, $query9);
                                                        }
                                                    }
                                                }
                                         
                                      }
                                        }else{
                                            echo"Not working!!!!";
                                        }
 
                                       
                                        }
                                    else{
                                        echo "No deliveryman available!!";

                                    }  		
                                    

                                

                                

                                    
                                      } 
                                      $_SESSION['id'] = $row8['order_id']; 
                                     header("location:receipt.php");
                        }
                        else{
                            echo 'not working now';
                        }
                

                ?>

