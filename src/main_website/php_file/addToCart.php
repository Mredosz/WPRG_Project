<?php
session_start();
$rolaID = $_SESSION['rolaID'];
if (isset($_SESSION['usersID'])){
    $userID = $_SESSION['usersID'];
}else{
    $userID = 1;
}
// Connect to SQL
require_once "../../../src/class/Database.php";

if (isset($_GET['itemID'])){
    $itemID = $_GET['itemID'];
//    echo "this is message from addToCart.php product id is $itemID";
    $result = Database::query("SELECT * FROM item WHERE itemID ='$itemID'");
    $resultCart= Database::query("SELECT * FROM cart 
    JOIN users u on u.usersID = cart.usersID 
     WHERE itemID = '$itemID' AND u.usersID='$userID'");
    $count = 0;
    $resultCount= Database::query("SELECT * FROM cart WHERE usersID='$userID'");
    //Get count of all items in cart
    while ( $rowCount = mysqli_fetch_array($resultCount)){
        $count += ($rowCount['quantity']);
    }
//    if there are several items of the same type, it multiplies
    if (Database::numRows($resultCart)>0){
        $rowCart = mysqli_fetch_array($resultCart);
        $quantity = $rowCart['quantity']+1;
        $row = mysqli_fetch_array($result);
        $cost = $row['price']*$quantity;

        echo json_encode(["num_cart"=>$count]);

        Database::query("UPDATE cart SET quantity = '$quantity', totalPrice = '$cost' 
            WHERE itemID='$itemID' AND usersID ='$userID'");
    }else {
        //Add new item
        while ($row = mysqli_fetch_array($result)) {
            Database::query("INSERT INTO cart (itemID, quantity, totalPrice, usersID) VALUES 
                                                    ('$row[itemID]', '1', '$row[price]','$userID' )");
                echo json_encode(["num_cart"=>$count]);
        }
    }
}


Database::disconnect();
?>