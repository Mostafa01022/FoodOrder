<?php
include_once("../partials/menu.php");
?>

<div class="main-content">
    <div class="wrapper">
        <h1> Dashboard</h1>
        <br>

        <?php
        if (isset($_SESSION['user'])) {
            echo "<div class='success'> Hello ". $_SESSION['user']."</div>";
            unset($_SESSION['user']);
        }
        ?>
        <br> <br>
        <div class=" col-4 text-center">

            <h1>
                <?php
                $count = new manangeCategory();
                echo $count->categoryCount();
                ?>
            </h1></br>
            Category
        </div>
        <div class=" col-4 text-center">
            <h1>
                <?php
                $count = new manageFood();
                echo $count = $count->foodCount();
                ?>
            </h1></br>
            Food
        </div>
        <div class=" col-4 text-center">
            <h1>
                <?php
                $count = new manageOrder();
                echo $count = $count->orderCount();
                ?>
            </h1></br>
            Total Orders
        </div>
        <div class=" col-4 text-center">
            <h1>
                <?php
                $count = new manageOrder();
                $count = $count->renuvue();
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