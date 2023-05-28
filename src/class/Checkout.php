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
        $result = Database::query("SELECT orderID, total_price,orderID FROM `order` 
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
Total cash to pay: $rowOrder[total_price]";
        fwrite($billFile, $bill3);
        fclose($billFile);
    }
}