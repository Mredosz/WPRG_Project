<?php
session_start();
// Connect to SQL
require_once "../../class/Database.php";
//Move user to subpage
header("Location: category.php");

Database::query("DELETE FROM category WHERE categoryID = $_GET[categoryID]");
Database::disconnect();
?>
