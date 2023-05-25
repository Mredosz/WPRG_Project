<?php
session_start();
require_once "../../class/Database.php";
require_once "../../class/Users.php";
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
<?php
//Add navbar
require_once "navbar.php";
?>
<div class="container-fluid color">
    <!--    Display errors-->
    <?php
    if (isset($error)) {
        foreach ($error as $item) {
            echo '<span class="error">' . $item . '</span>';
        }
    }
    ?>
    <div class="row row-cols-1">
        <div class="col text-center">
            <h1 class="h1">Edit & Delete Users</h1>
        </div>
        <div class="col">
            <!--            Display information about all users -->
            <?php
            Users::display();
            ?>
        </div>
    </div>
</div>
</body>
</html>
