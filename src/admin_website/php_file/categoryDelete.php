<?php
session_start();
// Connect to SQL
include "../../main_website/php_file/config.php";
global $conn;
//Move user to subpage
header("Location: category.php");

$sql = "DELETE FROM category WHERE categoryID = $_GET[categoryID]";

if (!mysqli_query($conn, $sql)) {
    $error[] = "It's problem with database!";
}

mysqli_close($conn);
?>
