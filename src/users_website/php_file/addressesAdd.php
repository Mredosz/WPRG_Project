<?php
session_start();
// Connect to SQL
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
    <!-- Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<!--Short navbar to navigate to main website and user staff-->
<nav class="navbar bg-dark navbar-dark px-3 mb-3">
    <a class="navbar-brand" href="../../../src/users_website/php_file/users_index.php">Shrek's Restaurant</a>
    <h1 class="h">Addresses</h1>
    <ul class="nav nav-pills ms-auto flex-nowrap">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
               aria-expanded="false">
                <!-- Show First name and Last name user-->
                <?php echo $_SESSION['userName'] ?>
            </a>
            <ul class="dropdown-menu dropdown-menu-dark bg-dark">
                <li><a class="dropdown-item" href="orders.php">Orders</a></li>
                <li><a class="dropdown-item" href="addressesAdd.php">Addresses</a></li>
                <li><a class="dropdown-item" href="settings.php">Settings</a></li>
                <li>
                    <hr class="dropdown-divider bg-secondary">
                </li>
                <li><a class="dropdown-item"
                       href="../../../src/users_website/php_file/logout.php">Log out</a></li>
            </ul>
        </li>
    </ul>
</nav>

<div class="container-fluid">
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
            <h1 class="h1">Add Address</h1>
        </div>
        <div class="col-8 text-center">
            <h1 class="h1">Edit & Delete Address</h1>
        </div>
        <div class="col-4">
            <!--            Connect to sql base address table-->
            <?php
            include "addressesConnect.php";
            ?>
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
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">City</th>
                    <th scope="col">Zip Code</th>
                    <th scope="col">Street</th>
                    <th scope="col">Home Number</th>
                    <th scope="col">Phone Number</th>
                </tr>
                </thead>
                <?php
                //            mysqli_fetch_array() - associative array
                while ($row = mysqli_fetch_array($resultAddresses)) {
                    echo "<tbody>";
                    echo "<tr>";
                    echo("<td>$row[city]</td>");
                    echo("<td>$row[zipCode]</td>");
                    echo("<td>$row[street]</td>");
                    echo("<td>$row[homeNumber]</td>");
                    echo("<td>$row[phoneNumber]</td>");
//                Link to a subpage for editing a given address
                    echo("<td><a class='btn btn-outline-dark' href=\"addressesEdit.php?addressID=$row[addressID]\">Edit</a></td>");
//                Link to a subpage for delete a given address
                    echo("<td><a class='btn btn-outline-dark' href=\"addressesDelete.php?addressID=$row[addressID]\">Delete</a></td>");
                    echo "</tr>";
                    echo "</tbody>";
                }
                ?>
            </table>
        </div>
    </div>

</div>


</body>
</html>
