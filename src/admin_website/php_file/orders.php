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
    <div class="row row-cols-1">
        <div class="col text-center" style="margin-top: 70px">
            <h1 class="h1">Your previous orders </h1>
        </div>
        <div class="col">
            <table class="table">
                <thead>
                <tr>
                    <?php
                    Orders::displayOrderTab();
                    ?>
                </tr>
                </thead>
                <?php
                $resultOrders = Database::query("SELECT * FROM `order` ORDER BY orderID DESC ");

                Orders::displayOrder($resultOrders);
                ?>
            </table>
        </div>
    </div>
</div>
</body>
</html>
