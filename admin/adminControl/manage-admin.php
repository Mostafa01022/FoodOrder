<?php
include_once("../partials/menu.php");

use Management\ManageAdmins;

$admin = new ManageAdmins();
$data = $admin->showAdmins();

?>

<div class="main-content">
    <div class="wrapper">
        <h1> Admin Manage </h1>
        <br>
        <div>
            <button id="add_btn" class="btn-primary">New Admin</button>
            <input type="search" placeholder="search ..." class="search">
        </div>
        <div id="action_message"></div>
        <br>
        <div class="popup" id="popupAdd">
            <form method="post" id="add_form">
                <h1>Add Admin</h1>
                <input type="text" name="fullName" id="fullName" placeholder="Full Name" required>
                <input type="text" name="username" id="username" placeholder="Username" required>
                <input type="text" name="password" id="password" placeholder="Password" required>
                <input type="text" name="confirm_pass" id="confirm_pass" placeholder="Confirm Password" required>
                <button type="submit" id="add_admin" name="add_admin" class="add-btn">Add</button>
                <button type="button" name="close" id="close_form" class="close-btn">Close</button>
            </form>
        </div>
        <div class="popup" id="updateUser">
            <form method="post" id="update_form">
                <h1>Update Admin</h1>
                <table style="width: 100%; font-weight:bold;">
                    <tr>
                        <td>Full Name :</td>
                        <td><input type="text" id="updateFullName" name="full_name" placeholder="Enter full name" required></td>
                    </tr>
                    <tr>
                        <td>Username :</td>
                        <td>
                            <input type="text" id="updateUsername" name="username" placeholder="Enter username" required>
                            <input type="hidden" id="updateId" name="id">
                        </td>
                    </tr>
                </table>
                <button type="submit" id="update_admin" name="update" class="add-btn">Update</button>
                <button type="button" name="close" id="close_update" class="close-btn">Close</button>
            </form>
        </div>
        <div class="popup" id="changePassForm">
            <form method="post" id="change_form">
                <h1>Change Password</h1>
                <tr>
                    <td>Current Password </td>
                    <td><input type="password" id="current_password" name="current_password" placeholder="current password" required></td>
                </tr>
                <tr>
                    <td>New Password </td>
                    <td><input type="password" id="new_password" name="new_password" placeholder="new password" required></td>
                </tr>
                <tr>
                    <td>Confirm Password </td>
                    <td><input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm Password" required></td>
                </tr>
                </table>
                <input type="hidden" name="id" id="changeId">
                <button type="submit" id="change_submit" name="update" class="add-btn">Update</button>
                <button type="button" name="close" id="change_close" class="close-btn">Close</button>
            </form>
        </div>
        <table class="tbl-full">
            <thead>
                <tr>
                    <th>S.N.</th>
                    <th>Full Name</th>
                    <th>Username</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody class="mytable">
                <?php
                $sn = 1;
                if ($data != "") {
                    foreach ($data as $value) {
                ?>
                        <tr id="admin_row_<?= $value['id'] ?>">
                            <td><?php echo $sn++; ?></td>
                            <td class="admin_full_name"><?php echo $value['full_name']; ?></td>
                            <td class="admin_username"><?php echo $value['username']; ?></td>
                            <td style=" width:25%;">
                                <button id="update_btn" value="<?= $value['id']; ?>" class=""><img title="Update" style=" padding:10px;" src="http://localhost/php.course/food-order/images/website/update.png" /></button>
                                <button id="change_btn" value="<?= $value['id']; ?>" class=""><img title="change password" style=" padding:10px;" src="http://localhost/php.course/food-order/images/website/change.png" /></button>
                                <button id="delete_btn" value="<?= $value['id']; ?>" class=""><img title="Delete" style=" padding:10px;" src="http://localhost/php.course/food-order/images/website/delete.png" /></button>
                            </td>
                        </tr>
                <?php
                    }
                } else {
                    echo "<div class='error'> Admins Not Added</div>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
<script src="../../jsFiles/adminActions.js"></script>

<?php
include_once("../partials/footer.php");
?>