<?php
session_start();
// Connect to SQL
require_once "../../../src/class/Database.php";

if (isset($_GET['itemID'])) {
    $itemID = $_GET['itemID'];
    $userID = $_SESSION['usersID'];

    $result = Database::query("SELECT * FROM item WHERE itemID ='$itemID'");
    $resultCart = Database::query("SELECT * FROM cart WHERE itemID = '$itemID' AND usersID ='$userID'");

    $rowCart = mysqli_fetch_array($resultCart);
    $row = mysqli_fetch_array($result);

    $quantity = $rowCart['quantity']+1;
    $cost = $row['price']*$quantity;
    Database::query("UPDATE cart SET quantity = '$quantity', totalPrice = '$cost' 
            WHERE itemID='$itemID' AND usersID = '$userID'");
}

Database::disconnect();
header("Location: cart.php");
?>