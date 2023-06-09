<?php

class Orders
{
    static final function displayYourOrder($num, $usersID, $row)
    {

        ?>
        <br><br><span> <h3>Your order</h3></span>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Number</th>
                <th scope="col">Name</th>
                <th scope="col">Quantity</th>
                <th scope="col">Price</th>
                <th scope="col">Description</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <?php
//            Show information from order table
            $orderID = $row['orderID'];
            $resultItem = Database::query("SELECT * FROM `order`
                   JOIN order_position op on `order`.orderID = op.orderID
                   JOIN item i on i.itemID = op.itemID WHERE `order`.orderID = '$orderID'");
            $number = 1;
            while ($row = mysqli_fetch_array($resultItem)) {
                echo "<tbody>";
                echo "<tr>";
                echo("<td>$number</td>");
                echo("<td>$row[name]</td>");
                echo("<td>$row[quantity]</td>");
                echo("<td>$row[total]</td>");
                echo("<td>$row[description]</td>");
                echo "</tr>";
                echo "</tbody>";
                $number++;
            }
            ?>
        </table>
        <?php
//        Show more information for specific order
        $resultOrders = Database::query("SELECT * FROM `order` WHERE usersID = '$usersID' 
                            AND orderID = '$num'");
        $row = mysqli_fetch_array($resultOrders);
        echo "<span><b>Order Date: </b>$row[dateOrder]</span><br>";
        echo "<span><b>Payment: </b>$row[payment]</span><br>";
        echo "<span><b>Deliver Type: </b>$row[deliver]</span><br>";

        if ($row['deliver'] == 'Table') {
            echo "<span><b>Table Number: </b> $row[tableNumber]</span><br>";
        }

        echo "<span><b>Total Price: </b>$row[totalPrice]</span><br><br>";

        $path = "../../../../WPRG_Project/bills/" . $row['orderID'] . ".txt";
        ?>

        <a href="<?php echo $path; ?>" download="bill.txt">
            <button class="btn btn-outline-dark">Bill</button>
        </a>
        <?php
    }

    static final function displayYourInformation($row)
    {
//        Show information about user
        echo "<span><h3 class=''> Your Information </h3></span>";
        echo "<span><b>Name: </b>$row[firstName]</span><br>";
        echo "<span><b>Last Name: </b>$row[lastName]</span><br>";
        echo "<span><b>Email: </b> $row[email]</span><br>";
        echo "<span><b>Phone Number: </b>$row[phoneNumber]</span><br>";
    }

    static final function displayYourAddress($row)
    {
//        show information about user address
        echo "<span><h3 class=''> Your Address </h3></span>";
        echo "<span><b>City: </b>$row[city]</span><br>";
        echo "<span><b>Zip Code: </b>$row[zipCode]</span><br>";
        echo "<span><b>Street: </b>$row[street]</span><br>";
        echo "<span><b>Home number: </b> $row[homeNumber]</span><br>";
    }

    static final function displayOrder($resultOrders)
    {
//        Show information about orders for admin show all order, for users show only them order
        $number = 1;
        while ($row = mysqli_fetch_array($resultOrders)) {
            echo "<tbody>";
            echo "<tr>";
            echo("<td>$number</td>");
            echo("<td>$row[deliver]</td>");
            echo("<td>$row[payment]</td>");
            echo("<td>$row[dateOrder]</td>");
            echo("<td>$row[totalPrice]</td>");
//                    Link to a subpage to show more about order
            echo("<td><a class='btn btn-outline-dark' href=\"ordersMore.php?orderID=$row[orderID]\">More</a></td>");
            echo "</tr>";
            echo "</tbody>";
            $number++;
        }
    }

    static final function displayOrderTab()
    {
        ?>
        <th scope="col">Number</th>
        <th scope="col">Deliver Type</th>
        <th scope="col">Payment</th>
        <th scope="col">Date Order</th>
        <th scope="col">Total Price</th>
        <th scope="col"></th>
        <?php
    }

}