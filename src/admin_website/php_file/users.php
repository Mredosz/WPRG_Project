<?php
session_start();
require_once "../../class/Database.php";
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
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">First Name</th>
                    <th scope="col">Last Name</th>
                    <th scope="col">E-mail</th>
                    <th scope="col">Password</th>
                    <th scope="col">Rola</th>
                </tr>
                </thead>
                <?php
                $resultUsers = Database::query("SELECT usersID, firstName, lastName, email, password,
                                            r.name AS rola FROM users JOIN rola r on users.rolaID = r.rolaID");
                //            mysqli_fetch_array() - associative array
                while ($row = mysqli_fetch_array($resultUsers)) {
                    echo "<tbody>";
                    echo "<tr>";
                    echo("<td>$row[firstName]</td>");
                    echo("<td>$row[lastName]</td>");
                    echo("<td>$row[email]</td>");
                    echo("<td>$row[password]</td>");
                    echo("<td>$row[rola]</td>");
//                Link to a subpage for editing  users
                    echo("<td><a class='btn btn-outline-dark' href=\"users_edit.php?usersID=$row[usersID]\">Edit</a></td>");
//                Link to a subpage for delete users
                    echo("<td><a class='btn btn-outline-dark' href=\"users_delete.php?usersID=$row[usersID]\">Delete</a></td>");
                    echo "</tr>";
                    echo "</tbody>";
                }
                ?>
            </table>
        </div>
    </div>
</div>
</body>
</html>
