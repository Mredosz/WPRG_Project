<?php
session_start();
// Connect to SQL
require_once "../../class/Database.php";
//Move user to subpage
header("Location:cart.php");

Database::query("DELETE FROM cart WHERE cartID = $_GET[cartID]");

Database::disconnect();
?>
