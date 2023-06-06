<?php
require_once "../../class/Database.php";
session_start();
ob_start();
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
?>
<div class="container-fluid">
    <!--    <div class="row">-->
    <?php
    $select = "SELECT  quantity, totalPrice, c.name AS category, description, i.name AS name, cartID, i.itemID FROM cart
    JOIN item i on i.itemID = cart.itemID
    JOIN category c on c.categoryID = i.categoryID
    JOIN users u on u.usersID = cart.usersID WHERE u.usersID ='$userID'";
    $result = Database::query($select);
    $total = 0;
    ?>
    <div class="row">
        <div class="col-sm-7">
            <!--            Display information about item from menu-->
            <?php
            while ($row = mysqli_fetch_array($result)) {
                $total += $row['totalPrice'];
                ?>
                <ul class="list-group">
                    <li class="list-group-item">
                        <h4 class="list-group-item-heading"><?php echo $row['name']; ?>
                            <span class="badge pull-right"><?php echo $row['totalPrice'] . " $"; ?></span>
                            <span class="list-group-item-text category"><?php echo $row['category']; ?></span>
                            <a href="minusCart.php?itemID=<?php echo $row["itemID"] ?>" class="badge">
                                -
                            </a>
                            <span class="list-group-item-text text-center badge">Quantity  <?php echo $row['quantity']; ?></span>
                            <a href="plusCart.php?itemID=<?php echo $row["itemID"] ?>" class="badge">
                                +
                            </a>
                        </h4>
                        <p class="list-group-item-text"><?php echo $row['description']; ?>
                            <?php echo "<a class='badge pull-right' 
                                href=\"cartDelete.php?cartID=$row[cartID]\">Delete</a>"; ?>
                        </p>
                    </li>
                </ul>
                <?php
            }
            ?>
        </div>
        <div class="col-4">
            <div class="text-center">
                <h3>Total amount to paid: <?php echo $total; ?> $</h3>
                <form action="" method="post">
                    <h5>Delivery</h5><br>
                    <input type="radio" class="btn-check" name="delivery" id="delivery1" value="1" checked>
                    <label class="btn btn-outline-dark" for="delivery1">Collect order</label>

                    <input type="radio" class="btn-check" name="delivery" id="delivery2" value="2">
                    <label class="btn btn-outline-dark" for="delivery2">Deliver order</label>

                    <input type="radio" class="btn-check" name="delivery" id="delivery3" value="3">
                    <label class="btn btn-outline-dark" for="delivery3">Table order</label>
                    <button type="submit" name="submit" class="btn1">Checkout</button>
                </form>
                <?php
                if (isset($_POST['submit'])) {
                    switch ($_POST['delivery']) {
                        case 1:
                            header("Location: checkoutCollectPart1.php ");
                            break;
                        case 2:
                            header("Location: checkoutDeliveryPart1.php ");

                            break;
                        case 3:
                            header("Location: checkoutTablePart1.php ");

                            break;
                    }
                }
                ?>
            </div>
        </div>
    </div>
    <?php
    echo "<hr>";

    Database::disconnect();
    ?>
</div>
</body>
</html>
