<?php
include "../../main_website/php_file/config.php";
global $conn;
$usersID = $_SESSION['usersID'];
$selectAddresses = "SELECT * FROM address WHERE usersID ='$usersID'";
$resultAddresses = mysqli_query($conn, $selectAddresses);
if (isset($_POST['submit'])) {

//    if (isset($_POST['city']) && isset($_POST['zipCode']) && isset($_POST['street']) && isset($_POST['homeNumber'])) {

$city = mysqli_escape_string($conn, $_POST['city']);
$zipCode = mysqli_escape_string($conn, $_POST['zipCode']);
$street = mysqli_escape_string($conn, $_POST['street']);
$homeNumber = mysqli_escape_string($conn, $_POST['homeNumber']);

$select = "SELECT * FROM Users WHERE usersID = '$usersID'";
$result = mysqli_query($conn, $select);

if (mysqli_num_rows($result) > 0) {
//            $selectAddresses = "SELECT * FROM address WHERE usersID ='$usersID'";
//            $resultAddresses = mysqli_query($conn, $selectAddresses);

$insertAddresses = "INSERT INTO address(usersID, city, zipCode, street, homeNumber) VALUES ('$usersID', '$city', '$zipCode', '$street', '$homeNumber')";
    mysqli_query($conn, $insertAddresses);
mysqli_close($conn);
//        header("Location: login.php");
}

}
?>