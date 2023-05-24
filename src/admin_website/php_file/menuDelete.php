<?php
session_start();
// Connect to SQL
require_once "../../class/Database.php";
//Move user to subpage
header("Location: menu.php");

Database::query("DELETE FROM item WHERE itemID = $_GET[itemID]");
Database::disconnect();
?>
