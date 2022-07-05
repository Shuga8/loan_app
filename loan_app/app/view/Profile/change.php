<?php

require APPROOT . '/view/includes/head.php';

?>

<div id="form-container">
    <div id="form">
        <?php foreach ($data['profiles'] as $profile) {
            if ($profile->customer_status !== "Verified") {
                header("Location: " . SITEURL . "/Profiles/profile");
            }
        } ?>
        <h2>Change Password</h2>
        <form action="" method="POST" autocomplete="off">

            <span class="invalidFeedback">
                <?php echo $data['pwdError']; ?>
            </span>
            <input type="password" name="pwd" placeholder="Enter new password *" id="new1">

            <span class="invalidFeedback">
                <?php echo $data['reenter_pwd_error']; ?>
            </span>
            <input type="password" name="reenter_pwd" placeholder="Re-enter new password *" id="new2">

            <span class="invalidFeedback">
                <?php echo $data['reenter_pwd_again_error']; ?>
            </span>
            <input type="password" name="reenter_pwd_again" placeholder="Re-enter new password again *" id="new3">

            <input type="checkbox" onclick=changeShow()><span class="show">Show Passwords</span>
            <input type="submit" name="change-pwd" value="Change Password">
        </form>
    </div>
</div>



<?php

require APPROOT . '/view/includes/footer.php';

?>