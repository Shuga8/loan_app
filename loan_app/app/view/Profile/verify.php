<?php

require APPROOT . '/view/includes/head.php';

?>

<div id="verification-container">
    <div id="form">
        <h2>Verify Account</h2>

        <div id="details-container">
            <?php foreach ($data['profiles'] as $profile) : ?>

            <form action="<?php echo SITEURL; ?>/profiles/verify" method="POST">

                <span class="invalidFeedback">
                    <?php echo $data['fnameError']; ?>
                </span>
                <input type="text" placeholder="Firstname" value="<?php echo $profile->customer_firstname; ?>"
                    name="fname">

                <span class="invalidFeedback">
                    <?php echo $data['mnameError']; ?>
                </span>
                <input type="text" placeholder="middlename" value="<?php echo $profile->customer_middlename; ?>"
                    name="mname">

                <span class="invalidFeedback">
                    <?php echo $data['lnameError']; ?>
                </span>
                <input type="text" placeholder="Lastname" value="<?php echo $profile->customer_lastname; ?>"
                    name="lname">

                <span class="invalidFeedback">
                    <?php echo $data['unameError']; ?>
                </span>
                <input type="text" placeholder="Username" value="<?php echo $profile->customer_uname; ?>" name="uname">

                <span class="invalidFeedback">
                    <?php echo $data['emailError']; ?>
                </span>
                <input type="email" placeholder="Email" value="<?php echo $profile->customer_email; ?>" name="email">

                <span class="invalidFeedback">
                    <?php echo $data['phoneError']; ?>
                </span>
                <input type="tel" placeholder="Phone Number" value="<?php echo $profile->customer_phone_number; ?>"
                    name="phone">

                <span class="invalidFeedback">
                    <?php echo $data['stateError']; ?>
                </span>
                <input type="text" placeholder="State" value="<?php echo $profile->customer_address_state; ?>"
                    name="state">

                <span class="invalidFeedback">
                    <?php echo $data['cityError']; ?>
                </span>
                <input type="text" placeholder="City" value="<?php echo $profile->customer_address_city; ?>"
                    name="city">

                <span class="invalidFeedback">
                    <?php echo $data['streetError']; ?>
                </span>
                <input type="text" placeholder="Street" value="<?php echo $profile->customer_address_street; ?>"
                    name="street">
                <input type="submit" name="verify" value="Add Details">
            </form>

            <?php endforeach; ?>
        </div>
    </div>
</div>

<?php

require APPROOT . '/view/includes/footer.php';

?>