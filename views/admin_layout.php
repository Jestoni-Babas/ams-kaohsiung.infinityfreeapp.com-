<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'MCGI-AMS' ?></title>
    <link rel="stylesheet" type="text/css" href="<?= $base ?>/src/css/app.css" />
    <link rel="stylesheet" type="text/css" href="<?= $base ?>/src/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="<?= $base ?>/src/css/glyphicons.css" />
    <script src="<?= $base ?>/src/js/bootstrap.min.js"></script>
</head>
<body>

<header class="admin_header">
    <?php require 'admin_header.php'; ?>
</header>
<main class="admin_main">
    <aside class="admin_aside">
        <?php require 'admin_menu.php'; ?>
    </aside>
    <section class="admin_section">
        <?= $content; ?>
    </section>
</main>
<footer class="admin_footer bg-light">
    <p class="text-secondary text-center m-0 py-2">
        &copy;<?= date("Y"); ?> All rights reserved - MCGI Kaohsiung
    </p>
</footer>


<script>
    const BASE_URL = "<?= $base ?>";
</script>
<script src="<?= $base ?>/src/js/burger.js"></script>
<?php
    if($title === "Qrcode"){
?>
<script src="<?= $base ?>/src/js/vendor/html5-qrcode.min.js"></script>
<script src="<?= $base ?>/src/js/qr_scanner.js"></script>
<?php
    }
?>


<?php
    if($title === "Start_attendance"){
?>
<script src="<?= $base ?>/src/js/attendance_gathering_types.js"></script>
<script src="<?= $base ?>/src/js/show_qrcode_scanner.js"></script>
<script src="<?= $base ?>/src/js/vendor/html5-qrcode.min.js"></script>
<script src="<?= $base ?>/src/js/qr_scanner.js"></script>
<?php
    }
?>


<?php
    if($title === "Settings"){
?>
<script src="<?= $base ?>/src/js/locale_edit.js"></script>
<script src="<?= $base ?>/src/js/locale_delete.js"></script>
<script src="<?= $base ?>/src/js/add_locale_form.js"></script>
<script src="<?= $base ?>/src/js/locale_list.js"></script>

<script src="<?= $base ?>/src/js/gathering_edit.js"></script>
<script src="<?= $base ?>/src/js/gathering_delete.js"></script>
<script src="<?= $base ?>/src/js/add_gathering_form.js"></script>
<script src="<?= $base ?>/src/js/gathering_list.js"></script>
<?php
    }
?>

<?php

if($title === "Profiles" || $title === "Profiles_add"){
?>
<script src="<?= $base ?>/src/js/vendor/qr-code-styling.js"></script>
<script src="<?= $base ?>/src/js/profiles.js"></script>
<script src="<?= $base ?>/src/js/profile_add.js"></script>
<script src="<?= $base ?>/src/js/get_locales_loader.js"></script>
<script src="<?= $base ?>/src/js/get_minimum_profiles.js"></script>
<?php
}
?>


<?php
    if($title === "Login" || $title === "Register"){
?>

<script src="<?= $base ?>/src/js/register.js"></script>
<script src="<?= $base ?>/src/js/login.js"></script>

<?php
    }
?>

</body>
</html>