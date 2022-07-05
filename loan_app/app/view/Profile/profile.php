<?php

require APPROOT . '/view/includes/head.php';

?>

<div id="profile-container">

    <?php foreach ($data['profiles'] as $profile) : ?>
    <?php require '../app/functions/show_status.php'; ?>

    <div id="profile-items">
        <div id="profile-image">
            <form action="<?php echo SITEURL; ?>/profiles/image" method="POST" enctype="multipart/form-data"
                id="profileForm">
                <?php if (empty($profile->customer_image)) : ?>

                <img src="<?php echo SITEURL; ?>/public/imgs/profile_default.png" alt="Default Image" id="photo">
                <input type="file" id="file" name="file">
                <label for="file" id="uploadBtn">Choose Picture</label>

                <?php else : ?>

                <img src="<?php echo SITEURL; ?>/public/profile_images/<?php echo $profile->customer_image; ?>"
                    alt="ProfileImage">
                <input type="file" id="file" name="file">
                <label for="file" id="uploadBtn">Change Picture</label>

                <?php endif; ?>
            </form>
            <span class="invalidFeedback">
                <?php echo $data['imageError']; ?>
            </span>
        </div>
        <p><span class="info">Firtname:</span> <?php echo $profile->customer_firstname; ?></p>
        <p><span class="info">Middlename:</span> <?php echo $profile->customer_middlename; ?></p>
        <p><span class="info">Lastname:</span> <?php echo $profile->customer_lastname; ?></p>
        <p><span class="info">Username:</span> <?php echo $profile->customer_uname; ?></p>
        <p><span class="info">Email:</span> <?php echo $profile->customer_email; ?></p>
        <p><span class="info">Phone Number:</span> <?php echo $profile->customer_phone_number; ?></p>
        <p><span class="info">State:</span> <?php echo $profile->customer_address_state; ?></p>
        <p><span class="info">City:</span> <?php echo $profile->customer_address_city; ?></p>
        <p><span class="info">Street:</span> <?php echo $profile->customer_address_street; ?></p>
        <p><span class="info">Transaction ID:</span> <?php echo $profile->customer_id; ?></p>
        <p><span class="info">Registration On:</span> <?php echo $profile->customer_registration_date; ?></p>
        <?php

            if (empty($profile->customer_firstname) || empty($profile->customer_image)) {
                $message = "<span class='red'>Not Verified <i class='fa-solid fa-ban'></i></span>";
            } elseif (!empty($profile->customer_firstname) && !empty($profile->customer_image) && empty($profile->customer_status)) {
                $message = "<span class='lightgreen'>Verification Available</span>";
            } else {
                $message = "<span class='green'>Verified</span>";
            }

            ?>
        <p><span class="info">Status:</span> <?php echo $message; ?></p>

        <div id="action-container">
            <?php

                if (empty($profile->customer_status)) {
                    $message = "Not Verified";
                } else {
                    $message = "Verified";
                }

                ?>
            <a href="<?php echo SITEURL; ?>/profiles/verify" class="btn bg-cyan red mright20">
                <?php if ($message == "Not Verified") : ?>
                Add Details <i class="fa-solid fa-pen"></i>
                <?php elseif ($message == "Verified") : ?>
                Update Details <i class="fa-solid fa-pen"></i>
                <?php endif; ?>
            </a>
            <?php if ($message == "Not Verified") : ?>
            <a class="btn bg-cyan green mleft20 mright20">
                Verify First <i class="fa-solid fa-ban"></i>
            </a>
            <?php else : ?>
            <a href="<?php echo SITEURL; ?>/Profiles/change_password" class="btn bg-cyan green mleft20 mright20">
                Change Password <i class="fa-solid fa-unlock-keyhole"></i>
            </a>
            <?php endif; ?>
            <?php

                if (empty($profile->customer_firstname) || empty($profile->customer_image)) {
                    echo '<a class="btn bg-light-blue white mright20">Add Details & Picture <i class="fa-solid fa-ban"></i></a>';
                } elseif (!empty($profile->customer_firstname) && !empty($profile->customer_image && empty($profile->customer_status))) {
                    echo '<a href="' . SITEURL . '/Profiles/verifyAccount" class="btn bg-light-blue white mright20">Click To Verify Account</a>';
                } else {
                    echo '<a class="btn bg-blue white mright20">Verified <i class="fa-solid fa-circle-check"></i></a>';
                }

                ?>

        </div>
    </div>

    <?php endforeach; ?>

</div>

<?php

require APPROOT . '/view/includes/footer.php';

?>