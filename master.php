<!DOCTYPE html>
<html lang="en">

<?php
include "./config/config.php";
include "./config/db.php";
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $pageTitle ?></title>

    <!-- bootstrap -->
    <link rel="stylesheet" href="<?= $base_url ?>assets/lib/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= $base_url ?>assets/css/style.css">
</head>

<body>

    <?php include "./includes/header.php"; ?>

    <div class="wrapper">
        <?php include "./includes/sidebar.php"; ?>
        <div class="wrapper-content">
            <?php echo $pageContent; ?>
        </div>
    </div>

    <!-- scripts -->
    <script src="<?= $base_url ?>assets/lib/jquery/jquery.min.js"></script>
    <script src="<?= $base_url ?>assets/lib/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>