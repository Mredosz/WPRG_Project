<?php
include "../../../main_website/php_file/config.php";
global $conn;
$usersID = $_SESSION['usersID'];
$selectAddresses = "SELECT * FROM address WHERE usersID ='$usersID'";
$resultAddresses = mysqli_query($conn, $selectAddresses);
if (isset($_POST['submit'])) {
//mysqli_real_escape_string() remove all special characters from string
    $city = mysqli_escape_string($conn, $_POST['city']);
    $zipCode = mysqli_escape_string($conn, $_POST['zipCode']);
    $street = mysqli_escape_string($conn, $_POST['street']);
    $homeNumber = mysqli_escape_string($conn, $_POST['homeNumber']);
    $phoneNumber = mysqli_escape_string($conn, $_POST['phoneNumber']);

    $select = "SELECT * FROM Users WHERE usersID = '$usersID'";
    $result = mysqli_query($conn, $select);

    if (mysqli_num_rows($result) > 0) {

        $insertAddresses = "INSERT INTO address(usersID, city, zipCode, street, homeNumber,phoneNumber) 
VALUES ('$usersID', '$city', '$zipCode', '$street', '$homeNumber', '$phoneNumber')";
        mysqli_query($conn, $insertAddresses);
        mysqli_close($conn);
//        Moves to the same page
        header("Location: addressesAdd.php");
    }

}
?>