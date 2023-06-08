<?php
require_once "../../class/Database.php";
require_once "../../class/Addresses.php";
require_once "../../class/Checkout.php";

ob_start();
session_start();
if (isset($_SESSION['rolaID'])) {
    $rolaId = $_SESSION['rolaID'];
    $userID = $_SESSION['usersID'];
} else {
    $firstName = $_COOKIE['firstName'];
    $lastName = $_COOKIE['lastName'];
    $email = $_COOKIE['email'];

    $selectUser = "SELECT * FROM users WHERE firstName='$firstName' AND lastName = '$lastName' 
                        AND email = '$email' AND rolaID = '1'";
    $resultUser = Database::query($selectUser);
    $rowUsers = mysqli_fetch_array($resultUser);
    $userID = $rowUsers['usersID'];
    $rolaId = 1;
}
if (!isset($_SESSION['payment'])){
    $_SESSION['payment'] = "Cash";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!--    Website Title-->
    <title>Shrek's Restaurant</title>
    <!--    Custom CSS-->
    <link rel="stylesheet" type="text/css" href="../../../src/style/cart.css">
    <?php
    require_once "../html_file/links.html";
    ?>
</head>
<body class="cart" id="cart">
<?php
if ($rolaId != 1) {
    require_once "../../../../WPRG_Project/src/users_website/html_file/navbar_users.html";
} else {
    require_once "../html_file/navbarDif.html";
}
if ($userID != 1 && $rolaId == 2) {
?>
<div class="container-fluid">

    <div class="row row-cols-2">
        <div class="col text-center">
            <h1 class="h1">Enter Information</h1>
        </div>
        <div class="col text-center">
            <h1 class="h1">Summary</h1>
        </div>
        <div class="col">
            <form action="" method="post">
                <!--                Show all information user entered to form-->
                <h3>Information</h3>
                <span class="pull-left"><b>First Name: </b><?php echo $_COOKIE['firstName']; ?></span><br>
                <span class="pull-left"><b>Last Name: </b><?php echo $_COOKIE['lastName']; ?></span><br>
                <span class="pull-left"><b>E-mail: </b><?php echo $_COOKIE['email']; ?></span><br>
                <span class="pull-left"><b>Phone Number: </b><?php echo $_COOKIE['phoneNumber']; ?></span><br>
                <span class="pull-left"><b>Table Number: </b><?php echo $_COOKIE['tableNumber']; ?></span><br>

                <?php
                Checkout::checkoutPar3CardPay();
                unset($_SESSION['payment']);
                ?>
                <button type="submit" name="submit" class="btn1">Checkout</button>
        </div>
        <div class="col">
            <!--            Show summary of order-->
            <?php
            Checkout::display($userID);
            ?>
        </div>
    </div>

    <?php
    if (isset($_POST['submit'])) {
        Checkout::checkoutPar3();
        Checkout::billTable($userID);
        $payment = $_POST['payment'];
        $_SESSION['payment'] = $payment;
        if ($payment == 'Card') {
            header("Location: checkoutTablePart3.php");
        } else {
            unset($_SESSION['payment']);
            $deleteCart = "DELETE FROM cart WHERE usersID = '$userID'";
            Database::query($deleteCart);
            header("Location: end.php");
        }
    }
    ?>
</div>
</body>
</html>
<?php
}else{
?>
<div class="container-fluid">

    <div class="row row-cols-2">
        <div class="col text-center">
            <h1 class="h1">Enter Information</h1>
        </div>
        <div class="col text-center">
            <h1 class="h1">Summary</h1>
        </div>
        <div class="col">
            <form action="" method="post">
                <!--                Show all information user entered to form-->
                <h3>Information</h3>
                <span class="pull-left"><b>First Name: </b><?php echo $_COOKIE['firstName']; ?></span><br>
                <span class="pull-left"><b>Last Name: </b><?php echo $_COOKIE['lastName']; ?></span><br>
                <span class="pull-left"><b>E-mail: </b><?php echo $_COOKIE['email']; ?></span><br>
                <span class="pull-left"><b>Phone Number: </b><?php echo $_COOKIE['phoneNumber']; ?></span><br>
                <span class="pull-left"><b>Table Number: </b><?php echo $_COOKIE['tableNumber']; ?></span><br>

                <?php
                Checkout::checkoutPar3CardPay();
                unset($_SESSION['payment']);
                ?>

                <button type="submit" name="submit" class="btn1">Checkout</button>
            </form>
        </div>
        <div class="col">
            <!--            Show summary of order-->
            <?php
            Checkout::display($userID);
            ?>
        </div>
    </div>

    <?php
    if (isset($_POST['submit'])) {
        Checkout::checkoutPar3();
        Checkout::billTable($userID);
        //    Delete items from table cart
        $payment = $_POST['payment'];
        $_SESSION['payment'] = $payment;
        if ($payment == 'Card') {
            header("Location: checkoutTablePart3.php");
        } else {
            unset($_SESSION['payment']);
            $deleteCart = "DELETE FROM cart WHERE usersID = '$userID'";
            Database::query($deleteCart);
            header("Location: end.php");
        }
    }
    }
    ?>
</div>
</body>
</html>