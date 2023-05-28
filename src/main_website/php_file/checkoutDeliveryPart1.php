<?php
require_once "../../class/Database.php";
require_once "../../class/Checkout.php";
ob_start();
session_start();
if (isset($_SESSION['rolaID'])) {
    $rolaId = $_SESSION['rolaID'];
    $userID = $_SESSION['usersID'];
} else {
    $userID = 1;
    $rolaId = 1;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!--    Website Title-->
    <title>Shrek's Restaurant</title>
    <!--    Custom CSS-->
    <link rel="stylesheet" type="text/css" href="../../../src/style/style.css">
    <link rel="stylesheet" type="text/css" href="../../../src/style/cart.css">
    <!--    Website icon-->
    <link rel="icon" href="/image/icon%20-%20Copy%20-%20Copy.ico">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../../style/css/bootstrap.css">
    <!-- Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <!--    Icons-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
</head>
<body class="cart" id="cart">
<?php
if ($rolaId != 1) {
    require_once "../../../../WPRG_Project/src/users_website/html_file/navbar_users.html";
} else {
    require_once "../html_file/navbarDif.html";
}
?>
<div class="container-fluid">
    <?php
    //    Checking if the user is logged in
    if ($userID != 1 && $rolaId != 1) {
        $result = Database::query("SELECT * FROM users WHERE usersID = '$userID'");
        $row = mysqli_fetch_array($result);
        ?>
        <div class="row row-cols-2">
            <div class="col text-center">
                <h1 class="h1">Enter Information</h1>
            </div>
            <div class="col text-center">
                <h1 class="h1">Summary</h1>
            </div>
            <div class="col">
                <form action="" method="post">
                    <?php
                    Checkout::checkoutPart1formLogin();
                    ?>
            </div>
            <div class="col">
                <!--            Show summary of order-->
                <?php
                Checkout::display($userID);
                ?>
            </div>
            <!--            button section-->
            <div class="clearfix col-12">
                <?php
                Checkout::checkoutButton();
                ?>
            </div>
        </div>

        <?php
        if (isset($_POST['submit'])) {
            Checkout::checkoutPart1Login();

            header("Location: checkoutDeliveryPart2.php");
        }
    } else {
        ?>

        <div class="row row-cols-2">
            <div class="col text-center">
                <h1 class="h1">Enter Information</h1>
            </div>
            <div class="col text-center">
                <h1 class="h1">Summary</h1>
            </div>
            <div class="col">
                <form action="" method="post">
                    <?php
                    Checkout::checkoutPart1Form();
                    ?>
            </div>
            <div class="col">
                <!--            Show summary of order-->
                <?php
                Checkout::display($userID);
                ?>
            </div>
            <!--            button section-->
            <?php
            Checkout::checkoutButton();
            ?>
        </div>

        <?php
        if (isset($_POST['submit'])) {
            Checkout::checkoutPart1();

            header("Location: checkoutDeliveryPart2.php");
        }
    }
    ?>
</div>
</body>
</html>