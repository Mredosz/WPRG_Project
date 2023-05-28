<?php
require_once "../../class/Database.php";

ob_start();
session_start();
if (isset($_SESSION['rolaID'])) {
    $rolaId = $_SESSION['rolaID'];
    $userID = $_SESSION['usersID'];
} else {
    $userID = $_SESSION['userID'];
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
    <script src="https://kit.fontawesome.com/1c154d6e40.js" crossorigin="anonymous"></script>
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
$selectOrder = "SELECT deliverDate, orderID FROM `order` WHERE usersID = '$userID' ORDER BY orderID DESC LIMIT 1";
$resultOrder = Database::query($selectOrder);
$rowOrder = mysqli_fetch_array($resultOrder);
//$path = "./bills/".$rowOrder['orderID'].".txt";
$path = "../../../../WPRG_Project/bills/".$rowOrder['orderID'].".txt";

?>
<div class="container-fluid">
    <div class="parent">
        <div class="div1">
            <h1>Thanks for your order</h1><br>
            <div class="text-center ">
                <i class="fa fa-clock fa-8x"></i><br><br>
                <h5>Your order will arrive to you at this hour:</h5>
                <h5><?php echo $rowOrder['deliverDate']; ?></h5>
                <a href="<?php echo $path;?>" download="bill.txt">
                    <button class="btn btn-outline-dark">Bill</button></a>
            </div>
        </div>
    </div>
</div>
<?php session_unset(); ?>
</body>
</html>