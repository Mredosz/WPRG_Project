<?php
session_start();
// Connect to SQL
include "addresses.php";
global $resultAddresses;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!--    Website Title-->
    <title>Shrek's Restaurant</title>
    <!--    Custom CSS-->
    <link rel="stylesheet" type="text/css" href="../../../src/style/form.css">
    <!--    Website icon-->
    <link rel="icon" href="../../../image/icon.ico">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
</head>
<body>
<nav class="navbar bg-dark navbar-dark px-3 mb-3">
    <a class="navbar-brand" href="../../../src/users_website/php_file/users_index.php">Shrek's Restaurant</a>
    <h1 class="h">Settings</h1>
</nav>

<div class="container-fluid" style="border: #04AA6D 5px solid">
    <div class="row row-cols-2">
        <div class="col text-center" style="border: #04AA6D 5px solid">
            <h1 class="h1">Addresses</h1>
        </div>
        <div class="col text-center">
            <h1 class="h1">Settings</h1>
        </div>
        <div class="col">
            <form method="post" action="">
                <label for="addresses"><b>Addresses</b></label>
                <select name="addresses">
                    <?php
                    while ($row = mysqli_fetch_row($resultAddresses)){
                        echo "<option>$row[2] "."$row[3] "."$row[4] "."$row[5]</option>";
                    }
                    ?>
                </select><br>

                <label for="city"><b>City</b></label>
                <input type="text" name="city" placeholder="Enter your City">

                <label for="zipCode"><b>Zip Code</b></label>
                <input type="text" name="zipCode" placeholder="Enter your zip code">

                <label for="street"><b>Street</b></label>
                <input type="text" name="street" placeholder="Enter your street">

                <label for="homeNumber"><b>Home Number</b></label>
                <input type="text" name="homeNumber" placeholder="Enter your home number">

                <div class="clearfix">
                    <button type="reset" class="cancelbtn">Cancel</button>
                    <button type="submit" class="signupbtn" name="submit">Add Addresses</button>
                </div>
            </form>
        </div>
        <div class="col">
            fdsfsd
        </div>
    </div>

</div>


</body>
</html>
