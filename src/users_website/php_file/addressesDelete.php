<?php
session_start();
include "addressesConnect.php";
// Connect to SQL
global $resultAddresses;
global $conn;
header("Location:addressesAdd.php");

$sql = "DELETE FROM address WHERE addressID = $_GET[addressID]";

if (mysqli_query($conn, $sql)) {


} else {

    echo "ERROR: $sql. " . mysqli_error($conn);
}


mysqli_close($conn);
?>
