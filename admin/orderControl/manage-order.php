<?php
include_once("../partials/menu.php");

use Management\ManageOrder;

$orderData = new ManageOrder();
$page = isset($_GET['page']) ? $_GET['page'] : 1;

if (isset($_GET['page']) && $_GET['page'] <= 0) {
    header('location:http://localhost/php.course/FoodOrder/admin/orderControl/manage-order.php');
}
//$pageNumber = $_GET['page_number'] ?? 1;
$limit = 4;
$countOrders = $orderData->orderCount();
$pagesCount = ceil($countOrders / $limit);

$data = $orderData->displayOrders($limit, $page);

?>

<div class="">
    <div style="padding: 30px;">
        <h1>Manage Order</h1>
        </br>
        <div id="action_message"></div>
        </br>
        <table class="tbl-full text-center">
            <tr>
                <th>S.N.</th>
                <th>Total Price</th>
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
            if ($data != "") {
                foreach ($data as $value) {
            ?>
                    <tr id="row_<?= $value['id']; ?>">
                        <td><?php echo $sn++; ?></td>
                        <td class="total_price"><?php echo $value['total_price']; ?></td>
                        <td class="order_date"><?php echo $value['order_date']; ?></td>
                        <td class="status"><?php echo $value['status']; ?></td>
                        <td class="customer_name"><?php echo $value['customer_name']; ?></td>
                        <td class="customer_contact"><?php echo $value['customer_contact']; ?></td>
                        <td class="customer_email" style="width: 15%;"><?php echo $value['customer_email']; ?></td>
                        <td class="customer_address" style="width: 15%;"><?php echo $value['customer_address']; ?></td>
                        <td style="width: 10%;">
                            <button update_id="<?php echo $value['id']; ?>" class="update_btn">
                                <img title="Update" src="http://localhost/php.course/FoodOrder/images/website/update.png" /></button>
                            <button delete_id="<?php echo $value['id']; ?>" class="delete_btn">
                                <img title="delete" src="http://localhost/php.course/FoodOrder/images/website/delete.png" /></button>
                        </td>
                    </tr>
            <?php
                }
            } else {
                echo "<div class='error'>Not Ordered Yet</div>";
            } ?>
        </table>
    </div>
</div>
<div style="width: 30%;" class="popup" id="updateOrderPopup">
    <form class="updateOrderForm" method="post" enctype="multipart/form-data">
        <h1>Update Order</h1>
        <table style="width: 100%;    margin:5px; font-weight:bold;">
            <tr>
                <td>Total Price :</td>
                <td><input type="text" id="total_price" name="total_price" placeholder="Enter Title" required style="padding: 0; margin:0;"></td>
            </tr>
            <tr>
                <td>Order Date :</td>
                <td><input type="text" id="order_date" name="order_date" placeholder=" Enter Price " readonly></td>
            </tr>
            <tr>
                <td>Status :</td>
                <td>
                    <select id="status" name="status">
                        <option value="ordered">Ordered</option>
                        <option value="on delivery">On Delivery</option>
                        <option value="delivered">Delivered</option>
                        <option value="cancelled">Cancelled</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Customer Name :</td>
                <td><input type="text" id="customer_name" name="customer_name" value="" placeholder="E.g. Mostafa Ramadan" class="input-responsive" required></td>
            </tr>
            <tr>
                <td>Customer Contact :</td>
                <td><input type="tel" id="customer_contact" name="customer_contact" value="" placeholder="E.g. 9843xxxxxx" class="input-responsive" required></td>
            </tr>
            <tr>
                <td>Customer Email :</td>
                <td><input type="email" id="customer_email" name="customer_email" placeholder="E.g. hi@mostafa.com" class="input-responsive" required></td>
            </tr>
            <tr>
                <td>Customer Address :</td>
                <td><textarea cols="30" rows="5" id="customer_address" name="customer_address" placeholder="E.g. Street, City, Country" name="adress"></textarea></td>
            </tr>
        </table>
        <input type="hidden" name="update_id" id="update_id">
        <input type="hidden" name="update_order">
        <button type="submit" class="add-btn update_action">Update</button>
        <button type="button" name="close" id="closeUpdateForm" class="close-btn">Close</button>
    </form>
</div>
</div>
<br>
<nav>
    <ul class="pagination">
        <li>
            <a <?php if ($page == 1) {
                    echo "class='disabled'";
                } ?> href="<?= $_SERVER['PHP_SELF'] . "?page=" . ($page - 1) ?>" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
                <span aria-hidden="true">Previous</span>
            </a>
        </li>
        <li>
            <a <?php if ($page == $page) {
                    echo "class='disabled'";
                } ?> href=""> Page <?= $page; ?> of <?= $pagesCount; ?></a>
        </li>
        <li>
            <a <?php if ($page == $pagesCount) {
                    echo "class='disabled'";
                } ?> href="<?= $_SERVER['PHP_SELF'] . "?page=" . ($page + 1) ?>" aria-label="Next">
                <span aria-hidden="true">Next</span>
                <span aria-hidden="true">&raquo;</span>
            </a>
        </li>
    </ul>
</nav>
<br>
<script src="../../jsFiles/orderActions.js"></script>
<?php
include_once("../partials/footer.php");
?>