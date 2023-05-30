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

                <h5>Payment</h5><br>
                <input type="radio" class="btn-check" name="payment" id="payment1" value="Card" checked>
                <label class="btn btn-outline-dark" for="payment1">Card</label>

                <input type="radio" class="btn-check" name="payment" id="payment2" value="Cash">
                <label class="btn btn-outline-dark" for="payment2">Cash</label>

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
        Checkout::billCollect($userID);
        header("Location: end.php");
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

                <h5>Payment</h5><br>
                <input type="radio" class="btn-check" name="payment" id="payment1" value="Card" checked>
                <label class="btn btn-outline-dark" for="payment1">Card</label>

                <input type="radio" class="btn-check" name="payment" id="payment2" value="Cash">
                <label class="btn btn-outline-dark" for="payment2">Cash</label>

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
        Checkout::billCollect($userID);
        header("Location: end.php");
    }
    }
    ?>
</div>
</body>
</html>