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
    <?php
    if ($userID != 1 && $rolaId == 2) {
        ?>
        <?php
//            Get date from cookie
        $firstName = $_COOKIE['firstName'];
        $lastName = $_COOKIE['lastName'];
        $email = $_COOKIE['email'];
        $phoneNumber = $_COOKIE['address'];
        $tableNumber = $_COOKIE['tableNumber'];

        $resultAddress = Database::query("SELECT * FROM address WHERE addressID = '$phoneNumber'");
        $rowAddress = mysqli_fetch_array($resultAddress);

//            Get date from database
        $phoneNumber = $rowAddress['phoneNumber'];

        setcookie('phoneNumber', $phoneNumber, time() + (60 * 60));

     Checkout::checkoutPart2Time($userID, "Table");

        header("Location: checkoutTablePart3.php");

    } else {
//            Get date from cookie
        $firstName = $_COOKIE['firstName'];
        $lastName = $_COOKIE['lastName'];
        $email = $_COOKIE['email'];
        $phoneNumber = $_COOKIE['phoneNumber'];
        $tableNumber = $_COOKIE['tableNumber'];


//            Checking whether the specified user is in the database
        $selectUser = "SELECT * FROM users WHERE firstName='$firstName' AND lastName = '$lastName' 
                        AND email = '$email' AND rolaID = '1'";
        $resultUser = Database::query($selectUser);
//            If yes add address to user
        if (Database::numRows($resultUser) > 0) {

            $rowUsers = mysqli_fetch_array($resultUser);
            $userID = $rowUsers['usersID'];
            $selectAddress = "SELECT * FROM address WHERE usersID = '$userID' AND phoneNumber = '$phoneNumber'";
            $resultAddress = Database::query($selectAddress);

//                Checking whether a Phone Number is in the database, if so,
//             retrieves only the phone Number data in order not to waste space in the database.
            if (Database::numRows($resultAddress) == 0) {
                $newAddress = "INSERT INTO address (usersID, phoneNumber) VALUES
                                        ('$userID','$phoneNumber')";
                Database::query($newAddress);
            }

//                Update userID in cart to new userID
            $selectCart = "SELECT * FROM cart WHERE usersID = '1'";
            $resultCart = Database::query($selectCart);
            while ($row = mysqli_fetch_array($resultCart)) {
                $updateCart = "UPDATE cart SET usersID = '$userID' WHERE usersID = '1'";
                Database::query($updateCart);
            }

            Checkout::checkoutPart2Time($userID, "Table");

            header("Location: checkoutTablePart3.php");
        }
    }
    ?>
</div>
</body>
</html>