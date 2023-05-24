<?php
session_start();
// Connect to SQL
require_once "../../class/Database.php";
//Move user to subpage
header("Location:users.php");

Database::query("DELETE FROM users WHERE usersID = $_GET[usersID]");
Database::disconnect();
?>
