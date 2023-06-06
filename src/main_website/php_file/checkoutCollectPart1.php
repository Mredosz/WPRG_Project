<?php
require_once "../../class/Database.php";
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
    //    Checking if the user is logged in
    if ($userID != 1 && $rolaId != 1) {
        $result = Database::query("SELECT * FROM users WHERE usersID = '$userID'");
        $row = mysqli_fetch_array($result);
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
                    <label for="firstName"><b>First Name</b></label>
                    <input type="text" name="firstName" value="<?php echo $row['firstName'] ?>" required>

                    <label for="lastName"><b>Last Name</b></label>
                    <input type="text" name="lastName" value="<?php echo $row['lastName'] ?>" required>

                    <label for="email"><b>E-mail</b></label>
                    <input type="email" name="email" value="<?php echo $row['email'] ?>" required>

                    <label for="phoneNumber"><b>Phone Number</b></label>
                    <select name="phoneNumber">
                        <?php
                        //Show select with all cells from table
                        $resultAddress = Database::query("SELECT * FROM address WHERE usersID = '$userID'");
                        while ($row = mysqli_fetch_array($resultAddress)) {
                            $id = $row['addressID'];
                            $name = $row['phoneNumber'];
                            ?>
                            <option value="<?php echo $id; ?>"<?php if ($id == $row['addressID']) {
                                echo "selected";
                            } ?>><?php echo $name; ?></option>
                            <?php
                        }
                        ?>
                    </select>
            </div>
            <div class="col">
                <!--            Show summary of order-->
                <?php
                Checkout::display($userID);
                ?>
            </div>
            <!--            button section-->
            <div class="clearfix col-12">
                <?php
                Checkout::checkoutButton();
                ?>
            </div>
        </div>

        <?php
        if (isset($_POST['submit'])) {
            $phoneNumber = $_POST['phoneNumber'];
            setcookie('address', $phoneNumber, time() + (60 * 60));
            Checkout::checkoutPart1Login();

            header("Location: checkoutCollectPart2.php");
        }
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
                    <?php
                    Checkout::checkoutPart1Form();
                    ?>
                    <label for="phoneNumber"><b>Phone Number</b></label>
                    <input type="tel" name="phoneNumber" placeholder="Enter Your Phone Number" required>
            </div>
            <div class="col">
                <!--            Show summary of order-->
                <?php
                Checkout::display($userID);
                ?>
            </div>
            <!--            button section-->
            <?php
            Checkout::checkoutButton();
            ?>
        </div>

        <?php
        if (isset($_POST['submit'])) {
            $phoneNumber = $_POST['phoneNumber'];
            setcookie('phoneNumber', $phoneNumber, time() + (60 * 60));
            Checkout::checkoutPart1();

            header("Location: checkoutCollectPart2.php");
        }
    }
    ?>
</div>
</body>
</html>