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
    //    Checking if the user is logged in
    if ($userID != 1 && $rolaId != 1) {

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
                    <label for="firstName"><b>First Name</b></label>
                    <input type="text" name="firstName" placeholder="Enter Your First Name" required>

                    <label for="lastName"><b>Last Name</b></label>
                    <input type="text" name="lastName" placeholder="Enter Your Last Name" required>

                    <label for="email"><b>E-mail</b></label>
                    <input type="email" name="email" placeholder="Enter Your E-mail" required>

            </div>
            <div class="col">
                <!--            Show summary of order-->
                <?php
                Checkout::display($userID);
                ?>
            </div>
            <!--            button section-->
            <div class="clearfix col-12">
                <br>
                <button type="reset" class="cancelbtn">Cancel</button>
                <button type="submit" class="signupbtn" name="submit">Enter</button>
                </form>
            </div>
        </div>

        <?php
        if (isset($_POST['submit'])) {

            $firstName = $_POST['firstName'];
            $lastName = $_POST['lastName'];
            $email = $_POST['email'];

            $selectUser = "SELECT * FROM users WHERE firstName='$firstName' AND lastName = '$lastName' 
                        AND email = '$email' AND rolaID = '1'";
            $resultUser = Database::query($selectUser);

//            Checking whether a user is in the database, if so,
//             retrieves only the user's data in order not to waste space in the database.
            if ($row = Database::numRows($resultUser) <= 0) {
                $newUser = "INSERT INTO users (rolaID, firstName, lastName, email) VALUES
                                        ('1','$firstName', '$lastName', '$email')";
                Database::query($newUser);
            }

            setcookie('firstName', $firstName, time() + (60 * 60));
            setcookie('lastName', $lastName, time() + (60 * 60));
            setcookie('email', $email, time() + (60 * 60));
            header("Location: checkoutDeliveryPart2.php");
        }
    }
    ?>
</div>
</body>
</html>