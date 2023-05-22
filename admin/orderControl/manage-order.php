<?php
include_once("../partials/menu.php");
$orderData = new manageOrder();
$page = isset($_GET['page']) ? $_GET['page'] : 1;
//$pageNumber = $_GET['page_number'] ?? 1;
$limit = 2;
$countOrders = $orderData->orderCount();
$pagesCount = ceil($countOrders/$limit);
if( ! validatePage($page , $pagesCount)){
    header("location:http://localhost/php.course/food-order/admin/orderControl/manage-order.php?page=1");
}
$data = $orderData->displayOrders($limit,$page);
 if (isset($_GET['delete_id'])) {
    $orderData = new manageOrder();
    $delete = $orderData->deleteOrder();
}
?>

<div class="">
    <div style="padding: 30px;">
        <h1>Manage Order</h1>
        <br><?php
            if (isset($_SESSION['update'])) {

                echo $_SESSION['update'];

                unset($_SESSION['update']);
            }
            if (isset($_SESSION['delete'])) {

                echo $_SESSION['delete'];

                unset($_SESSION['delete']);
            }
            ?>
        </br>
        </br>
        </br>
        <table class="tbl-full text-center">
            <tr>
                <th>S.N.</th>
                <th>Food</th>
                <th>Price</th>
                <th>Qnt</th>
                <th>Total</th>
                <th>Order Date</th>
                <th>Status</th>
                <th>Customer Name</th>
                <th>Contact</th>
                <th>E-mail</th>
                <th>Address</th>
                <th>Actions</th>
            </tr>

            <?php
            $sn = 1;
            if($data !=""){
            foreach ($data as $value) {
            ?>
                <tr>
                    <td><?php echo $sn++; ?></td>
                    <td><?php echo $value['food']; ?></td>
                    <td><?php echo $value['price']; ?></td>
                    <td><?php echo $value['quantity']; ?></td>
                    <td><?php echo $value['total']; ?></td>
                    <td><?php echo $value['order_date']; ?></td>
                    <td><?php echo $value['status']; ?></td>
                    <td><?php echo $value['customer_name']; ?></td>
                    <td><?php echo $value['customer_contact']; ?></td>
                    <td style="width: 15%;"><?php echo $value['customer_email']; ?></td>
                    <td style="width: 15%;"><?php echo $value['customer_address']; ?></td>
                    <td style="width: 10%;">
                        <a href="update-order.php?id=<?php echo $value['id']; ?>" class=""> <img title="Update" src="http://localhost/php.course/food-order/images/website/update.png" /></a>
                        <a href="deleteOrder.php?delete_id=<?php echo $value['id']; ?>" class="">
                            <img title="delete" src="http://localhost/php.course/food-order/images/website/delete.png" /></a>
                    </td>
                </tr>
            <?php
            }
        }else{
            echo "<div class='error'>Not Ordered Yet</div>";
        } ?>
        </table>
    </div>
    </div>
</div>
<br>
<nav>
    <ul class="pagination">
    <li>
            <a <?php if($page == 1){echo "class='disabled'";}?>
                href="<?= $_SERVER['PHP_SELF'] ."?page=".($page - 1) ?>" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
                <span aria-hidden="true">Previous</span>
            </a>
        </li>    
        <li>
            <a <?php if($page == $page){echo "class='disabled'";}?>
             href=""> Page <?= $page ;?> of <?= $pagesCount ;?></a></li>
        <li>
        <a <?php if($page == $pagesCount){echo "class='disabled'";}?>
            href="<?= $_SERVER['PHP_SELF'] ."?page=".($page + 1) ?>" aria-label="Next">
            <span aria-hidden="true">Next</span>
            <span aria-hidden="true">&raquo;</span>
        </a>
        </li>
    </ul>
</nav>
<br>
<?php
include_once("../partials/footer.php");
?>