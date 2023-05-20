<?php
session_start();
// Connect to SQL
include "../../../src/main_website/php_file/config.php";
global $conn;
//Move user to subpage
header("Location:users.php");

$sql = "DELETE FROM users WHERE usersID = $_GET[usersID]";

if (!mysqli_query($conn, $sql)) {
    $error[] = "It's problem with database!";
}

mysqli_close($conn);
?>
