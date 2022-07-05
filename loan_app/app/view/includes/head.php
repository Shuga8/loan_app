<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo SITENAME; ?></title>
    <link rel="stylesheet" href="<?php echo SITEURL; ?>/public/css/style.css">
    <script src="https://kit.fontawesome.com/cfbcf59bd3.js" crossorigin="anonymous"></script>
</head>

<body>
    <div id="top"></div>
    <header>
        <img src="<?php echo SITEURL; ?>/public/imgs/cat-g8660481bb_640.png" alt="Logo" class="header-logo">
        <nav id="navbar-container">

            <ul>
                <li>
                    <a href="<?php echo SITEURL; ?>/pages/index"><i class="fa-solid fa-house"></i>
                        Home</a>
                </li>

                <li>
                    <a href="<?php echo SITEURL; ?>/pages/contact"><i class="fa-solid fa-mobile-screen"></i> Contact
                        Us</a>
                </li>
                <?php if (isset($_SESSION['customer_id'])) : ?>
                <li>
                    <a href="<?php echo SITEURL; ?>/profiles/profile"><i class="fa-solid fa-user"></i> Profile</a>
                </li>
                <?php if ($_SESSION['status'] === "Verified") : ?>
                <li>
                    <a href="<?php echo SITEURL; ?>/loans/index"><i class="fa-solid fa-hand-holding-dollar"></i>
                        Loan</a>
                </li>
                <?php else : ?>
                <li>
                    <a onclick="tell()" class="cursor"><i class="fa-solid fa-hand-holding-dollar"></i> Loan</a>
                </li>
                <?php endif; ?>
                <li>
                    <a href="<?php echo SITEURL; ?>/customers/logout"><i class="fa-solid fa-right-to-bracket"></i> Log
                        out</a>
                </li>
                <?php else : ?>

                <li>
                    <a href="<?php echo SITEURL; ?>/customers/login"><i class="fa-solid fa-right-to-bracket"></i> Log
                        In</a>
                </li>

                <?php endif; ?>
            </ul>
        </nav>
    </header>