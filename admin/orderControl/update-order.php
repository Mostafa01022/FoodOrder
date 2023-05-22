<?php
include_once("../partials/menu.php");
if(isset($_GET['id'])){
       $order = new manageOrder();
       $data = $order->displayOrdersById($_GET['id']);
}
if (isset($_POST['submit'])) {
       $update =$order->updateOrder();
}
?>

<div class="main-content">
       <div class="wrapper">
              <h1> Upadet Order</h1>
              <br> </br></br>
              <form action="" method="post">

                     <table style="width: 50%; font-weight:bold;">
                            <tr>
                                   <td>Food Name :</td>
                                   <td><input type="text" value="<?php echo $data['food']; ?>" readonly></td>
                            </tr>
                            <tr>
                                   <td>Price :</td>
                                   <td><input type="text" name="price" value="<?php echo $data['price']; ?>" readonly></td>
                            </tr>

                            <tr>
                                   <td>Quantity :</td>
                                   <td> <input type="number" name="quantity" min="1" value="<?php echo $data['quantity']; ?>" max="20" required></td>
                            </tr>
                            <tr>
                                   <td>Status :</td>
                                   <td>
                                          <select name="status">
                                                 <option <?php if ($data['status'] == 'orderdd') {
                                                                      echo "selected";
                                                               } ?>value="ordered">Ordered</option>
                                                 <option <?php if ($data['status'] == 'on oelivery') {
                                                                      echo "selected";
                                                               } ?>value="on oelivery">On Delivery</option>
                                                 <option <?php if ($data['status'] == 'delivered') {
                                                                      echo "selected";
                                                               } ?>value="delivered">Delivered</option>
                                                 <option <?php if ($data['status'] == 'cancelled') {
                                                                      echo "selected";
                                                               } ?>value="cancelled">Cancelled</option>

                                          </select>
                                   </td>
                            </tr>
                            <tr>
                                   <td>Customer Name :</td>
                                   <td><input type="text" name="name" value="<?php echo $data['customer_name']; ?>" placeholder="E.g. Mostafa Ramadan" class="input-responsive" required></td>
                            </tr>
                            <tr>
                                   <td>Customer Contact :</td>
                                   <td><input type="tel" name="contact" value="<?php echo $data['customer_contact']; ?>" placeholder="E.g. 9843xxxxxx" class="input-responsive" required></td>
                            </tr>
                            <tr>
                                   <td>Customer Email :</td>
                                   <td><input type="email" name="email" value="<?php echo $data['customer_email']; ?>" placeholder="E.g. hi@mostafa.com" class="input-responsive" required></td>
                            </tr>
                            <tr>
                                   <td>Customer Address :</td>
                                   <td><textarea cols="30" rows="5" name="address" placeholder="E.g. Street, City, Country" name="adress"><?php echo $data['customer_address']; ?></textarea></td>
                            </tr>

                            <tr>
                                   <td><input type="hidden" name="id" value="<?php echo $data['id']; ?>"></td>
                                   <td><input type="submit" name="submit" value="Update Order" class="btn-secondary" required></td>
                            </tr>
                     </table>
              </form>
       </div>
</div>

<?php
include_once("../partials/footer.php");
?>