<?php
require_once "Database.php";

class Checkout
{
    static final function display($userID)
    {
        $selectSummary = "SELECT quantity, totalPrice,i.name AS name FROM cart
                JOIN item i on i.itemID = cart.itemID
                JOIN users u on u.usersID = cart.usersID WHERE u.usersID ='$userID'";
        $resultSummary = Database::query($selectSummary);
        $total = 0;
        while ($row = mysqli_fetch_array($resultSummary)) {
            $total += $row['totalPrice'];
            ?>
            <ul class="list-group">
                <li class="list-group-item">
                    <h4 class="list-group-item-heading"><?php echo $row['name']; ?>
                        <span class="badge pull-right"><?php echo $row['totalPrice'] . " $"; ?></span>
                        <span class="list-group-item-text text-center badge">Quantity  <?php echo $row['quantity']; ?></span>
                    </h4>
                </li>
            </ul>
            <?php
        }
        ?>
        <!--                Show total cash to pay-->
        <h3>Total amount to paid: <?php echo $total; ?> $</h3>
        <?php
        return $total;
    }

    static final function bill($userID)
    {
        $result = Database::query("SELECT orderID, totalPrice,orderID FROM `order` 
                                    WHERE usersID = '$userID' ORDER BY orderID DESC ");
        $rowOrder = mysqli_fetch_array($result);
        $orderID = $rowOrder['orderID'];
        $resultOrderItem = Database::query("SELECT name, quantity, total FROM order_position 
         JOIN item i on i.itemID = order_position.itemID WHERE orderID = '$orderID'");
        //    Get date from cookie
        $firstName = $_COOKIE['firstName'];
        $lastName = $_COOKIE['lastName'];
        $email = $_COOKIE['email'];
        $phoneNumber = $_COOKIE['phoneNumber'];

        $city = $_COOKIE['city'];
        $zipCode = $_COOKIE['zipCode'];
        $street = $_COOKIE['street'];
        $homeNumber = $_COOKIE['homeNumber'];
        $bill =
"*******************************************************************************************
Your Details:                                          Your Address:                
Name: $firstName                                       City: $city  $zipCode
Last Name: $lastName                                   Street: $street
E-mail: $email                           Home Number: $homeNumber
Phone Number: $phoneNumber
*******************************************************************************************

Order Information:
Name:                        Quantity                         Coast
-------------------------------------------------------------------------------------------
";
        $path = "C:\\PJWSTK\\WPRG\\Git\\WPRG_Project\\bills\\".$rowOrder['orderID'].".txt";
        $billFile = fopen("$path", "w") or die("Unable to open file!");
        fwrite($billFile, $bill);
        while ($row = mysqli_fetch_array($resultOrderItem)){
            $bill2=
"$row[name]                           $row[quantity]                                $row[total]
-------------------------------------------------------------------------------------------
";
            fwrite($billFile, $bill2);
        }
        $bill3 =
"*******************************************************************************************
Total cash to pay: $rowOrder[totalPrice]";
        fwrite($billFile, $bill3);
        fclose($billFile);
    }

    static final function checkoutPart1(){
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
    }

    static final function checkoutPart1Login(){
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $email = $_POST['email'];
        $address = $_POST['address'];

        setcookie('firstName', $firstName, time() + (60 * 60));
        setcookie('lastName', $lastName, time() + (60 * 60));
        setcookie('email', $email, time() + (60 * 60));
        setcookie('address', $address, time() + (60 * 60));
    }

    static final function checkoutPart1Form(){
        ?>
        <label for="firstName"><b>First Name</b></label>
        <input type="text" name="firstName" placeholder="Enter Your First Name" required>

        <label for="lastName"><b>Last Name</b></label>
        <input type="text" name="lastName" placeholder="Enter Your Last Name" required>

        <label for="email"><b>E-mail</b></label>
        <input type="email" name="email" placeholder="Enter Your E-mail" required>
<?php
    }

    static final function checkoutPart1formLogin(){
        ?>
    }
         <label for="firstName"><b>First Name</b></label>
                    <input type="text" name="firstName" value="<?php echo $row['firstName'] ?>" required>

                    <label for="lastName"><b>Last Name</b></label>
                    <input type="text" name="lastName" value="<?php echo $row['lastName'] ?>" required>

                    <label for="email"><b>E-mail</b></label>
                    <input type="email" name="email" value="<?php echo $row['email'] ?>" required>

                    <label for="address"><b>Address</b></label>
                    <select name="address">
                        <?php
                        //Show select with all cells from table
                        $resultAddress = Database::query("SELECT * FROM address WHERE usersID = '$userID'");
                        while ($row = mysqli_fetch_array($resultAddress)) {
                            $id = $row['addressID'];
                            $name = $row['city'] . " " . $row['zipCode'] . " " . $row['street'] . " " . $row['homeNumber'] . " " .
                                $row['phoneNumber'];
                            ?>
                            <option value="<?php echo $id; ?>"<?php if ($id == $row['addressID']) {
                                echo "selected";
                            } ?>><?php echo $name; ?></option>
                            <?php
                        }
                        ?>
                    </select>
<?php
    }

    static final function checkoutButton(){
        ?>
        <div class="clearfix col-12">
            <br>
            <button type="reset" class="cancelbtn">Cancel</button>
            <button type="submit" class="signupbtn" name="submit">Enter</button>
            </form>
        </div>
<?php
    }

}