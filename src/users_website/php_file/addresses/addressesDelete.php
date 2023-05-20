<?php
session_start();
// Connect to SQL
include "addressesConnect.php";
global $resultAddresses;
global $conn;
//Move user to subpage
header("Location:addressesAdd.php");

$sql = "DELETE FROM address WHERE addressID = $_GET[addressID]";

if (!mysqli_query($conn, $sql)) {
    $error[] = "It's problem with database!";
}

mysqli_close($conn);
?>
