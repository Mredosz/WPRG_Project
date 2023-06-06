<?php
session_start();
require_once "../../class/Database.php";
require_once "../../class/Users.php";
require_once "../../class/Orders.php";
$usersID = $_SESSION['usersID'];
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
<body>
<?php
//Add navbar
require_once "../html_file/navbar_users.html";
?>
<div class="container-fluid color">
    <!--    Display errors-->
    <?php
    if (isset($error)) {
        foreach ($error as $item) {
            echo '<span class="error">' . $item . '</span>';
        }
    }
    ?>
    <div class="row">
        <div class="col col-12 text-center" style="margin-top: 70px">
            <span> <h1 class="h1">Your previous orders </h1></span>
        </div>
        <div class="col">
                <?php
                $num = $_GET['orderID'];

                $resultItem = Database::query("SELECT * FROM `order_position`
                    JOIN `order` o on o.orderID = order_position.orderID
                    JOIN users u on u.usersID = o.usersID
                    JOIN address a on u.usersID = a.usersID
                    WHERE order_position.orderID = '$num'");
                $row = mysqli_fetch_array($resultItem);


                Orders::displayYourInformation($row);
                ?>
        </div>
        <div class="col">
            <?php
            if ($row['deliver'] == 'Deliver') {
                Orders::displayYourAddress($row);
            }
            ?>
        </div>
        <div class="col col-12">
            <?php
            Orders::displayYourOrder($num, $usersID, $row);
            ?>
    </div>
</div>
</body>
</html>
