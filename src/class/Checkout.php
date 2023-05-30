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
    }

    static final function total($userID)
    {
        $selectSummary = "SELECT quantity, totalPrice,i.name AS name FROM cart
                JOIN item i on i.itemID = cart.itemID
                JOIN users u on u.usersID = cart.usersID WHERE u.usersID ='$userID'";
        $resultSummary = Database::query($selectSummary);
        $total = 0;
        while ($row = mysqli_fetch_array($resultSummary)) {
            $total += $row['totalPrice'];
        }
        return $total;
    }

    static final function billDelivery($userID)
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
        $path = "C:\\PJWSTK\\WPRG\\Git\\WPRG_Project\\bills\\" . $rowOrder['orderID'] . ".txt";
        $billFile = fopen("$path", "w") or die("Unable to open file!");
        fwrite($billFile, $bill);
        while ($row = mysqli_fetch_array($resultOrderItem)) {
            $bill2 =
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

    static final function billCollect($userID)
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

        $bill =
            "*******************************************************************************************
Your Details:                                                          
Name: $firstName                                       
Last Name: $lastName                                   
E-mail: $email                          
Phone Number: $phoneNumber
*******************************************************************************************

Order Information:
Name:                        Quantity                         Coast
-------------------------------------------------------------------------------------------
";
        $path = "C:\\PJWSTK\\WPRG\\Git\\WPRG_Project\\bills\\" . $rowOrder['orderID'] . ".txt";
        $billFile = fopen("$path", "w") or die("Unable to open file!");
        fwrite($billFile, $bill);
        while ($row = mysqli_fetch_array($resultOrderItem)) {
            $bill2 =
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

    static final function billTable($userID)
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
        $tableNumber = $_COOKIE['tableNumber'];

        $bill =
            "*******************************************************************************************
Your Details:                                                      Table Number : $tableNumber    
Name: $firstName                                       
Last Name: $lastName                                   
E-mail: $email                           
Phone Number: $phoneNumber
*******************************************************************************************

Order Information:
Name:                        Quantity                         Coast
-------------------------------------------------------------------------------------------
";
        $path = "C:\\PJWSTK\\WPRG\\Git\\WPRG_Project\\bills\\" . $rowOrder['orderID'] . ".txt";
        $billFile = fopen("$path", "w") or die("Unable to open file!");
        fwrite($billFile, $bill);
        while ($row = mysqli_fetch_array($resultOrderItem)) {
            $bill2 =
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

    static final function checkoutPart1()
    {
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

    static final function checkoutPart1Login()
    {
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $email = $_POST['email'];


        setcookie('firstName', $firstName, time() + (60 * 60));
        setcookie('lastName', $lastName, time() + (60 * 60));
        setcookie('email', $email, time() + (60 * 60));

    }

    static final function checkoutPart1Form()
    {
        ?>
        <label for="firstName"><b>First Name</b></label>
        <input type="text" name="firstName" placeholder="Enter Your First Name" required>

        <label for="lastName"><b>Last Name</b></label>
        <input type="text" name="lastName" placeholder="Enter Your Last Name" required>

        <label for="email"><b>E-mail</b></label>
        <input type="email" name="email" placeholder="Enter Your E-mail" required>
        <?php
    }

    static final function checkoutPart1formLogin($row, $userID)
    {
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

    static final function checkoutButton()
    {
        ?>
        <div class="clearfix col-12">
            <br>
            <button type="reset" class="cancelbtn">Cancel</button>
            <button type="submit" class="signupbtn" name="submit">Enter</button>
            </form>
        </div>
        <?php
    }

    static final function checkoutPart2Time($userID, $type)
    {

//            add current time
        $rand = rand(45, 80);
        $current_time = new DateTime();
        $date = $current_time->format('d/m/y  H:i');

//            Add deliver time
        $time = new DateTime();
        $time->add(new DateInterval('PT' . $rand . 'M'));
        $deliveryDate = $time->format("d/m/y  H:i");
        $total = Checkout::total($userID);
//                Create new field in order table
        $insertOrder = "INSERT INTO `order` (usersID, deliver, payment, dateOrder, totalPrice, deliverDate)
                   VALUES ('$userID', '$type', 'Cash', '$date', '$total',' $deliveryDate' ) ";
        Database::query($insertOrder);
    }

    static final function checkoutPar3()
    {
//        Get date from cookie
        $firstName = $_COOKIE['firstName'];
        $lastName = $_COOKIE['lastName'];
        $email = $_COOKIE['email'];
        $phoneNumber = $_COOKIE['phoneNumber'];
        $payment = $_POST['payment'];

//    Get userID from database
        $selectUser = "SELECT * FROM users WHERE firstName='$firstName' AND lastName = '$lastName' 
                        AND email = '$email' AND rolaID = '1'";
        $resultUser = Database::query($selectUser);
        $rowUsers = mysqli_fetch_array($resultUser);
        $userID = $rowUsers['usersID'];
        $_SESSION['userID'] = $userID;

//    Get the last order from this user
        $selectOrder = "SELECT * FROM `order` WHERE usersID = '$userID' ORDER BY orderID DESC LIMIT 1";
        $resultOrder = Database::query($selectOrder);
        $rowOrder = mysqli_fetch_array($resultOrder);
        $orderID = $rowOrder['orderID'];

        //Update payment in order table
        $updateOrder = "UPDATE `order` SET payment = '$payment' WHERE usersID = '$userID' ORDER BY orderID DESC LIMIT 1";
        Database::query($updateOrder);

//    Transfer of all items to another table
        $select = "SELECT * FROM cart WHERE usersID = '$userID'";
        $result = Database::query($select);
        while ($row = mysqli_fetch_array($result)) {
            $insertOrder = "INSERT INTO order_position (orderID, itemID, quantity, total) VALUES 
                            ('$orderID', '$row[itemID]', ' $row[quantity]', '$row[totalPrice]' )";
            Database::query($insertOrder);

        }

//    Delete items from table cart

        $_SESSION['payment'] = $payment;
        if ($payment == 'Card') {
            header("Location: checkoutTablePart3.php");
        } else {
            unset($_SESSION['payment']);
            $deleteCart = "DELETE FROM cart WHERE usersID = '$userID'";
            Database::query($deleteCart);
            header("Location: end.php");
        }
    }

    static final function checkoutPar3CardPay()
    {
        if ($_SESSION['payment'] == "Card") {
            ?>
            <label for="name"><b>Full Name</b></label>
            <input name="name" maxlength="30" type="text">

            <label for="cardNumber"><b>Card Number</b></label>
            <input name="cardNumber" type="text" pattern="[0-9]*" inputmode="numeric">

            <label for="expirationDate"><b>Expiration (mm/yy)</b></label>
            <input name="expirationDate" type="text" pattern="[0-9]*" inputmode="numeric">

            <label for="securityCode"><b>Security Code</b></label>
            <input id="securityCode" type="text" pattern="[0-9]*" inputmode="numeric">
            <?php
        } else {
            ?>
            <h5>Payment</h5><br>
            <input type="radio" class="btn-check" name="payment" id="payment1" value="Card" checked>
            <label class="btn btn-outline-dark" for="payment1">Card</label>

            <input type="radio" class="btn-check" name="payment" id="payment2" value="Cash">
            <label class="btn btn-outline-dark" for="payment2">Cash</label>
            <?php
        }
    }
}