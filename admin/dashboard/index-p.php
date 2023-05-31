<?php
include_once("../partials/menu.php");

$manangeCategory = new \Management\ManangeCategory();
$manageFood = new \Management\ManageFood();
$manageOrder = new \Management\ManageOrder();

?>

<div class="main-content">
    <div class="wrapper">
        <h1> Dashboard</h1>
        <br>
        <?php
        if (isset($_SESSION['admin'])) {
            echo "<div class='success'> Hello " . $_SESSION['admin'] . "</div>";
            unset($_SESSION['admin']);
        }
        ?>
        <br>
        <div id="action_message"></div>
        <br>
        <div class=" col-4 text-center">
            <h1>
                <?php
                echo $manangeCategory->categoryCount();
                ?>
            </h1></br>
            Category
        </div>
        <div class=" col-4 text-center">
            <h1>
                <?php
                echo  $manageFood->foodCount();
                ?>
            </h1></br>
            Food
        </div>
        <div class=" col-4 text-center">
            <h1>
                <?php
                echo  $manageOrder->orderCount();
                ?>
            </h1></br>
            Total Orders
        </div>
        <div class=" col-4 text-center">
            <h1>
                <?php
                $count = $manageOrder->renuvue();
                ?>
            </h1></br>
            Renuvue
        </div>
        <div class="clearfix"></div>
    </div>
</div>

<?php
include_once("../partials/footer.php");
?>