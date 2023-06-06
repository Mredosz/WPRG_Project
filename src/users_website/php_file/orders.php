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
    <div class="row row-cols-1">
        <div class="col text-center" style="margin-top: 70px">
            <span><h1 class="h1">Your previous orders </h1></span>
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
                $resultOrders = Database::query("SELECT * FROM `order` WHERE usersID = '$usersID' 
                      ORDER BY orderID DESC ");

                    Orders::displayOrder($resultOrders);
                ?>
            </table>
        </div>
    </div>
</div>
</body>
</html>
