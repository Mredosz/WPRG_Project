<?php
require_once "../../class/Database.php";
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
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
                            <a href="minusCart.php?itemID=<?php echo $row["itemID"]?>" class="badge">
                                -
                            </a>
                            <span class="list-group-item-text text-center badge">Quantity  <?php echo $row['quantity']; ?></span>
                            <a href="plusCart.php?itemID=<?php echo $row["itemID"]?>" class="badge">
                                +
                            </a>
                        </h4>
                        <p class="list-group-item-text"><?php echo $row['description']; ?>
                        <?php echo"<a class='badge pull-right' 
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
                <h3>Total amount to paid:  <?php echo $total; ?> $</h3>
                <button type="submit" class="signupbtn btn1" href="" name="submit">Checkout</button>
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
