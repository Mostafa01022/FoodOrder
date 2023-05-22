<?php 
include_once('../partials/menu.php');
if(isset($_POST['search'])){
$display = new searchedFood();
$search= $display->validateInput($display->conn,$_POST['search']);
$dataFood =$display->displaySearched_Foods($_POST);
}else{
    header("location:http://localhost/php.course/food-order/website/foods.php");
}
?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <h2>Foods on Your Search <a href="#" class="text-white">"<?php echo
             $search ;?>"</a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Search</h2>

 
            <?php
           
           /* $search=mysqli_real_escape_string( $mysqli,$_POST['search']);
            
            $sel_category2 = $mysqli->query("SELECT * FROM tbl_food WHERE title LIKE '%$search%' OR  description LIKE '%$search%'   ");
            $count2=mysqli_num_rows($sel_category2);

            if($count2>0){
                while( $rows=mysqli_fetch_assoc($sel_category2)){
                    $image_name=$rows['image_name'];
                    $id=$rows['id'];
                    $title=$rows['title'];
                    $description=$rows['description'];
                    $price=$rows['price'];
                  
                    ?>

                    <div class="food-menu-box">
                        <div class="food-menu-img">
                            <?php
                            if ($image_name==""){
                                echo"<div class='error'> Image Not Available</div>";
                            }else{
                                ?>
                                 <img src="images/food/<?php echo $image_name;?>" class="img-responsive img-curve">
                                 </div>
                                                
                                 <div class="food-menu-desc">
                                    <h4><?php echo $title;?></h4>
                                    <p class="food-price"><?php echo '$ '.$price;?></p>
                                    <p class="food-detail">
                                          <?php echo $description;?>
                                    </p>
                                    <br>
                                                    
                                    <a href="order.php?id=<?php echo $id?>" class="btn btn-primary">Order Now</a>
                                </div>
                            </div>

                            <?php
                            }
                                
                        }  

            }else{

                echo"<div class='error'> Food Not Found</div>";
            }*/

            if($dataFood){
                foreach($dataFood as $value){
                    ?>
                    
                    <div class="food-menu-box">
                            <div class="food-menu-img">
                                <?php
                                if ($value['image_name']==''){
                                    echo"<div class='error'> Image Not Available</div>";
                                }else{
                                    ?>
                                     <img src="../images/food/<?php echo $value['image_name'];?>" class="img-responsive img-curve">
                                     </div>
                                                      
                                     <div class="food-menu-desc">
                                        <h4><?php echo $value['title'];?></h4>
                                        <p class="food-price"><?php echo '$ '.$value['price'];?></p>
                                        <p class="food-detail">
                                              <?php echo $value['description'];?>
                                        </p>
                                        <br>
                                                        
                                        <a href="order.php?id=<?php echo $value['id']?>" class="btn btn-primary">Order Now</a>
                                    </div>
                                </div>
    
                                <?php                           
                }
            }
            }else{

                echo"<div class='error'> Food Not Found</div>";}
                
            ?>



            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

     <!-- fOOD Menu Section Ends Here -->
     <?php 
include_once('../partials/footer.php');
?>
