<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!--    Website Title-->
    <title>Admin Website</title>
    <?php
    include "../html_file/links.html";
    ?>
</head>
<body>
<div>
    <?php
    require_once  "navbar.php";
    ?>
    <?php
    require_once  "dashboard.php";
    ?>
</div>
</body>
</html>