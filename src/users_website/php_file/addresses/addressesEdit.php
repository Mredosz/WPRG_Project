<?php
session_start();
// Connect to SQL
require_once "../../../class/Database.php";
require_once "../../../class/Addresses.php";

$usersID = $_SESSION['usersID'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!--    Website Title-->
    <title>Shrek's Restaurant</title>
    <!--    Custom CSS-->
    <link rel="stylesheet" type="text/css" href="../../../../src/style/form.css">
    <!--    Website icon-->
    <link rel="icon" href="../../../../image/icon.ico">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <!-- Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<!--Short navbar to navigate to main website and user staff-->
<nav class="navbar bg-dark navbar-dark px-3 mb-3">
    <a class="navbar-brand" href="../../../../../WPRG_Project/index.php">Shrek's Restaurant</a>
    <h1 class="h">Addresses</h1>
    <ul class="nav nav-pills ms-auto flex-nowrap">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
               aria-expanded="false">
                <!-- Show First name and Last name user-->
                <?php echo $_SESSION['userName'] ?>
            </a>
            <ul class="dropdown-menu dropdown-menu-dark bg-dark">
                <li><a class="dropdown-item" href="../orders.php">Orders</a></li>
                <li><a class="dropdown-item" href="addressesAdd.php">Addresses</a></li>
                <li><a class="dropdown-item" href="../settings.php">Settings</a></li>
                <li>
                    <hr class="dropdown-divider bg-secondary">
                </li>
                <li><a class="dropdown-item" href="../../../../../WPRG_Project/src/users_website/php_file/logout.php">Log out</a></li>
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
            <h1 class="h1">Edit Address</h1>
        </div>
        <div class="col-8 text-center">
            <h1 class="h1">Edit & Delete Address</h1>
        </div>
        <div class="col-4">
            <?php
            $conn = Database::connect();

            if ($conn === false) {
                $error[] = ("ERROR " . mysqli_connect_error());
            }

            //            ID in address table
            $num = $_GET['addressID'];

            //            mysqli_fetch_array() - associative array
            $row = mysqli_fetch_array(Database::query("SELECT * FROM address WHERE addressID = '$num'"));
            if ($usersID == $row['usersID']){
            ?>
            <!--   echo "$row[city]" ---   Display information about this address and give user possibility to edit-->
            <form action="" method="post">
                <label for="city"><b>City</b></label>
                <input type="text" name="city" value="<?php echo "$row[city]"; ?>">

                <label for="zipCode"><b>Zip Code</b></label>
                <input type="text" name="zipCode" value="<?php echo "$row[zipCode]"; ?>">

                <label for="street"><b>Street</b></label>
                <input type="text" name="street" value="<?php echo "$row[street]"; ?>">

                <label for="homeNumber"><b>Home Number</b></label>
                <input type="text" name="homeNumber" value="<?php echo "$row[homeNumber]"; ?>">

                <label for="homeNumber"><b>Phone Number</b></label>
                <input type="tel" name="phoneNumber" value="<?php echo "$row[phoneNumber]"; ?>">

                <button type="submit" class="updatebtn" name="update">Update</button>
                <?php
                //                Update changes into database
                Addresses::addressesUpdate($row, $usersID);
                }else{
                header("Location: ../404Error.php");
                }
                ?>

            </form>
        </div>
        <div class="col-8">
            <?php
            Addresses::addressesDisplay($usersID);
            ?>
        </div>
    </div>
</div>
</body>
</html>
