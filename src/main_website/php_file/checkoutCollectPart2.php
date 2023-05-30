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

        $resultAddress = Database::query("SELECT * FROM address WHERE addressID = '$phoneNumber'");
        $rowAddress = mysqli_fetch_array($resultAddress);

//            Get date from database
        $phoneNumber = $rowAddress['phoneNumber'];

        setcookie('phoneNumber', $phoneNumber, time() + (60 * 60));
        Checkout::checkoutPart2Time($userID, "Collect");

        header("Location: checkoutCollectPart3.php");

    } else {
//            Get date from cookie
        $firstName = $_COOKIE['firstName'];
        $lastName = $_COOKIE['lastName'];
        $email = $_COOKIE['email'];
        $phoneNumber = $_COOKIE['phoneNumber'];

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
            Checkout::checkoutPart2Time($userID, "Collect");
            header("Location: checkoutCollectPart3.php");
        }
    }
    ?>
</div>
</body>
</html>