<?php
session_start();
// Connect to SQL
require_once "../../../class/Database.php";
//Move user to subpage
header("Location:addressesAdd.php");

Database::query("DELETE FROM address WHERE addressID = $_GET[addressID]");

Database::disconnect();
?>
