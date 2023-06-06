<?php
session_start();
ob_start();
// Connect to SQL
require_once "../../class/Database.php";
require_once "../../class/Addresses.php";

$usersID = $_SESSION['usersID'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!--    Website Title-->
    <title>Shrek's Restaurant</title>
    <?php
    require_once "../html_file/links.html";
    ?>
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
            <span> <h1 class="h1">Edit Address</h1></span>
        </div>
        <div class="col-8 text-center">
            <span> <h1 class="h1">Edit & Delete Address</h1></span>
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
                header("Location: 404Error.php");
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
