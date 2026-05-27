<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>
<?php
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
?>

<?php
include('template/head.php');
?>

<body class="header-fixed header-tablet-and-mobile-fixed aside-fixed aside-secondary-disabled">
    <div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
        <?php include('template/navbar.php'); ?>

        <div class="d-flex flex-column flex-root">
            <div class="page d-flex flex-row flex-column-fluid">

                <?php include('template/menu.php'); ?>

                <div class="content d-flex flex-column flex-column-fluid" id="principal">
                    <?php include('system/principal.php'); ?>
                </div>
            </div>
        </div>
    </div>
</body>
<?php include("template/footer.php"); ?>

