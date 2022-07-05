<?php

require APPROOT . '/view/includes/head.php';
if (isLoggedIn() == TRUE) {
    header("Location: " . SITEURL . "/pages/index");
}

?>


<div id="form-container">
    <div id="form">
        <h2>Sign Up</h2>
        <form action="<?php echo SITEURL; ?>/customers/register" method="POST" autocomplete="off">

            <span class="invalidFeedback">
                <?php echo $data['unameError']; ?>
            </span>
            <input type="text" name="uname" placeholder="Username *">

            <span class="invalidFeedback">
                <?php echo $data['emailError']; ?>
            </span>
            <input type="email" name="email" placeholder="Email *">

            <span class="invalidFeedback">
                <?php echo $data['passwordError']; ?>
            </span>
            <input type="password" name="password" placeholder="Password *" id="pass1">

            <span class="invalidFeedback">
                <?php echo $data['confirmPasswordError']; ?>
            </span>
            <input type="password" name="confirmPassword" placeholder="Confirm Password *" id="pass2">

            <input type="checkbox" onclick=showPass()><span class="show">Show Password</span>
            <input type="submit" name="login" value="Login">

            <p>Already have an account? <a href="<?php echo SITEURL; ?>/customers/login">sign in</a></p>
        </form>
    </div>
</div>


<?php

require APPROOT . '/view/includes/footer.php';

?>