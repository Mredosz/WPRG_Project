<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!--    Website Title-->
    <title>Shrek's Restaurant</title>
    <!--    Custom CSS-->
    <link rel="stylesheet" type="text/css" href="../../style.css">
    <!--    Custom JS-->
    <!--    <script src="script.js"></script>-->
    <!--    Website icon-->
    <link rel="icon" href="/image/icon.ico">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <!-- Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <!--    Icons-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <!-- Bootstrap JavaScript previous version-->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

</head>
<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="60">
<!------------------------------------Navbar------------------------------------>
<?php
require_once "../html file/navbar.html"
?>
<!-------------------------------------Header----------------------------------->
<?php
require_once "../html file/header.html";
?>
<!-----------------Section with information about restaurant-------------------->
<?php
require_once "../html file/about.html";
?>
<!---------------------------------------Menu----------------------------------->
<?php
require_once "../html file/menu.html"
?>
<!------------------------------------Service----------------------------------->
<?php
require_once "../html file/service.html"
?>

</body>
</html>