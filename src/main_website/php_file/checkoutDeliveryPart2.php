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
        $address = $_COOKIE['address'];

        $resultAddress = Database::query("SELECT * FROM address WHERE addressID = '$address'");
        $rowAddress = mysqli_fetch_array($resultAddress);

//            Get date from database
        $phoneNumber = $rowAddress['phoneNumber'];
        $city = $rowAddress['city'];
        $zipCode = $rowAddress['zipCode'];
        $street = $rowAddress['street'];
        $homeNumber = $rowAddress['homeNumber'];

        setcookie('city', $city, time() + (60 * 60));
        setcookie('street', $street, time() + (60 * 60));
        setcookie('zipCode', $zipCode, time() + (60 * 60));
        setcookie('homeNumber', $homeNumber, time() + (60 * 60));
        setcookie('phoneNumber', $phoneNumber, time() + (60 * 60));

//            add current time
        $rand = rand(45, 80);
        $current_time = new DateTime();
        $date = $current_time->format('d/m/y  H:i');

//            Add deliver time
        $time = new DateTime();
        $time->add(new DateInterval('PT' . $rand . 'M'));
        $deliveryDate = $time->format("d/m/y  H:i");
        $total = Checkout::display($userID);
//                Create new field in order table
        $insertOrder = "INSERT INTO `order` (usersID, deliver, payment, date_order, total_price, deliverDate)
                   VALUES ('$userID', 'Deliver', 'Cash', '$date', '$total',' $deliveryDate' ) ";
        Database::query($insertOrder);

        header("Location: checkoutDeliveryPart3.php");

    } else {
        ?>

        <div class="row row-cols-2">
            <div class="col text-center">
                <h1 class="h1">Enter Information</h1>
            </div>
            <div class="col text-center">
                <h1 class="h1">Summary</h1>
            </div>
            <div class="col">
                <form action="" method="post">
                    <label for="city"><b>City</b></label>
                    <input type="text" name="city" placeholder="Enter your City">

                    <label for="zipCode"><b>Zip Code</b></label>
                    <input type="text" name="zipCode" placeholder="Enter your zip code">

                    <label for="street"><b>Street</b></label>
                    <input type="text" name="street" placeholder="Enter your street">

                    <label for="homeNumber"><b>Home Number</b></label>
                    <input type="text" name="homeNumber" placeholder="Enter your home number">

                    <label for="phoneNumber"><b>Phone Number</b></label>
                    <input type="tel" name="phoneNumber" placeholder="Enter your phone number">
            </div>
            <div class="col">
                <!--            Show summary of order-->
                <?php
                $total = Checkout::display($userID);
                ?>
            </div>
            <div class="clearfix col-12">
                <br>
                <button type="reset" class="cancelbtn">Cancel</button>
                <button type="submit" class="signupbtn" name="submit">Enter</button>
                </form>
            </div>
        </div>

        <?php
        if (isset($_POST['submit'])) {
//            Get date from cookie
            $firstName = $_COOKIE['firstName'];
            $lastName = $_COOKIE['lastName'];
            $email = $_COOKIE['email'];
            $phoneNumber = $_POST['phoneNumber'];

//            Get date from form
            $city = $_POST['city'];
            $zipCode = $_POST['zipCode'];
            $street = $_POST['street'];
            $homeNumber = $_POST['homeNumber'];

//            Checking whether the specified user is in the database
            $selectUser = "SELECT * FROM users WHERE firstName='$firstName' AND lastName = '$lastName' 
                        AND email = '$email' AND rolaID = '1'";
            $resultUser = Database::query($selectUser);
//            If yes add address to user
            if (Database::numRows($resultUser) > 0) {

                $rowUsers = mysqli_fetch_array($resultUser);
                $userID = $rowUsers['usersID'];
                $selectAddress = "SELECT * FROM address WHERE usersID = '$userID' AND city = '$city' AND 
                            zipCode = '$zipCode' AND street = '$street' AND phoneNumber = '$phoneNumber'";
                $resultAddress = Database::query($selectAddress);

//                Checking whether a address is in the database, if so,
//             retrieves only the address data in order not to waste space in the database.
                if (Database::numRows($resultAddress) == 0) {
                    $newAddress = "INSERT INTO address (usersID, city, zipCode, street, homeNumber, phoneNumber) VALUES
                                        ('$userID','$city', '$zipCode', '$street', ' $homeNumber', '$phoneNumber')";
                    Database::query($newAddress);
                }

                setcookie('city', $city, time() + (60 * 60));
                setcookie('street', $street, time() + (60 * 60));
                setcookie('zipCode', $zipCode, time() + (60 * 60));
                setcookie('homeNumber', $homeNumber, time() + (60 * 60));
                setcookie('phoneNumber', $phoneNumber, time() + (60 * 60));

//            add current time
                $rand = rand(45, 80);
                $current_time = new DateTime();
                $date = $current_time->format('d/m/y  H:i');

//            Add deliver time
                $time = new DateTime();
                $time->add(new DateInterval('PT' . $rand . 'M'));
                $deliveryDate = $time->format("d/m/y  H:i");

//                Create new field in order table
                $insertOrder = "INSERT INTO `order` (usersID, deliver, payment, date_order, total_price, deliverDate)
                   VALUES ('$userID', 'Deliver', 'Cash', '$date', '$total',' $deliveryDate' ) ";
                Database::query($insertOrder);

//                Update userID in cart to new userID
                $selectCart = "SELECT * FROM cart WHERE usersID = '1'";
                $resultCart = Database::query($selectCart);
                while ($row = mysqli_fetch_array($resultCart)) {
                    $updateCart = "UPDATE cart SET usersID = '$userID' WHERE usersID = '1'";
                    Database::query($updateCart);
                }

                header("Location: checkoutDeliveryPart3.php");
            }
        }
    }
    ?>
</div>
</body>
</html>