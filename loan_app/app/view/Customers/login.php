<?php

require APPROOT . '/view/includes/head.php';
if (isLoggedIn() == TRUE) {
    header("Location: " . SITEURL . "/pages/index");
}

?>


<div id="form-container">
    <div id="form">
        <h2>Sign In</h2>
        <form action="<?php echo SITEURL; ?>/customers/login" method="POST" autocomplete="off">

            <span class="invalidFeedback">
                <?php echo $data['unameEmailError']; ?>
            </span>
            <input type="text" name="unameEmail" placeholder="Username/Email *">

            <span class="invalidFeedback">
                <?php echo $data['passwordError']; ?>
            </span>
            <input type="password" name="password" placeholder="Password *" id="pass">

            <input type="checkbox" onclick=show()><span class="show">Show Password</span>
            <input type="submit" name="login" value="Login">

            <p>Don't have an account? <a href="<?php echo SITEURL; ?>/customers/register">sign up</a></p>
        </form>
    </div>
</div>
<?php

require APPROOT . '/view/includes/footer.php';

?>