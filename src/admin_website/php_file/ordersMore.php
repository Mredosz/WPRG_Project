<?php
session_start();
require_once "../../class/Database.php";
require_once "../../class/Orders.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!--    Website Title-->
    <title>Admin Website</title>
    <?php
    require_once "../html_file/links.html";
    ?>
</head>
<body>
<?php
//Add navbar
require_once "../php_file/navbar.php";
?>
<div class="container-fluid color">
    <div class="row">
        <div class="col col-12 text-center" style="margin-top: 70px">
            <h1 class="h1">Your previous orders </h1>
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
                $usersID = $row['usersID'];

               Orders::displayYourInformation($row);
                ?>
        </div>
        <div class="col">
            <?php
                Orders::displayYourAddress($row);
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
