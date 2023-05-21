<?php
session_start();
// Connect to SQL
include "../../main_website/php_file/config.php";
global $conn;
//Move user to subpage
header("Location: menu.php");

$sql = "DELETE FROM item WHERE itemID = $_GET[itemID]";

if (!mysqli_query($conn, $sql)) {
    $error[] = "It's problem with database!";
}

mysqli_close($conn);
?>
