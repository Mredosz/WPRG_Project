<?php
session_start();
// Connect to SQL
require_once "../../class/Addresses.php";
$usersID = $_SESSION['usersID'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!--    Website Title-->
    <title>Shrek's Restaurant</title>
    <!--    Custom CSS-->
    <link rel="stylesheet" type="text/css" href="../../style/form.css">
    <!--    Website icon-->
    <link rel="icon" href="../../../image/icon.ico">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../../style/css/bootstrap.css">
    <!-- Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<?php
require_once "../html_file/navbar_users.html";
?>

<div class="container-fluid" style="margin-top: 80px">
    <!--    Display errors-->
    <?php
    if (isset($error)) {
        foreach ($error as $item) {
            echo '<span class="error">' . $item . '</span>';
        }
    }
    ?>
    <div class="row row-cols-2">
        <div class="col-4 text-center">
            <span> <h1 class="h1">Add Address</h1></span>
        </div>
        <div class="col-8 text-center">
            <span><h1 class="h1">Edit & Delete Address</h1></span>
        </div>
        <div class="col-4">
            <!--            Form to add new address-->
            <form method="post" action="">
                <label for="city"><b>City</b></label>
                <input type="text" name="city" placeholder="Enter your City">

                <label for="zipCode"><b>Zip Code</b></label>
                <input type="text" name="zipCode" placeholder="Enter your zip code">

                <label for="street"><b>Street</b></label>
                <input type="text" name="street" placeholder="Enter your street">

                <label for="homeNumber"><b>Home Number</b></label>
                <input type="text" name="homeNumber" placeholder="Enter your home number">

                <label for="homeNumber"><b>Phone Number</b></label>
                <input type="tel" name="phoneNumber" placeholder="Enter your phone number">

                <div class="clearfix">
                    <button type="reset" class="cancelbtn">Cancel</button>
                    <button type="submit" class="signupbtn" name="submit">Add Addresses</button>
                </div>
            </form>
        </div>
        <div class="col-8">
            <!--            Display of all addresses of a given user-->
                <?php
                Addresses::addressesAdd($usersID);
                Addresses::addressesDisplay($usersID);
                ?>
        </div>
    </div>

</div>


</body>
</html>
