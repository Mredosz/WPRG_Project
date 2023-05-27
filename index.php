<?php
include "src/constants.php";

session_start();
if (isset($_SESSION['rolaID'])){
    $rolaId=$_SESSION['rolaID'];
}else{
    $rolaId=1;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!--    Website Title-->
    <title>Shrek's Restaurant</title>
    <!--    Custom CSS-->
    <link rel="stylesheet" type="text/css" href="src/style/style.css">
    <!--    Website icon-->
    <link rel="icon" href="/image/icon%20-%20Copy%20-%20Copy.ico">
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
</head>
<body id="myPage">
<div data-bs-spy="scroll" data-bs-target="#navbaruser"  data-bs-smooth-scroll="true" tabindex="0">
<!------------------------------------Navbar------------------------------------>
<?php
//Guests
if ($rolaId == 1) {
    require_once MHTML."/navbar.html";
//Login users
}else if ($rolaId == 2){
    require_once UHTML."/navbar_users.html";
//Admin
}else if ($rolaId == 3){
    header("Location:src/admin_website/php_file/admin.php");
}
?>
<!-------------------------------------Header----------------------------------->
<?php
require_once MHTML."/header.html";
?>
<!-----------------Section with information about restaurant-------------------->
<?php
require_once MHTML."/about.html";
?>
<!---------------------------------------Menu----------------------------------->
<?php
require_once MPHP."/menu.php"
?>
<!------------------------------------Service----------------------------------->
<?php
require_once MHTML."/service.html"
?>
<!------------------------------------Gallery----------------------------------->
<?php
require_once MHTML."/gallery.html"
?>
<!--------------------------------------Staff----------------------------------->
<?php
require_once MHTML."/staff.html"
?>
<!------------------------------------Contact----------------------------------->
<?php
require_once MHTML."/contact.html"
?>
<!----------------------------------------Map----------------------------------->
<?php
require_once MHTML."/map.html"
?>
<!-------------------------------------Footer----------------------------------->
<?php
require_once MHTML."/footer.html"
?>
</div>
</body>
</html>