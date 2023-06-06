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
//Get information about order
$selectOrder = "SELECT deliverDate, orderID FROM `order` WHERE usersID = '$userID' ORDER BY orderID DESC LIMIT 1";
$resultOrder = Database::query($selectOrder);
$rowOrder = mysqli_fetch_array($resultOrder);

//path to bill.txt
$path = "../../../../WPRG_Project/bills/".$rowOrder['orderID'].".txt";

?>
<!--show time to delivery-->
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
<?php
if ($rolaId == 1){
    session_unset();
    session_destroy();
}
?>
</body>
</html>